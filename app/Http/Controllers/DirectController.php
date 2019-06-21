<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use InstagramAPI\Instagram;

class DirectController extends Controller
{
    public function index()
    {
        $accounts = Account::all();

        return view('direct', compact(
            'accounts'
        ));
    }

    public function inbox(Request $request, Account $account)
    {
        $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

        if ($account->proxy) {
            $instagram->setProxy($account->proxy);
        }

        try {

            $instagram->login($account->username, $account->password);

        } catch (\Exception $e) {

            return response()->json([
                'result'  => 'failed',
                'title'   => __('Can\'t login to your account'),
                'message' => $e->getMessage(),
            ]);
        }

        try {

            $response = $instagram->direct->getInbox($request->cursor_id);

            $nextCursorId = $response->getInbox()->getOldestCursor();
            $hasOlder     = $response->getInbox()->getHasOlder();
            $threads      = $response->getInbox()->getThreads();
            $unseen_count = $response->getInbox()->getUnseenCount();

            $__threads = [];
            foreach ($threads as $thread) {
                $last_activity_at = $thread->getLastActivityAt();
                $last_seen_at     = collect($thread->getLastSeenAt())->first()['timestamp'];
                $last_item_text   = $thread->getLastPermanentItem()->getText() ?? __('Media message');

                $__threads[] = [
                    'thread_id'        => $thread->getThreadId(),
                    'users'            => $thread->getUsers(),
                    'last_item_text'   => $last_item_text,
                    'last_activity_at' => (int) $last_activity_at,
                    'last_seen_at'     => (int) $last_seen_at,
                    'is_new'           => (int) $last_activity_at < (int) $last_seen_at ? true : false,
                ];
            }

            return response()->json([
                'result'         => 'success',
                'threads'        => $__threads,
                'next_cursor_id' => $nextCursorId,
                'has_older'      => $hasOlder,
                'unseen_count'   => $unseen_count,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'result'  => 'failed',
                'title'   => __('Can\'t get thread list'),
                'message' => $e->getMessage(),
            ]);
        }

    }

