<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class PlanController extends Controller
{
    public function index()
    {
        $title = "Plans";

        $plans = Plan::all();

        return view('admin.plans.index', compact('title', 'plans'));
    }

    public function create()
    {
        return view('admin.plans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'leads_limit' => 'required|integer|min:1',
            'features' => 'required|string',
        ]);

        $plan = Plan::create($request->only('name', 'price', 'leads_limit', 'features'));
        $plan->createRazorpayPlan();

        return redirect()->route('plans.index')->with('success', 'Plan created successfully!');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'leads_limit' => 'required|integer|min:1',
            'features' => 'required|string',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update($request->only('name', 'price', 'leads_limit', 'features'));

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully!');
    }

    // public function deactivate($id)
    // {
    //     try {
    //         $plan = Plan::findOrFail($id);

    //         $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");
    //         $razorpayPlan = $api->plan->fetch($plan->razorpay_plan_id);

    //         $razorpayPlan->delete();  // Razorpay doesn't support direct deactivation of plans, deleting it for simplicity
    //         $plan->update(['is_active' => false]);  // Mark the plan as inactive in your local DB

    //         return redirect()->route('plans.index')->with('success', 'Plan deactivated successfully!');
    //     } catch (\Exception $e) {
    //         Log::error('Razorpay Plan Deactivation Error: ' . $e->getMessage());
    //         return redirect()->route('plans.index')->with('error', 'Failed to deactivate the plan.');
    //     }
    // }

    // public function destroy($id)
    // {
    //     $plan = Plan::findOrFail($id);
    //     $plan->delete();
    //     return redirect()->route('plans.index')->with('success', 'Plan deleted successfully!');
    // }
}
