<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\Payments;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function initiatePayment(Request $request)
    {
        // Validate input data
        $request->validate([
            'request_truck_id' => 'required|exists:request_trucks,id',
            'transporter_id' => 'required|exists:transporters,id',
            'amount' => 'required|numeric|min:1',
        ]);

        // Fetch the customer ID from the session
        $customerID = session('customer_id'); // Ensure this is an integer
        $requestTruckId = $request->input('request_truck_id');
        $amount = $request->input('amount');

        Session::put('request_truck_id', $requestTruckId);

        // Create a new payment record
        $payment = Payments::create([
            'customer_id' => $customerID, // This should be an integer
            'transporter_id' => $request->input('transporter_id'),
            'request_truck_id' => $requestTruckId,
            'amount' => $amount,
            'payment_status' => 'pending',
        ]);

        // Create Razorpay Order
        $api = new Api("rzp_test_VgsfHLzyQVgNL1", "cbUSJg2SygJyQBwlo8uNMhkD");

        $order = $api->order->create([
            'receipt' => (string) $payment->id, // Ensure receipt is a string
            'amount' => (int) ($amount * 100), // Ensure amount is an integer in paise
            'currency' => 'INR' // Ensure currency is a string
        ]);

        // Store Razorpay order ID and payment ID in session
        Session::put('razorpay_order_id', $order['id']);
        Session::put('payment_id', $payment->id);

        // Return the checkout view
        return view('customer.checkout', compact('order', 'payment'));
    }


    public function handleCallback(Request $request)
    {
        // Verify the payment and update the payment status in the database
        $attributes = $request->all();
        $signatureStatus = $this->verifySignature($attributes);

        if ($signatureStatus) {
            $payment = Payments::find(Session::get('payment_id'));
            $payment->payment_status = 'successful';
            $payment->transaction_id = $attributes['razorpay_payment_id'];
            $payment->save();

            // Clear session data
            Session::forget(['razorpay_order_id']);

            $requestTruckId = Session::get('request_truck_id');

            return redirect()->route('payment.success')->with('success', 'Payment Done Successfully!');
        } else {
            return redirect()->route('customer.request.detail', $request->id)->with('error', 'Payment Failed!');
        }
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

    public function showInvoice($id)
    {
        $payment = Payments::findOrFail($id);

        if ($payment->payment_status == 'successful') {
            return view('customer.invoice', compact('payment'));
        } else {
            return redirect()->back()->with('error', 'Invoice not available for unpaid transactions.');
        }
    }

    public function showInvoiceTransporter($id)
    {
        $payment = Payments::with('requestTruck')->findOrFail($id);

        // dd($payment);

        if ($payment->payment_status == 'successful') {
            return view('transporter.invoice', compact('payment'));
        } else {
            return redirect()->back()->with('error', 'Invoice not available for unpaid transactions.');
        }
    }
}
