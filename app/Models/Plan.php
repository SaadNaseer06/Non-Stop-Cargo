<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'leads_limit', 'razorpay_plan_id', 'features'];


    // public function createRazorpayPlan()
    // {
    //     $api = new Api(env('RAZORPAY_KEY_ID'), env('RAZORPAY_KEY_SECRET'));

    //     $planData = [
    //         'period' => 'monthly', // Subscription cycle: daily, weekly, monthly, etc.
    //         'interval' => 1, // Interval between subscription charges
    //         'item' => [
    //             'name' => $this->name,
    //             'amount' => $this->price * 100, // Amount in paise
    //             'currency' => 'INR',
    //             'description' => $this->leads_limit . ' Leads Per Month',
    //         ],
    //     ];

    //     $razorpayPlan = $api->plan->create($planData);
    //     $this->razorpay_plan_id = $razorpayPlan->id;
    //     $this->save();
    // }

    public function createRazorpayPlan()
    {
        try {

            $featuresList = implode("\n- ", explode(',', $this->features));
            $featuresList = '- ' . $featuresList;

            $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");
            $planData = [
                'period' => 'monthly',
                'interval' => 1,
                'item' => [
                    'name' => $this->name,
                    'amount' => $this->price * 100, // Price in paise
                    'currency' => 'INR',
                    'description' => $this->featuresList, // Using the detailed features here
                ],
            ];

            $razorpayPlan = $api->plan->create($planData);
            $this->razorpay_plan_id = $razorpayPlan->id;
            $this->save();
        } catch (\Exception $e) {
            Log::error('Razorpay Plan Creation Error: ' . $e->getMessage());
            throw $e;
        }
    }

    // public function deactivateRazorpayPlan()
    // {
    //     try {
    //         $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");
    //         $plan = $api->plan->fetch($this->razorpay_plan_id);
    //         $plan->delete();
    //         $this->update(['is_active' => false]);
    //     } catch (\Exception $e) {
    //         Log::error('Razorpay Plan Deactivation Error: ' . $e->getMessage());
    //         throw $e;
    //     }
    // }


    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
