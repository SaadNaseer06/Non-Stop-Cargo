<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\SubscriptionPayments;
use App\Models\Transporters;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class SubscriptionController extends Controller
{
    public function showPlans()
    {
        $title = "Subscription";

        $plans = Plan::all();

        // $transporter = Transporters::find(session('transporter_id'));

        $transporterId = session('transporter_id');

        // $subscriptions = Subscription::where('transporter_id', $transporter->id)->pluck('plan_id')->toArray();

        $subscriptions = Subscription::where('transporter_id', $transporterId)->get(['plan_id', 'status']);

        return view('transporter.subscription.plans', compact('plans', 'title', 'subscriptions'));
    }

    // public function createSubscription(Request $request)
    // {
    //     $request->validate([
    //         'plan_id' => 'required|exists:plans,id',
    //     ]);

    //     $plan = Plan::find($request->plan_id);
    //     $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");

    //     // Create a Razorpay Subscription
    //     $subscription = $api->subscription->create([
    //         'plan_id' => $plan->razorpay_plan_id,
    //         'customer_notify' => 1,
    //         'quantity' => 1,
    //         'total_count' => 12, // e.g., for a monthly subscription, this means 1 year
    //     ]);

    //     $transporter = Transporters::find(session('transporter_id'));

    //     Subscription::create([
    //         'transporter_id' => $transporter->id,
    //         'plan_id' => $plan->id,
    //         'subscription_id' => $subscription->id,
    //         'status' => 'active',
    //         'start_date' => now(),
    //         'end_date' => now()->addMonths(1),
    //     ]);

    //     return redirect()->back()->with('success', 'Subscription created successfully!');
    // }

    public function createSubscription(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $plan = Plan::find($request->plan_id);
        $transporter = Transporters::find(session('transporter_id'));

        // Initiate Razorpay Payment
        $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");

        $order = $api->order->create([
            'receipt' => 'order_' . time(),
            'amount' => (int) ($plan->price * 100), // Convert to paise
            'currency' => 'INR'
        ]);

        // Store payment details in session or database
        Session::put('razorpay_order_id', $order['id']);
        Session::put('plan_id', $plan->id);

        // Return to checkout view
        return view('transporter.subscription.checkout', compact('order', 'plan'));
    }

    public function subscriptionCallBack(Request $request)
    {
        $attributes = $request->all();
        $signatureStatus = $this->verifySignature($attributes);

        if ($signatureStatus) {
            $transporter = Transporters::find(session('transporter_id'));
            $plan = Plan::find(Session::get('plan_id'));

            // Create Razorpay Subscription
            $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");
            $subscription = $api->subscription->create([
                'plan_id' => $plan->razorpay_plan_id,
                'customer_notify' => 1,
                'quantity' => 1,
                'total_count' => 12, // e.g., for a monthly subscription, this means 1 year
            ]);

            // Save Subscription ID to session
            Session::put('subscription_id', $subscription->id);

            // Create Subscription Record in the database
            Subscription::create([
                'transporter_id' => $transporter->id,
                'plan_id' => $plan->id,
                'subscription_id' => $subscription->id,
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addMonths(1),
            ]);

            try {
                SubscriptionPayments::create([
                    'transporter_id' => $transporter->id,
                    'plan_id' => $plan->id,
                    'razorpay_order_id' => $attributes['razorpay_order_id'],
                    'razorpay_payment_id' => $attributes['razorpay_payment_id'],
                    'payment_status' => 'success',
                    'amount' => $plan->price
                ]);
            } catch (\Exception $e) {
                Log::error('SubscriptionPayment creation failed: ' . $e->getMessage());
            }

            // Clear session data
            Session::forget(['razorpay_order_id']);

            return redirect()->route('subscription.success')->with('success', 'Subscription created successfully!');
        } else {
            return redirect()->route('subscriptions')->with('error', 'Payment Failed!');
        }
    }

    public function successSubscription()
    {
        $planId = session('plan_id');
        $plan = Plan::find($planId);
        $subscriptionId = session('subscription_id');

        return view('transporter.subscription.success', compact('plan', 'subscriptionId'));
    }

    private function verifySignature($attributes)
    {
        $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");

        $orderId = $attributes['razorpay_order_id'];
        $razorpaySignature = $attributes['razorpay_signature'];
        $razorpayPaymentId = $attributes['razorpay_payment_id'];

        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $orderId,
                'razorpay_payment_id' => $razorpayPaymentId,
                'razorpay_signature' => $razorpaySignature,
            ]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function handleWebhook(Request $request)
    {
        // Retrieve the payload from the request
        $payload = $request->all();

        // Log the payload for debugging (optional)
        Log::info('Webhook received:', $payload);

        // Handle different webhook events
        switch ($payload['event']) {
            case 'subscription.completed':
                $this->handleSubscriptionCompleted($payload['payload']);
                break;

            case 'subscription.charged':
            case 'subscription.renewed':
                $this->handleSubscriptionChargedOrRenewed($payload['payload']);
                break;

            case 'subscription.paused':
            case 'subscription.cancelled':
                $this->handleSubscriptionPausedOrCancelled($payload['payload']);
                break;

            default:
                // Handle other events or log that the event is unhandled
                Log::warning('Unhandled webhook event: ' . $payload['event']);
                break;
        }

        // Return a response to acknowledge receipt of the webhook
        return response()->json(['status' => 'success'], 200);
    }

    protected function handleSubscriptionCompleted($payload)
    {
        $subscriptionId = $payload['subscription']['entity']['id'];

        // Find the subscription by its ID
        $subscription = Subscription::where('subscription_id', $subscriptionId)->first();

        if ($subscription) {
            $subscription->status = 'active';
            $subscription->save();

            // Log the success
            Log::info("Subscription {$subscriptionId} marked as active.");
        } else {
            // Log the failure
            Log::error("Subscription {$subscriptionId} not found.");
        }
    }

    protected function handleSubscriptionChargedOrRenewed($payload)
    {
        $subscriptionId = $payload['subscription']['entity']['id'];

        // Find the subscription by its ID
        $subscription = Subscription::where('subscription_id', $subscriptionId)->first();

        if ($subscription) {
            // Handle the successful charge or renewal
            // Example: Update the status, record the payment, etc.
            $subscription->status = 'active';
            $subscription->save();

            // Log the success
            Log::info("Subscription {$subscriptionId} charged or renewed.");
        } else {
            // Log the failure
            Log::error("Subscription {$subscriptionId} not found for charging or renewal.");
        }
    }

    protected function handleSubscriptionPausedOrCancelled($payload)
    {
        $subscriptionId = $payload['subscription']['entity']['id'];

        // Find the subscription by its ID
        $subscription = Subscription::where('subscription_id', $subscriptionId)->first();

        if ($subscription) {
            // Handle the paused or canceled subscription
            // Example: Update the status, notify the user, etc.
            $subscription->status = $payload['event'] == 'subscription.paused' ? 'paused' : 'cancelled';
            $subscription->save();

            // Log the success
            Log::info("Subscription {$subscriptionId} {$payload['event']}.");
        } else {
            // Log the failure
            Log::error("Subscription {$subscriptionId} not found for pausing or cancelling.");
        }
    }


    // for subscription management for admin
    public function index()
    {
        $title = "Subscriptions";

        // Get all subscriptions with transporter and plan details
        $subscriptions = Subscription::with(['plan', 'transporter'])->get();

        return view('admin.subscriptions.index', compact('title', 'subscriptions'));
    }

    public function cancelSubscription(Request $request, $id)
    {
        $subscription = Subscription::find($id);

        if ($subscription && $subscription->status === 'active') {
            $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");

            try {
                // Cancel the subscription on Razorpay
                $razorpaySubscription = $api->subscription->fetch($subscription->subscription_id);
                $razorpaySubscription->cancel();

                // Update the status in the local database
                $subscription->status = 'cancelled';
                $subscription->save();

                return redirect()->back()->with('success', 'Subscription cancelled successfully.');
            } catch (\Exception $e) {
                // Log the error and return an error response
                Log::error('Razorpay Subscription Cancellation Failed: ' . $e->getMessage());

                return redirect()->back()->with('error', 'Failed to cancel the subscription. Please try again.');
            }
        }

        return redirect()->back()->with('error', 'Subscription not found or is not active.');
    }
}
