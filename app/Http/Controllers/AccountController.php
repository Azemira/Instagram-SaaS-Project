<?php

namespace App\Http\Controllers;

use App\Library\Pilot;
use App\Models\Account;
use App\Models\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InstagramAPI\Exception\AccountDisabledException;
use InstagramAPI\Exception\ChallengeRequiredException;
use InstagramAPI\Exception\CheckpointRequiredException;
use InstagramAPI\Exception\IncorrectPasswordException;
use InstagramAPI\Exception\InvalidSmsCodeException;
use InstagramAPI\Exception\InvalidUserException;
use InstagramAPI\Exception\SentryBlockException;
use InstagramAPI\Instagram;
use InstagramAPI\Response\LoginResponse;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Account::withCount([
            'messages_on_queue',
            'messages_sent',
            'messages_failed',
        ]);

        if ($request->filled('search')) {
            $data->where('username', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            if ($request->sort == 'asc') {
                $data->orderBy('id');
            } else {
                $data->orderByDesc('id');
            }
        } else {
            $data->orderByDesc('id');
        }

        $data = $data->paginate(10);

        return view('account.index', compact(
            'data'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $limit       = $request->user()->package->accounts_count;
        $has         = $request->user()->accounts()->count();
        $needUpgrade = $has >= $limit && !$request->user()->can('admin') && !$request->user()->onTrial() ? true : false;

        return view('account.create', compact(
            'needUpgrade'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|max:255|unique:accounts,username',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            $response = [
                'result' => 'error',
                'title'  => __('Validation errors'),
                'errors' => $validator->errors(),
            ];

        } else {

            $response = $this->loginInstagram($request);

        }

        if ($response['result'] == 'success') {

            // Create proxy record
            if ($request->filled('proxy')) {
                $proxy = Proxy::create([
                    'server' => $request->proxy,
                ]);
            }

            $account = Account::create([
                'user_id'  => $request->user()->id,
                'proxy_id' => $proxy->id ?? null,
                'username' => $request->username,
                'password' => $request->password,
            ]);

            $response['account_id'] = $account->id;

        }

        return response()->json($response);
    }

    private function loginInstagram(Request $request)
    {

        $instagram = new Pilot(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

        if ($request->filled('proxy')) {
            $instagram->setProxy($request->proxy); // TODO
        }

        try {

            $loginResponse = $instagram->login($request->username, $request->password);

            $two_factor_required = false;

            if ($loginResponse !== null && $loginResponse->isTwoFactorRequired()) {

                $two_factor_required = true;

                $twoFactorIdentifier = $loginResponse->getTwoFactorInfo()->getTwoFactorIdentifier();
                $phoneNumber         = $loginResponse->getTwoFactorInfo()->getObfuscatedPhoneNumber();

                $request->session()->put('twoFactorIdentifier', $twoFactorIdentifier);

                $response = [
                    'result'  => 'two_factor',
                    'title'   => __('Two factor login required'),
                    'message' => __('Enter the code sent to your number: ') . $phoneNumber,
                ];
            }

            if ($loginResponse instanceof LoginResponse || $loginResponse === null) {

                if ($two_factor_required == false) {

                    $response = [
                        'result'  => 'success',
                        'title'   => __('Account has been added'),
                        'message' => __('Your account has been successfully added.'),
                    ];

                }
            }

        } catch (IncorrectPasswordException $e) {

            $response = [
                'result' => 'error',
                'title'  => __('Incorrect password'),
                'errors' => [
                    __('The password you entered is incorrect. Please try again.'),
                ],
            ];

        } catch (InvalidUserException $e) {

            $response = [
                'result' => 'error',
                'title'  => __('Incorrect username'),
                'errors' => [
                    __('The username you entered doesn\'t appear to belong to an account. Please check your username and try again.'),
                ],
            ];

        } catch (SentryBlockException $e) {

            $response = [
                'result' => 'error',
                'title'  => __('Account blocked'),
                'errors' => [
                    __('Your account has been banned from Instagram API for spam behaviour or otherwise abusing.'),
                ],
            ];

        } catch (AccountDisabledException $e) {

            $response = [
                'result' => 'error',
                'title'  => __('Account disabled'),
                'errors' => [
                    __('Your account has been disabled for violating Instagram terms. <a href="https://help.instagram.com/366993040048856" target="_blank">Click here</a> to learn how you may be able to restore your account.'),
                ],
            ];

        } catch (CheckpointRequiredException $e) {

            $response = [
                'result' => 'error',
                'title'  => __('Checkpoint required'),
                'errors' => [
                    __('Your account is subject to verification checkpoint. Please go to <a href="http://instagram.com" target="_blank">instagram.com</a> and pass checkpoint!'),
                ],
            ];

        } catch (ChallengeRequiredException $e) {

            $response = [
                'result'   => 'challenge_required',
                'title'    => __('Challenge required'),
                'message'  => __('Confirm with one of the methods below:'),
                'api_path' => $e->getResponse()->getChallenge()->getApiPath(),
            ];

        } catch (\Exception $e) {

            $response = [
                'result' => 'error',
                'errors' => [
                    __('Something went wrong: ') . $e->getMessage(),
                ],
            ];
        }

        return $response;
    }

    public function confirm(Request $request)
    {
        if ($request->filled('action') && $request->filled('username') && $request->filled('password')) {

            switch ($request->action) {

                case 'request_challenge':

                    $instagram = new Pilot(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

                    if ($request->filled('proxy')) {
                        $instagram->setProxy($request->proxy); // TODO
                    }

                    try {

                        $challengeResponse = $instagram->sendChallangeCode(
                            $request->username,
                            $request->password,
                            $request->api_path,
                            $request->choice
                        );

                        if (is_array($challengeResponse)) {

                            if (isset($challengeResponse['action']) && strtoupper($challengeResponse['action']) === 'CLOSE') {

                                $response = [
                                    'result'  => 'success',
                                    'title'   => __('Account has been added'),
                                    'message' => __('Your account has been successfully added.'),
                                ];

                            } else {

                                if (strtoupper($challengeResponse['status']) === 'OK') {

                                    if ($request->choice == '0') {

                                        $phone_number = $challengeResponse['step_data']['phone_number_formatted'];
                                        $message      = __('Enter the code sent to your number: ') . $phone_number;

                                    } else {

                                        $contact_point = $challengeResponse['step_data']['contact_point'];
                                        $message       = __('Enter the 6-digit code sent to the email address: ') . $contact_point;

                                    }

                                    $response = [
                                        'result'  => 'confirm_challenge',
                                        'title'   => __('Confirm challenge'),
                                        'message' => $message,
                                    ];

                                } elseif (strtoupper($challengeResponse['status']) === 'FAIL') {

                                    $response = [
                                        'result'  => 'challenge_request_failed',
                                        'title'   => __('Challenge request failed'),
                                        'message' => $challengeResponse['message'],
                                    ];

                                } else {

                                    $response = [
                                        'result'  => 'challenge_request_failed',
                                        'title'   => __('Challenge request failed'),
                                        'message' => __('Could\'t send verification code for the login challenge! Please try again later!'),
                                    ];
                                }
                            }

                        } else {

                            $response = [
                                'result' => 'error',
                                'errors' => [
                                    __('Challenge response is not an array'),
                                ],
                            ];

                        }

                    } catch (\Exception $e) {

                        $response = [
                            'result' => 'error',
                            'errors' => [
                                __('Something went wrong: ') . $e->getMessage(),
                            ],
                        ];

                    }

                    break;

                case 'confirm_challenge':

                    if ($request->filled('code') && $request->filled('api_path')) {

                        $instagram = new Pilot(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

                        if ($request->filled('proxy')) {
                            $instagram->setProxy($request->proxy);
                        }

                        try {

                            $challengeResponse = $instagram->finishChallengeLogin(
                                $request->username,
                                $request->password,
                                $request->api_path,
                                $request->code
                            );

                            if (is_array($challengeResponse)) {

                                if (strtoupper($challengeResponse['status']) === 'OK') {

                                    $response = [
                                        'result'  => 'challenge_success',
                                        'title'   => __('Challenge successfully passed'),
                                        'message' => __('Now your account will be added.'),
                                    ];

                                } else {

                                    $response = [
                                        'result'  => 'invalid_challenge_code',
                                        'title'   => __('Invalid confirmation code'),
                                        'message' => __('Please check the security code sent you and try again.'),
                                    ];
                                }

                            } else {

                                $response = [
                                    'result' => 'error',
                                    'errors' => [
                                        __('Challenge response is not an array'),
                                    ],
                                ];

                            }

                        } catch (\Exception $e) {

                            $response = [
                                'result' => 'error',
                                'errors' => [
                                    __('Something went wrong: ') . $e->getMessage(),
                                ],
                            ];

                        }

                    }

                    break;

                case 'confirm_twofactor_login':

                    if ($request->filled('code')) {

                        $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

                        if ($request->filled('proxy')) {
                            $instagram->setProxy($request->proxy);
                        }

                        try {

                            $instagram->finishTwoFactorLogin(
                                $request->username,
                                $request->password,
                                $request->session()->get('twoFactorIdentifier'),
                                $request->code
                            );

                            $response = [
                                'result'  => 'twofactor_success',
                                'title'   => __('Two-factor code is valid'),
                                'message' => __('Two-factor code has been confirmed.'),
                            ];

                        } catch (InvalidSmsCodeException $e) {

                            $response = [
                                'result'  => 'invalid_sms_code',
                                'title'   => __('Invalid confirmation code'),
                                'message' => __('Please check the security code sent you and try again.'),
                            ];

                        } catch (\Exception $e) {

                            $response = [
                                'result' => 'error',
                                'errors' => [
                                    __('Something went wrong: ') . $e->getMessage(),
                                ],
                            ];

                        }
                    } else {
                        $response = [
                            'result' => 'error',
                            'errors' => [
                                __('Verification code is not specified!'),
                            ],
                        ];
                    }

                    break;

                case 'resend_twofactor':

                    $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

                    if ($request->filled('proxy')) {
                        $instagram->setProxy($request->proxy);
                    }

                    try {

                        $twoFactorResponse = $instagram->sendTwoFactorLoginSMS(
                            $request->username,
                            $request->password,
                            $request->session()->get('twoFactorIdentifier')
                        );

                        $twoFactorIdentifier = $twoFactorResponse->getTwoFactorInfo()->getTwoFactorIdentifier();
                        $phoneNumber         = $twoFactorResponse->getTwoFactorInfo()->getObfuscatedPhoneNumber();

                        $request->session()->put('twoFactorIdentifier', $twoFactorIdentifier);

                        $response = [
                            'result'  => 'two_factor_resent',
                            'title'   => __('Two-factor code has been resent'),
                            'message' => __('Enter the code sent to your number ending in: ') . $phoneNumber,
                        ];

                    } catch (\Exception $e) {

                        $response = [
                            'result' => 'error',
                            'errors' => [
                                __('Something went wrong: ') . $e->getMessage(),
                            ],
                        ];
                    }

                    break;

                default:

                    break;
            }
        } else {

            $response = [
                'result' => 'error',
                'errors' => [
                    __('Required fields are not specified!'),
                ],
            ];

        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view('account.edit', compact(
            'account'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        if ($request->filled('password')) {
            $account->password = $request->password;
        }

        if ($request->filled('proxy')) {
            $proxy             = Proxy::firstOrCreate(['server' => $request->proxy]);
            $account->proxy_id = $proxy->id;
        } else {
            $account->proxy_id = null;
        }

        $account->save();

        return redirect()->route('account.edit', $account)
            ->with('success', __('Updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->followers()->delete();
        $account->autopilot()->delete();
        $account->delete();

        return redirect()->route('account.index')
            ->with('success', __('Deleted successfully'));
    }

    public function export(Account $account, $type = 'followers')
    {
        if ($type == 'followers') {
            $data = $account->followers()->followers()->get();
        } else {
            $data = $account->followers()->following()->get();
        }

        return response()->streamDownload(function () use ($data) {
            echo $data->pluck('username')->join("\r\n");
        }, 'export-for-' . $account->username . '-' . $type . '.txt');

    }

}