    public function thread(Request $request, Account $account, $thread_id)
    {
        $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

        if ($account->proxy) {
            $instagram->setProxy($account->proxy);
        }

        try {

            $instagram->login($account->username, $account->password);

        } catch (\Exception $e) {

            return response()->json([
                'result'  => 'failed',
                'title'   => __('Can\'t login to your account'),
                'message' => $e->getMessage(),
            ]);
        }

        try {

            $response = $instagram->direct->getThread($thread_id, $request->cursor_id);

            $nextCursorId = $response->getThread()->getOldestCursor();
            $hasOlder     = $response->getThread()->getHasOlder();
            $users        = $response->getThread()->getUsers();
            $items        = $response->getThread()->getItems();
            $viewer_id    = $response->getThread()->getViewerId();

            $__users = [
                $viewer_id => [
                    'self'            => true,
                    'pk'              => $viewer_id,
                    'username'        => $account->username,
                    'full_name'       => null,
                    'profile_pic_url' => null,
                ],
            ];

            foreach ($users as $user) {
                $__users[$user->getPk()] = [
                    'self'            => false,
                    'pk'              => $user->getPk(),
                    'username'        => $user->getUsername(),
                    'full_name'       => $user->getFullName(),
                    'profile_pic_url' => $user->getProfilePicUrl(),
                ];
            }

            $__items = [];
            foreach ($items as $item) {

                if (isset($__users[$item->getUserId()])) {
                    $__items[] = [
                        'item' => $this->parseItem($item),
                        'raw'  => $item,
                        'user' => $__users[$item->getUserId()],
                    ];
                }
            }

            return response()->json([
                'result'         => 'success',
                'items'          => array_reverse($__items),
                'next_cursor_id' => $nextCursorId,
                'has_older'      => $hasOlder,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'result'  => 'failed',
                'title'   => __('Can\'t get thread details'),
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function send(Request $request, Account $account, $thread_id)
    {
        if ($request->filled('message') == false) {
            return response()->json([
                'result'  => 'failed',
                'title'   => __('Message text can\'t be empty'),
                'message' => $e->getMessage(),
            ]);
        }

        $instagram = new Instagram(config('pilot.debug'), config('pilot.truncatedDebug'), config('pilot.storageConfig'));

        if ($account->proxy) {
            $instagram->setProxy($account->proxy);
        }

        try {

            $instagram->login($account->username, $account->password);

        } catch (\Exception $e) {

            return response()->json([
                'result'  => 'failed',
                'title'   => __('Can\'t login to your account'),
                'message' => $e->getMessage(),
            ]);
        }

        try {

            $response = $instagram->direct->sendText([
                'thread' => $thread_id,
            ], $request->message);

            return response()->json([
                'result'   => 'success',
                'response' => $response,
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'result'  => 'failed',
                'title'   => __('Message not sent'),
                'message' => $e->getMessage(),
            ]);
        }
    }

    private function parseItem($item)
    {
        $render = null;

        switch ($item->getItemType()) {

            case 'media_share':

                $image           = null;
                $media_share     = $item->getMediaShare();
                $username        = $media_share->getUser()->getUsername();
                $profile_pic_url = $media_share->getUser()->getProfilePicUrl();
                $caption         = $media_share->getCaption()->getText();
                $code            = $media_share->getCode();

                if ($media_share->getCarouselMedia()) {
                    $image = $media_share->getCarouselMedia()[0]->getImageVersions2()->getCandidates()[0]->getUrl();
                }

                $render = '<div class="card col-sm-6 mt-2 p-3">';
                $render .= '    <div class="d-flex align-items-center px-2 mb-2">';
                $render .= '        <div class="avatar avatar-md mr-3" style="background-image: url(\'' . $profile_pic_url . '\')"></div>';
                $render .= '        <div class="media-body">';
                $render .= '            <a href="https://www.instagram.com/' . $username . '" target="_blank"><strong>' . $username . '</strong></a>';
                $render .= '        </div>';
                $render .= '    </div>';

                if (is_null($image) == false) {

                    $render .= '    <a href="https://www.instagram.com/p/' . $code . '" target="_blank" class="mb-3"><img src="' . $image . '" alt="" class="rounded"></a>';
                }

                $render .= '    <p><strong>' . $username . '</strong> ' . $caption . '</p>';
                $render .= '</div>';

                break;

            case 'story_share':

                $username        = null;
                $profile_pic_url = null;
                $image           = null;
                $url             = null;
                $story_share     = $item->getStoryShare();

                if ($story_share->getMessage()) {

                    $render = '<p><small class="text-muted">' . $story_share->getTitle() . ' &ndash; ' . $story_share->getMessage() . '</small></p>';

                } else {

                    if ($story_share->hasMedia()) {

                        if ($media = $story_share->getMedia()) {

                            if ($media->hasUser()) {

                                $user = $media->getUser();

                                $username        = $user->getUsername();
                                $profile_pic_url = $user->getProfilePicUrl();
                                //dd($user);
                            }

                            if ($media->hasImageVersions2()) {
                                $image = $media->getImageVersions2()->getCandidates()[0]->getUrl();
                            }

                            if ($media->getVideoVersions()) {
                                $url = $media->getVideoVersions()[0]->getUrl();
                            }
                        }

                    }

                    $render = '<div class="card col-sm-6 mt-2 p-3">';
                    $render .= '    <div class="d-flex align-items-center px-2 mb-2">';
                    $render .= '        <div class="avatar avatar-md mr-3" style="background-image: url(\'' . $profile_pic_url . '\')"></div>';
                    $render .= '        <div class="media-body">';
                    $render .= '            <a href="https://www.instagram.com/' . $username . '" target="_blank"><strong>' . $username . '</strong></a>';
                    $render .= '        </div>';
                    $render .= '    </div>';
                    $render .= '    <a href="' . $url . '" target="_blank"><img src="' . $image . '" alt="" class="rounded"></a>';
                    $render .= '</div>';
                }

                break;

            case 'text':

                $render = '<p>' . $item->getText() . '</p>';

                break;

            case 'placeholder':

                $render = '<p><small class="text-muted">' . $item->getPlaceholder()->getMessage() . '</small></p>';

                break;

            case 'like':

                $render = '<p><img src="' . asset('assets/img/icon-heart.svg') . '" width="64" height="64" alt="Like"></p>';

                break;

            case 'media':

                $url = $img = $item->getMedia()->getImageVersions2()->getCandidates()[0]->getUrl();

                if ($item->getMedia()->hasVideoVersions()) {
                    if (is_null($item->getMedia()->getVideoVersions()[0]) == false) {
                        $url = $item->getMedia()->getVideoVersions()[0]->getUrl();
                    }
                }

                $render = '<p><a href="' . $url . '" target="_blank"><img src="' . $img . '" width="33%" alt="" class="rounded"></a></p>';

                break;

            case 'raven_media':

                $render = '<p><span class="badge badge-default">' . __('Unsupported message format') . '</span></p>';

                break;

            case 'reel_share':

                $render = '<p><span class="badge badge-default">' . __('Unsupported message format') . '</span></p>';

                break;

            case 'link':

                $render = '<p>' . $item->getLink()->getText() . '</p>';

                break;

            default:

                $render = '<p><span class="badge badge-default">' . __('Unsupported message format') . '</span></p>';

                break;
        }

        return [
            'timestamp' => $item->getTimestamp(),
            'message'   => $render,
        ];
    }
}
