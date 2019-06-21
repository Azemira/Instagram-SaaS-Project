<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Stripe\Plan;
use Stripe\Stripe;

class BillingController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $packages                      = Package::all();
        $subscription_subscribed       = $user->subscribed('main');
        $subscription_on_generic_trial = $user->onGenericTrial();
        $subscription_on_trial         = $user->onTrial();
        $subscription_on_grace_period  = $subscription_subscribed ? $user->subscription('main')->onGracePeriod() : false;
        $subscription_ended            = $subscription_subscribed ? $user->subscription('main')->ended() : false;
        $currency_code                 = config('pilot.CURRENCY_CODE');
        $currency_symbol               = config('pilot.CURRENCY_SYMBOL');

        return view('billing.index', compact(
            'packages',
            'subscription_subscribed',
            'subscription_on_generic_trial',
            'subscription_on_trial',
            'subscription_on_grace_period',
            'subscription_ended',
            'currency_code',
            'currency_symbol'
        ));
    }

    public function purchase(Request $request, Package $package)
    {
        $request->validate([
            'stripeToken'     => 'required',
            'stripeTokenType' => 'required',
            'stripeEmail'     => 'required|email',
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        // Check plan existence
        try {

            Plan::retrieve($package->plan_id);

        } catch (\Exception $e) {

            // Try to create a plan if not exists
            try {

                Plan::create([
                    'id'       => $package->plan_id,
                    'currency' => config('pilot.CURRENCY_CODE'),
                    'amount'   => $package->price * 100,
                    'interval' => $package->interval,
                    'product'  => [
                        'name' => $package->title,
                    ],
                ]);

            } catch (\Exception $e) {

                return redirect()->route('billing.index')
                    ->with('error', __('Can\'t create Stripe plan: ') . $e->getMessage());

            }
        }

        // Try to subsribe user to selected plan
        try {

            $user = $request->user();

            // Swap plan if recurring
            if ($user->subscription('main') && $user->subscription('main')->recurring()) {

                $user->subscription('main')->swap($package->plan_id);

            } else {

                $user->newSubscription('main', $package->plan_id)
                    ->trialDays(config('pilot.TRIAL_DAYS'))
                    ->create($request->stripeToken, [
                        'email' => $user->email,
                        'name'  => $user->name,
                    ]);
            }

            // Update active package
            $user->trial_ends_at = null;
            $user->package_id    = $package->id;
            $user->save();

            return redirect()->route('billing.index')
                ->with('success', __('Thank you for your payment! Your subscription is activated successfully.'));

        } catch (\Exception $e) {

            return redirect()->route('billing.index')
                ->with('error', $e->getMessage());

        }

    }

    public function cancel(Request $request)
    {
        try {

            $request->user()->subscription('main')->cancel();

            return redirect()->route('billing.index')
                ->with('success', __('Your subscription has been successfully canceled.'));

        } catch (\Exception $e) {

            return redirect()->route('billing.index')
                ->with('error', $e->getMessage());

        }
    }

    public function invoices(Request $request)
    {
        $invoices = $request->user()->invoices();

        return view('billing.invoices', compact(
            'invoices'
        ));
    }

    public function download_invoice(Request $request, $invoice_id)
    {
        return $request->user()->downloadInvoice($invoice_id, [
            'vendor'  => config('app.name'),
            'product' => 'Paid Services',
        ]);
    }

}
