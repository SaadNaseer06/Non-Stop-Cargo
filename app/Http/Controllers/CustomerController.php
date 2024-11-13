<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Customer;
use App\Mail\CustomerEmail;
use App\Models\Bid;
use App\Models\Customers;
use App\Models\Messages;
use App\Models\Payments;
use App\Models\RequestTruck;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use League\Csv\Reader;

class CustomerController extends Controller
{
    public function login()
    {
        $title = "Login";

        $data = compact('title');

        return view('customer.login')->with($data);
    }

    public function loginCheck(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        try {

            $email = $request->email;
            $password = $request->password;

            $customer = Customers::where("email", $email)->exists();


            if ($customer == true) {

                $login = Customers::where("email", $email)->first();

                if (Hash::check($password, $login->password)) {

                    session()->put("customer_id", $login->id);

                    // full load
                    if (session()->has('pending_request')) {
                        $pendingRequest = session('pending_request');

                        RequestTruck::create([
                            'type' => $pendingRequest['type'],
                            'weight' => $pendingRequest['weight'],
                            'quantity' => $pendingRequest['quantity'],
                            'origin' => $pendingRequest['origin'],
                            'destination' => $pendingRequest['destination'],
                            'material' => $pendingRequest['material'],
                            'schedule_date' => $pendingRequest['schedule_date'],
                            'distance' => $pendingRequest['distance'],
                            'time' => $pendingRequest['time'],
                            'customer_id' => $login->id,
                            'bidding_ends_at' => now()->addMinutes(2),
                        ]);

                        session()->forget('pending_request');

                        return redirect()->route('customer.index')->with('success', 'Request submitted successfully after login!');
                    }

                    // part load
                    if (session()->has('pending_request_part')) {
                        $pendingRequestPart = session('pending_request_part');

                        RequestTruck::create([
                            'origin' => $pendingRequestPart['origin'],
                            'destination' => $pendingRequestPart['destination'],
                            'source_pin' => $pendingRequestPart['source_pin'],
                            'destination_pin' => $pendingRequestPart['destination_pin'],
                            'pickup_type' => $pendingRequestPart['pickup_type'],
                            'material' => $pendingRequestPart['material'],
                            'weight' => $pendingRequestPart['weight'],
                            'pickup_date' => $pendingRequestPart['pickup_date'],
                            'distance' => $pendingRequestPart['distance'],
                            'time' => $pendingRequestPart['time'],
                            'customer_id' => $login->id,
                            'bidding_ends_at' => now()->addMinutes(2),
                        ]);

                        session()->forget('pending_request_part');

                        return redirect()->route('customer.index')->with('success', 'Request submitted successfully after login!');
                    }

                    return redirect()->route("customer.index")->with("success", "Logged In successfully.");
                } else {

                    return redirect()->back()->with("error", "Invalid credentials. Please try again.");
                }
            } else {

                return redirect()->back()->with("error", "Invalid credentials. Please try again.");
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong. Please try again later.");
        }
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'weight' => 'required|string',
            'quantity' => 'required|string',
            'origin' => 'required|string',
            'destination' => 'required|string',
            'material' => 'required|string',
            'schedule_date' => 'required|date',
            'distance' => 'nullable',
            'time' => 'nullable',
        ]);

        $customer_id = session('customer_id');

        if (!$customer_id) {
            session()->put('pending_request', $request->all());

            return redirect()->route('customer.login')->with('error', 'Please log in to submit a request.');
        }

        try {
            // Debugging: Log request data
            Log::info('Request Data:', $request->all());

            RequestTruck::create([
                'type' => $request->type,
                'weight' => $request->weight,
                'quantity' => $request->quantity,
                'origin' => $request->origin,
                'destination' => $request->destination,
                'material' => $request->material,
                'schedule_date' => $request->schedule_date,
                'distance' => $request->distance,
                'time' => $request->time,
                'customer_id' => $customer_id,
                'bidding_ends_at' => now()->addMinutes(2),
            ]);

            return redirect()->route('customer.index')->with('success', 'Request submitted successfully!');
        } catch (\Throwable $th) {
            // Log error
            Log::error('Submission Error:', ['error' => $th->getMessage()]);

            return redirect()->route('customer.index')->with('error', 'Something went wrong. Please try again later.');
        }
    }


    public function submitRequestPart(Request $request)
    {
        $request->validate([
            'origin' => 'required|string',
            'destination' => 'required|string',
            'source_pin' => 'required',
            'destination_pin' => 'required',
            'pickup_type' => 'required',
            'material' => 'required',
            'weight' => 'required|string',
            'pickup_date' => 'required',
            'distance' => 'nullable',
            'time' => 'nullable',
        ]);

        // Verify source pincode against the origin city
        $sourceVerification = $this->verifyPincodeBelongsToCity($request->source_pin, $request->origin);
        if (!$sourceVerification['status']) {
            return redirect()->back()->with('error', $sourceVerification['msg']);
        }

        // Verify destination pincode against the destination city
        $destinationVerification = $this->verifyPincodeBelongsToCity($request->destination_pin, $request->destination);
        if (!$destinationVerification['status']) {
            return redirect()->back()->with('error', $destinationVerification['msg']);
        }


        $customer_id = session('customer_id');

        if (!$customer_id) {
            session()->put('pending_request_part', $request->all());

            return redirect()->route('customer.login')->with('error', 'Please log in to submit a request.');
        }

        try {
            RequestTruck::create([
                'origin' => $request->origin,
                'destination' => $request->destination,
                'source_pin' => $request->source_pin,
                'destination_pin' => $request->destination_pin,
                'pickup_type' => $request->pickup_type,
                'material' => $request->material,
                'weight' => $request->weight,
                'pickup_date' => $request->pickup_date,
                'distance' => $request->distance,
                'time' => $request->time,
                'customer_id' => $customer_id,
                'bidding_ends_at' => now()->addMinutes(2), // Add bidding end time
            ]);

            return redirect()->route('customer.index')->with('success', 'Request submitted successfully!');
        } catch (\Throwable $th) {
            return redirect()->route('customer.index')->with('error', 'Something went wrong. Please try again later.');
        }
    }

    public function register()
    {
        $title = "Register";

        $data = compact('title');

        return view('customer.register')->with($data);
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "phone" => 'required',
            "email" => 'required|email|unique:customers,email,',
            "password" => 'required|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        try {

            $customer = new Customers;

            $image = null;
            if ($request->hasFile('image')) {
                $image = time() . '.' . $request->image->extension();
                $request->image->move(public_path('Customer/profile/image'), $image);
            }

            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->password = Hash::make($request->password);
            $customer->image = $image;

            $emailOtp = rand(100000, 999999);
            $phoneOtp = rand(100000, 999999);

            // Log OTPs for debugging
            Log::info("Generated OTPs: Email OTP = {$emailOtp}, Phone OTP = {$phoneOtp}");

            // OTP send on mobile number
            $smsSent = OtpService::sendSms($request->phone, $phoneOtp);

            if (!$smsSent) {
                return redirect()->back()->with('error', 'Failed to send OTP. Please try again.');
            }

            // Store OTP for verification
            // OtpService::storeOtp($request->phone, $phoneOtp);
            // store email OTP
            $customer->phone_otp = $phoneOtp;
            $customer->phone_otp_expires_at = now()->addMinutes(5);
            $customer->email_otp = $emailOtp;
            $customer->save();

            Mail::to($request->email)->send(new CustomerEmail($emailOtp));

            // try {
            //     $to = $request->email;
            //     $subject = "Your Email Verification Code";
            //     $message = "Your verification code is: " . $emailOtp;
            //     $headers = "From: " . config('mail.from.address');

            //     if (!mail($to, $subject, $message, $headers)) {
            //         return redirect()->back()->with('error', 'Failed to send verification email.');
            //     }
            // } catch (\Exception $e) {
            //     Log::error('Error sending email: ' . $e->getMessage());
            //     return redirect()->back()->with('error', 'Failed to send verification email.');
            // }

            session(['customer_id' => $customer->id, 'phone' => $request->phone]);

            // full load
            if (session()->has('pending_request')) {
                $pendingRequest = session('pending_request');

                RequestTruck::create([
                    'type' => $pendingRequest['type'],
                    'weight' => $pendingRequest['weight'],
                    'quantity' => $pendingRequest['quantity'],
                    'origin' => $pendingRequest['origin'],
                    'destination' => $pendingRequest['destination'],
                    'material' => $pendingRequest['material'],
                    'schedule_date' => $pendingRequest['schedule_date'],
                    'distance' => $pendingRequest['distance'],
                    'time' => $pendingRequest['time'],
                    'customer_id' => $customer->id,
                    'bidding_ends_at' => now()->addMinutes(2),
                ]);

                session()->forget('pending_request');

                return redirect()->route('customer.index')->with('success', 'Request submitted successfully after login!');
            }

            // part load
            if (session()->has('pending_request_part')) {
                $pendingRequestPart = session('pending_request_part');

                RequestTruck::create([
                    'origin' => $pendingRequestPart['origin'],
                    'destination' => $pendingRequestPart['destination'],
                    'source_pin' => $pendingRequestPart['source_pin'],
                    'destination_pin' => $pendingRequestPart['destination_pin'],
                    'pickup_type' => $pendingRequestPart['pickup_type'],
                    'material' => $pendingRequestPart['material'],
                    'weight' => $pendingRequestPart['weight'],
                    'pickup_date' => $pendingRequestPart['pickup_date'],
                    'distance' => $pendingRequestPart['distance'],
                    'time' => $pendingRequestPart['time'],
                    'customer_id' => $customer->id,
                    'bidding_ends_at' => now()->addMinutes(2),
                ]);

                session()->forget('pending_request_part');

                return redirect()->route('customer.index')->with('success', 'Request submitted successfully after login!');
            }

            return redirect()->route('customer.email.verify.page')->with('success', 'Please verify your email and phone number to continue!');
        } catch (\Throwable $th) {
            Log::error('Error during registration: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            // $phone = session('phone');
            $phone = session('phone');

            if (!$phone) {
                return response()->json(['error' => 'Phone number is not available.']);
            }

            // Attempt to resend OTP
            $otpResent = OtpService::resendOtpCustomer($phone);

            if ($otpResent) {
                return response()->json(['success' => 'OTP has been resent successfully.']);
            } else {
                return response()->json(['error' => 'Failed to resend OTP or OTP is still valid.']);
            }
        } catch (\Exception $e) {
            Log::error('Error resending OTP: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong! ' . $e->getMessage()]);
        }
    }

    public function emailVerificationPage()
    {
        $title = "Verify Email";

        $data = compact('title');

        return view('customer.verify-email')->with($data);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
        ]);

        $customer = Customers::where('email_otp', $request->verification_code)->first();

        if ($customer) {
            $customer->email_verified = true;
            $customer->save();

            return redirect()->route('customer.phone.verify.page')->with('success', 'Email verified successfully. Please verify your phone number to continue.. ');
        }

        return redirect()->back()->with('error', 'Invalid Email verification code.');
    }

    public function phoneVerificationPage()
    {
        $title = "Verify Phone Number";

        $phone = session('phone');

        // dd($phone);

        $data = compact('title', 'phone');

        return view('customer.verify-phone')->with($data);
    }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        $customerId = session('customer_id');
        $customer = Customers::find($customerId);

        if (!$customer) {
            return redirect()->route('customer.register')->with('error', 'Customer not found.');
        }

        $verificationStatus = OtpService::verifyOtp($customer->phone, $request->otp);

        if ($verificationStatus) {
            $customer->phone_verified_at = now();
            $customer->phone_verified = true;
            $customer->save();

            // Redirect to dashboard or any other page
            return redirect()->route('customer.index')->with('success', 'Phone number verified successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }

    public function logout()
    {
        try {

            session()->forget("customer_id");

            return redirect()->back()->with("success", "Loggedout successfully.");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong. Please try again later.");
        }
    }

    public function index()
    {
        $title = "Dashboard";

        $truck = RequestTruck::where('customer_id', session('customer_id'))->latest()->get();

        $data = compact('title', 'truck');

        return view('customer.index')->with($data);
    }

    public function truckRequest()
    {
        $title = "Truck Requests";

        $truck = RequestTruck::where('customer_id', session('customer_id'))->latest()->get();

        $data = compact('title', 'truck');

        return view('customer.truck-request')->with($data);
    }

    public function addTruckRequest()
    {
        $title = "Add Truck Request";

        $data = compact('title');

        return view('customer.add-truck-request')->with($data);
    }

    public function addRequest(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'weight' => 'required',
            'quantity' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'material' => 'required',
            'schedule_date' => 'required',
            'distance' => 'nullable',
            'time' => 'nullable',
        ]);

        try {
            $new = new RequestTruck;

            $new->customer_id = session('customer_id');
            $new->type = $request->type;
            $new->weight = $request->weight;
            $new->quantity = $request->quantity;
            $new->origin = $request->origin;
            $new->destination = $request->destination;
            $new->material = $request->material;
            $new->schedule_date = $request->schedule_date;
            $new->bidding_ends_at = now()->addMinutes(2);
            $new->distance = $request->distance;
            $new->time = $request->time;

            $new->save();

            return redirect()->route('customer.truck.request')->with('success', "Truck Request has been submitted!");
        } catch (\Throwable $th) {
            return redirect()->route('customer.add.truck.request')->with('error', "Something went wrong please try again later!");
        }
    }

    public function addRequestPart(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'source_pin' => 'required',
            'destination_pin' => 'required',
            'pickup_type' => 'required',
            'material' => 'required',
            'weight' => 'required',
            'pickup_date' => 'required',
            'distance' => 'nullable',
            'time' => 'nullable',
        ]);

        try {
            // // Load the CSV data
            // $pincodes = $this->loadPincodeCSV();

            // // Verify Source Pincode
            // $source_verification = $this->verifyPincode($request->source_pin, $pincodes);
            // if (!$source_verification['status']) {
            //     return redirect()->back()->with('error', "Source Pincode is invalid: " . $source_verification['msg']);
            // }

            // // Verify Destination Pincode
            // $destination_verification = $this->verifyPincode($request->destination_pin, $pincodes);
            // if (!$destination_verification['status']) {
            //     return redirect()->back()->with('error', "Destination Pincode is invalid: " . $destination_verification['msg']);
            // }

            //

            // Verify source pincode against the origin city
            $sourceVerification = $this->verifyPincodeBelongsToCity($request->source_pin, $request->origin);
            if (!$sourceVerification['status']) {
                return redirect()->back()->with('error', $sourceVerification['msg']);
            }

            // Verify destination pincode against the destination city
            $destinationVerification = $this->verifyPincodeBelongsToCity($request->destination_pin, $request->destination);
            if (!$destinationVerification['status']) {
                return redirect()->back()->with('error', $destinationVerification['msg']);
            }

            $new = new RequestTruck;

            $new->customer_id = session('customer_id');
            $new->origin = $request->origin;
            $new->destination = $request->destination;
            $new->source_pin = $request->source_pin;
            $new->destination_pin = $request->destination_pin;
            $new->pickup_type = $request->pickup_type;
            $new->material = $request->material;
            $new->weight = $request->weight;
            $new->pickup_date = $request->pickup_date;
            $new->bidding_ends_at = now()->addMinutes(2);
            $new->distance = $request->distance;
            $new->time = $request->time;

            $new->save();

            return redirect()->route('customer.truck.request')->with('success', "Truck Request has been submitted!");
        } catch (\Throwable $th) {
            return redirect()->route('customer.add.truck.request')->with('error', "Something went wrong please try again later!");
        }
    }

    public function deleteRequest($id)
    {
        $truck = RequestTruck::find($id);
        $truck->delete();

        return redirect()->back()->with('success', 'Truck Request has been deleted successfully!');
    }

    public function updateRequest($id)
    {
        $title = "Update Truck Request";

        $truck = RequestTruck::find($id);

        $data = compact('title', 'truck');

        return view('customer.update-truck-request')->with($data);
    }

    public function updateTruck($id, Request $request)
    {
        $request->validate([
            'type' => 'required',
            'weight' => 'required',
            'quantity' => 'required',
            'origin' => 'required',
            'destination' => 'required',
        ]);

        try {
            $new = RequestTruck::find($id);

            $new->customer_id = session('customer_id');
            $new->type = $request->type;
            $new->weight = $request->weight;
            $new->quantity = $request->quantity;
            $new->origin = $request->origin;
            $new->destination = $request->destination;

            $new->save();

            return redirect()->route('customer.truck.request')->with('success', "Truck Request has been submitted!");
        } catch (\Throwable $th) {
            return redirect()->route('customer.update.truck.request')->with('error', "Something went wrong please try again later!");
        }
    }

    public function requestBids()
    {
        $title = "Request Bids";

        $truck = RequestTruck::where('customer_id', session('customer_id'))->latest()->get();

        $data = compact('title', 'truck');

        return view('customer.requestbids')->with($data);
    }

    public function allBids($id)
    {
        $title = "All Bids";

        // $truck = RequestTruck::where('customer_id', session('customer_id'))->latest()->get();

        $allbids = Bid::with('transporter')->where('bid_id', $id)->latest()->get();

        $data = compact('title', 'allbids');

        return view('customer.allbids')->with($data);
    }

    public function requestDetail($id)
    {
        $title = "Request Details";

        $truck = RequestTruck::with('winingbid')->where('id', $id)->latest()->get();

        // $winingbid = Bid::where('id', $id)->latest()->get();

        $payment = Payments::where('request_truck_id', $id)
            ->orderBy('created_at', 'desc')
            ->first();

        $customer = Customers::find(session('customer_id'));

        // dd($customer);

        $data = compact('title', 'truck', 'payment', 'customer');

        return view('customer.request-detail')->with($data);
    }

    public function profile()
    {
        $title = "Profile";

        $customer = Customers::find(session('customer_id'));

        $data = compact('title', 'customer');

        return view('customer.profile')->with($data);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "phone" => 'required',
            // "email" => 'required|email|unique:admins,email,' . session('customer_id'),
            "password" => 'nullable|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        try {

            $customer = Customers::find(session('customer_id'));

            $customer->name = $request->name;
            $customer->phone = $request->phone;
            // $admin->email = $request->email;

            if ($request->filled('password')) {
                $customer->password = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                $imageFile = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('Customer/profile/image'), $imageFile);
                $customer->image = $imageFile;
            }

            $customer->save();

            return redirect()->route('customer.index')->with('success', 'Your Profile has been Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something Wrong !');
        }
    }

    public function chat($id)
    {

        $title = "Chat";

        $message = Messages::where('request_id', $id)->first();

        $truck = RequestTruck::with('winingbid')->find($id);

        $data = compact('title', 'message', 'id', 'truck');

        return view('customer.chat')->with($data);
    }

    public function aadhaarVerficationPage($id)
    {
        $title = "Verify Aadhaar";

        $customer = Customers::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        $data = compact('title', 'customer');

        return view('customer.verify-aadhaar')->with($data);
    }

    public function sendOtp(Request $request, $id)
    {
        $request->validate([
            'aadhaar_number' => 'required|numeric|digits:12',
        ]);

        $client = new \GuzzleHttp\Client();

        $aadhaarNumber = $request->aadhaar_number;

        try {
            $response = $client->request('POST', 'https://uat.apiclub.in/api/v1/aadhaar_v2/send_otp', [
                'headers' => [
                    'Referer' => 'docs.apiclub.in',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'x-api-key' => "892c191cfd3e2509eeb11b6326288eb1",
                ],
                'json' => [
                    'aadhaar_no' => $aadhaarNumber,
                ],
            ]);

            $responseData = $response->getBody()->getContents();
            $responseData = json_decode($responseData, true);

            if ($response->getStatusCode() == 200 && $responseData['status'] === 'success') {

                $customer = Customers::where('id', $id)->first();
                $customer->aadhaar_number = $aadhaarNumber;
                $customer->save();

                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully',
                    'token' => $responseData['response']['ref_id']
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $responseData['message'] ?? 'Failed to send OTP'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }

    public function verifyOtp(Request $request, $id)
    {
        $request->validate([
            'aadhaar_token' => 'required|string',
            'otp' => 'required|numeric|digits:6', // Assuming OTP is 6 digits
        ]);

        $client = new \GuzzleHttp\Client();
        $aadhaarToken = $request->aadhaar_token;
        $otp = $request->otp;

        try {
            $response = $client->request('POST', 'https://uat.apiclub.in/api/v1/aadhaar_v2/submit_otp', [
                'headers' => [
                    'Referer' => 'docs.apiclub.in',
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'x-api-key' => "892c191cfd3e2509eeb11b6326288eb1",
                ],
                'json' => [
                    'ref_id' => $aadhaarToken,
                    'otp' => $otp,
                ],
            ]);

            $responseData = $response->getBody()->getContents();
            $responseData = json_decode($responseData, true);

            if ($response->getStatusCode() == 200 && $responseData['status'] === 'success') {
                // OTP Verified Successfully
                $customer = Customers::where('id', $id)->first();
                if ($customer) {
                    $customer->aadhaar_verified = true; // Assuming you have this field in your model
                    $customer->verified = true;
                    $customer->save();
                }

                return response()->json([
                    'success' => true,
                    'message' => 'OTP verified successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $responseData['message'] ?? 'Failed to verify OTP'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ]);
        }
    }

    public function panVerficationPage($id)
    {
        $title = "Verify Pan";

        $customer = Customers::find($id);

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        $data = compact('title', 'customer');

        return view('customer.verify-pan')->with($data);
    }

    public function verifyPan(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'pan_number' => 'required|string|size:10' // PAN number is 10 characters long
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $panNumber = $request->pan_number;

        // Use GuzzleHttp to verify PAN with the API
        $client = new Client();
        try {
            $response = $client->request('POST', 'https://uat.apiclub.in/api/v1/verify_pan', [
                'body' => json_encode(['pan_no' => $panNumber]),
                'headers' => [
                    'Referer' => 'docs.apiclub.in',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                    'x-api-key' => "892c191cfd3e2509eeb11b6326288eb1", // Make sure to set this in your .env file
                ],
            ]);

            $responseData = json_decode($response->getBody()->getContents(), true);

            if ($response->getStatusCode() == 200 && $responseData['status'] === 'success') {
                // Save the PAN number into the database
                $customerId = session('customer_id'); // Get the ID from the session
                $customer = Customers::find($customerId); // Assuming you're using authentication

                $customer->pan_number = $panNumber;
                $customer->pan_verified = true;
                $customer->save();

                return response()->json([
                    'success' => true,
                    'message' => 'PAN number verified and saved successfully.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $responseData['message'] ?? 'Invalid Pan Number',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ]);
        }
    }


    // private function getDistances($origin, $destination)
    // {
    //     $google_api_key = 'AIzaSyCoWgaHxzX0Z5NyrOQO_ST4gr1u9fzEcIw';

    //     $response = Http::get('https://maps.googleapis.com/maps/api/distancematrix/json', [
    //         'origins' => urlencode($origin),
    //         'destinations' => urlencode($destination),
    //         'key' => $google_api_key,
    //     ]);

    //     $distance_arr = $response->json();

    //     if ($distance_arr['status'] == 'OK') {
    //         $destination_address = $distance_arr['destination_addresses'][0];
    //         $origin_address = $distance_arr['origin_addresses'][0];
    //         $elements = $distance_arr['rows'][0]['elements'][0];

    //         if (empty($origin_address) || empty($destination_address)) {
    //             return [
    //                 'msg' => 'Destination or origin address not found',
    //             ];
    //         }

    //         return [
    //             'destination_addresses' => $destination_address,
    //             'origin_addresses' => $origin_address,
    //             'distance' => $elements['distance']['text'],
    //             'duration' => $elements['duration']['text'],
    //             'msg' => '',
    //         ];
    //     } else {
    //         return [
    //             'msg' => 'The request was invalid',
    //         ];
    //     }
    // }

    // public function getDistance(Request $request)
    // {
    //     $dis_details = $this->getDistances($request->origin, $request->destination);

    //     if (isset($dis_details['distance'])) {
    //         // Extract numeric value from distance (e.g., "12 km" -> 12)
    //         $dist = preg_replace('/[^0-9.]/', '', $dis_details['distance']);
    //         $dist_round = round(floatval($dist));

    //         $data = [
    //             'distance' => $dis_details['distance'],
    //             'duration' => $dis_details['duration'],
    //             'perkg' => '',
    //             'dist' => $dist_round,
    //         ];
    //     } else {
    //         $data = [
    //             'msg' => $dis_details['msg'],
    //         ];
    //     }

    //     return response()->json($data, 200);
    // }


    // private function loadPincodeCSV()
    // {
    //     $pincodeData = [];

    //     // Load the CSV file
    //     $csv = Reader::createFromPath(storage_path('app/Pincode_30052019.csv'), 'r');
    //     $csv->setHeaderOffset(0); // Assuming the CSV file has headers

    //     // Iterate through the CSV and store data in an associative array
    //     foreach ($csv as $row) {
    //         $pincode = $row['Pincode'];
    //         $pincodeData[$pincode] = [
    //             'district' => $row['District'],
    //             'state_name' => $row['StateName'],
    //         ];
    //     }

    //     return $pincodeData;
    // }

    // // this pincode code is working with any valid pincode
    // private function verifyPincodeViaAPI($pincode)
    // {
    //     $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
    //         'address' => $pincode,
    //         'key' => 'AIzaSyCoWgaHxzX0Z5NyrOQO_ST4gr1u9fzEcIw',
    //     ]);

    //     if ($response->successful() && isset($response['results']) && count($response['results']) > 0) {
    //         $result = $response['results'][0];
    //         $address_components = $result['address_components'];

    //         $district = null;
    //         $state_name = null;

    //         foreach ($address_components as $component) {
    //             if (in_array('administrative_area_level_3', $component['types'])) {
    //                 $district = $component['long_name'];
    //             }
    //             if (in_array('administrative_area_level_1', $component['types'])) {
    //                 $state_name = $component['long_name'];
    //             }
    //         }

    //         return [
    //             'status' => true,
    //             'district' => $district,
    //             'state_name' => $state_name,
    //             'msg' => 'Pincode verified successfully via Google Maps API.',
    //         ];
    //     }

    //     return [
    //         'status' => false,
    //         'msg' => 'Invalid Pincode or API request failed.',
    //     ];
    // }

    private function verifyPincodeBelongsToCity($pincode, $city)
    {
        $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
            'address' => $pincode,
            'key' => 'AIzaSyCoWgaHxzX0Z5NyrOQO_ST4gr1u9fzEcIw',
        ]);

        if ($response->successful() && isset($response['results']) && count($response['results']) > 0) {
            $result = $response['results'][0];
            $address_components = $result['address_components'];

            $city_name = null;

            foreach ($address_components as $component) {
                if (in_array('locality', $component['types'])) {
                    $city_name = $component['long_name'];
                } elseif (in_array('administrative_area_level_2', $component['types'])) {
                    // Sometimes the city name might be in administrative_area_level_2
                    $city_name = $component['long_name'];
                }
            }

            if ($city_name && stripos($city_name, $city) !== false) {
                return [
                    'status' => true,
                    'msg' => "Pincode $pincode verified successfully for city $city.",
                ];
            } else {
                return [
                    'status' => false,
                    'msg' => "Pincode $pincode does not belong to the city $city.",
                ];
            }
        }

        return [
            'status' => false,
            'msg' => 'Invalid Pincode or API request failed.',
        ];
    }
    // public function verifyPincodeCity(Request $request)
    // {
    //     $pincode = $request->input('pincode');
    //     $city = $request->input('city');

    //     $verificationResult = $this->verifyPincodeBelongsToCity($pincode, $city);

    //     return response()->json($verificationResult);
    // }


    // using csv file
    // private function verifyPincode($pincode, $pincodes)
    // {
    //     // First, check the pincode in the local CSV file
    //     if (array_key_exists($pincode, $pincodes)) {
    //         return [
    //             'status' => true,
    //             'district' => $pincodes[$pincode]['district'],
    //             'state_name' => $pincodes[$pincode]['state_name'],
    //             'msg' => 'Pincode verified successfully using local CSV data.',
    //         ];
    //     }

    //     // If not found, try verifying via the external API
    //     $api_verification = $this->verifyPincodeViaAPI($pincode);

    //     if ($api_verification['status']) {
    //         return $api_verification;
    //     }

    //     // If not found in either, return an error
    //     return [
    //         'status' => false,
    //         'msg' => 'Invalid Pincode.',
    //     ];
    // }
}
