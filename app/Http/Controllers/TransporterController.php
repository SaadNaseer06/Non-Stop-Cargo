<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Transporter;
use App\Mail\EmailVerification;
use App\Models\Bid;
use App\Models\Messages;
use App\Models\RequestTruck;
use App\Models\Transporters;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use App\Services\OtpService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
// use App\Mail\EmailVerification;


class TransporterController extends Controller
{
    public function login()
    {
        $title = "Login";

        $data = compact('title');

        return view('transporter.login')->with($data);
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

            $admin = Transporters::where("email", $email)->exists();

            if ($admin == true) {

                $login = Transporters::where("email", $email)->first();

                if (Hash::check($password, $login->password)) {

                    session()->put("transporter_id", $login->id);

                    return redirect()->route("transporter.index")->with("success", "Logged In successfully.");
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

    public function register()
    {
        $title = "Register";

        $data = compact('title');

        return view('transporter.register')->with($data);
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            "name" => 'required',
            "phone" => 'required',
            "email" => 'required|email|unique:transporters,email,',
            "password" => 'required|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        try {

            $transporter = new Transporters();

            $image = null;
            if ($request->hasFile('image')) {
                $image = time() . '.' . $request->image->extension();
                $request->image->move(public_path('Customer/profile/image'), $image);
            }

            $transporter->name = $request->name;
            $transporter->email = $request->email;
            $transporter->phone = $request->phone;
            $transporter->password = Hash::make($request->password);
            $transporter->image = $image;

            $emailOtp = rand(100000, 999999);
            $phoneOtp = rand(100000, 999999);

            Log::info("Generated OTPs: Email OTP = {$emailOtp}, Phone OTP = {$phoneOtp}");

            // OtpService::sendSms();
            $smsSent = OtpService::sendSms($request->phone, $phoneOtp);

            if (!$smsSent) {
                return redirect()->back()->with('error', 'Failed to send OTP. Please try again.');
            }

            // Store OTP for verification
            // OtpService::storeOtp($request->phone, $phoneOtp);

            // $transporter->phone_otp = $phoneOtp;
            $transporter->phone_otp = $phoneOtp;
            $transporter->phone_otp_expires_at = now()->addMinutes(5);
            $transporter->email_otp = $emailOtp;
            $transporter->save();

            Mail::to($request->email)->send(new EmailVerification($emailOtp));

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

            session(['transporter_id' => $transporter->id, 'phone' => $request->phone]);

            // dd(session('phone'));

            // session(['phone' => $request->phone]);

            return redirect()->route('transporter.phone.verify.page')->with('success', 'Your account has been registered successfully! Please verify your phone number.');
        } catch (\Exception $e) {

            return redirect()->back()->with('Something went wrong! ' . $e->getMessage());
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
            $otpResent = OtpService::resendOtp($phone);

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


    public function phoneVerificationPage()
    {
        $title = "Verify Phone Number";

        // $phone = session('phone');

        $phone = session('phone');

        // dd($phone);

        $data = compact('title', 'phone');

        return view('transporter.verify-phone')->with($data);
    }

    public function verifyPhone(Request $request)
    {
        $request->validate([
            'otp' => 'required',
        ]);

        // $transporter = Transporters::where('phone_otp', $request->verification_code)->first();

        $transporterId = session('transporter_id');
        $transporter = Transporters::find($transporterId);

        if (!$transporter) {
            return redirect()->route('transporter.register')->with('error', 'Invalid session or transporter not found.');
        }

        // $verificationStatus = OtpService::verifyOtp($request->otp);
        $verificationStatus = OtpService::verifyOtpTransporter($transporter->phone, $request->otp);

        // if ($transporter) {
        //     $transporter->phone_verified = true;
        //     $transporter->save();

        //     return redirect()->route('transporter.email.verify.page')->with('success', 'Phone verified successfully. Now, please verify your phone.');
        // }
        // return redirect()->back()->with('error', 'Invalid Phone verification code.');

        // if ($verificationStatus == 'approved') {
        //     $transporter->phone_verified_at = now();
        //     $transporter->phone_verified = true;
        //     $transporter->save();
        if ($verificationStatus) {
            $transporter->phone_verified_at = now();
            $transporter->phone_verified = true;
            $transporter->save();

            // Redirect to dashboard or any other page
            return redirect()->route('transporter.email.verify.page')->with('success', 'Phone number verified successfully.');
        } else {
            return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
        }
    }

    public function emailVerificationPage()
    {
        $title = "Verify Email";

        $data = compact('title');

        return view('transporter.verify-email')->with($data);
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
        ]);

        $transporter = Transporters::where('email_otp', $request->verification_code)->first();

        if ($transporter) {
            $transporter->email_verified = true;
            $transporter->save();

            return redirect()->route('transporter.index')->with('success', 'Email verified successfully. Now, please verify your phone. You can now access the dashboard. ');
        }

        return redirect()->back()->with('error', 'Invalid Email verification code.');
    }

    public function aadhaarVerficationPage()
    {
        $title = "Verify Aadhaar";

        $data = compact('title');

        return view('transporter.verify-aadhaar')->with($data);
    }

    public function sendOtp(Request $request)
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

                $transporter = Transporters::where('id', session('transporter_id'))->first();
                $transporter->aadhaar_number = $aadhaarNumber;
                $transporter->save();

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

    public function verifyOtp(Request $request)
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
                $transporter = Transporters::where('id', session('transporter_id'))->first();
                if ($transporter) {
                    $transporter->aadhaar_verified = true; // Assuming you have this field in your model
                    $transporter->save();
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

    public function panVerficationPage()
    {
        $title = "Verify Pan";

        $data = compact('title');

        return view('transporter.verify-pan')->with($data);
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
                $transporterId = session('transporter_id'); // Get the ID from the session
                $transporter = Transporters::find($transporterId); // Assuming you're using authentication

                $transporter->pan_number = $panNumber;
                $transporter->pan_verified = true;
                $transporter->save();

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

    public function RcVerificationPage()
    {
        $title = "Verify Vehicle RC";

        $data = compact('title');

        return view('transporter.verify-rc')->with($data);
    }

    public function verifyRc(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'rc_number' => 'required|string|size:10' // PAN number is 10 characters long
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $rcNumber = $request->rc_number;

        // Use GuzzleHttp to verify PAN with the API
        $client = new Client();
        try {
            $response = $client->request('POST', 'https://uat.apiclub.in/api/v1/rc_info', [
                'body' => json_encode(['vehicleId' => $rcNumber]),
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
                $transporterId = session('transporter_id'); // Get the ID from the session
                $transporter = Transporters::find($transporterId); // Assuming you're using authentication

                $transporter->rc_number = $rcNumber;
                $transporter->rc_verified = true;
                $transporter->verified = true;
                $transporter->save();

                return response()->json([
                    'success' => true,
                    'message' => 'RC number verified and saved successfully.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $responseData['message'] ?? 'Invalid RC Number',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ]);
        }
    }

    public function bankVerificationPage()
    {
        $title = "Verify Bank";

        $data = compact('title');

        return view('transporter.verify-bank')->with($data);
    }

    public function verifyBank(Request $request)
    {
        // Validate the input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'account' => 'required|string|min:10|max:18',
            'ifsc' => 'required|string|size:11',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $account = $request->account;
        $name = $request->name;
        $ifsc = $request->ifsc;

        // Use GuzzleHttp to verify PAN with the API
        $client = new Client();

        try {
            $response = $client->request('POST', 'https://uat.apiclub.in/api/v1/validate/bank', [
                'body' => json_encode([
                    'name' => $name,
                    'accno' => $account,
                    'ifsc' => $ifsc
                ]),
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
                $transporterId = session('transporter_id'); // Get the ID from the session
                $transporter = Transporters::find($transporterId); // Assuming you're using authentication

                $transporter->bank_number = $account;
                $transporter->bank_verified = true;
                $transporter->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Bank details verified and saved successfully.',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $responseData['message'] ?? 'Bank verification failed.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ]);
        }
    }


    public function logout()
    {
        try {

            session()->forget("transporter_id");

            return redirect()->back()->with("success", "Loggedout successfully.");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong. Please try again later.");
        }
    }

    public function index()
    {
        $title = "Dashboard";

        $totalbids = Bid::with('requestTruck')->where('transporter_id', session('transporter_id'))->latest()->get();

        $acceptedBidsCount = $totalbids->filter(function ($bid) {
            return $bid->requestTruck->winning_bid_id === $bid->id;
        })->count();

        // dd($acceptedBidsCount);

        $transporter = Transporters::find(session('transporter_id'));

        $data = compact('title', 'totalbids', 'acceptedBidsCount', 'transporter');

        return view('transporter.index')->with($data);
    }

    public function hiringRequest()
    {
        $title = "Hiring Requests";

        $truckrequests = RequestTruck::with('customer')->orderBy('created_at', 'desc')->get();

        $data = compact('title', 'truckrequests');

        return view('transporter.hiring-request')->with($data);
    }

    public function bid($id)
    {
        $title = "Bid";

        $data = compact('title', 'id');

        return view('transporter.bid')->with($data);
    }

    public function addBid($id, Request $request)
    {
        $request->validate([
            "bid" => "required",
        ]);

        try {

            foreach ($request["bid"] as $key => $item) {

                $bid = ucfirst($item);

                $new = new Bid;
                $new->transporter_id = session('transporter_id');
                $new->bid_id = $id;
                $new->bid = $bid;
                $new->save();
            }

            return redirect()->route('transporter.hiring.request')->with("success", "Your Bid has been placed!");
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", "Something went wrong. Please try agian later.");
        }
    }

    public function myBids()
    {
        $title = "My Bids";

        $mybids = Bid::with('requestTruck')->where('transporter_id', session('transporter_id'))->latest()->get();

        $data = compact('title', 'mybids');

        return view('transporter.mybids')->with($data);
    }

    public function deleteMyBid($id)
    {
        $mybid = Bid::find($id);
        $mybid->delete();

        return redirect()->back()->with('success', 'Your bid has been deleted!');
    }

    public function MyBidDetail($id)
    {
        $title = "My Bid Detail";

        $allocatedBid = Bid::with('requestTruck.latestPayment')->where('id', $id)->latest()->get();

        $allocatedBidPay = Bid::with('requestTruck.latestPayment')->findOrFail($id);

        $payment = $allocatedBidPay->requestTruck->latestPayment;
        // $paymentStatus = $payment ? $payment->status : null;

        $data = compact('title', 'allocatedBid', 'payment');

        return view('transporter.bid-detail')->with($data);
    }

    public function profile()
    {
        $title = "Profile";

        $transporter = Transporters::find(session('transporter_id'));

        $data = compact('title', 'transporter');

        return view('transporter.profile')->with($data);
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

            $transporter = Transporters::find(session('transporter_id'));

            $transporter->name = $request->name;
            $transporter->phone = $request->phone;
            // $admin->email = $request->email;

            if ($request->filled('password')) {
                $transporter->password = Hash::make($request->password);
            }

            if ($request->hasFile('image')) {
                $imageFile = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('Transporter/profile/image'), $imageFile);
                $transporter->image = $imageFile;
            }

            $transporter->save();

            return redirect()->route('transporter.index')->with('success', 'Your Profile has been Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something Wrong !');
        }
    }

    public function chat($id)
    {

        $title = "Chat";


        $truck = RequestTruck::with('winingbid', 'customer')->find($id);

        // $customer_request = Bid::with('requestTruck')->find($id);

        // $requestId = $customer_request->requestTruck->id;

        $message = Messages::where('request_id', $id)->first();

        $data = compact('title', 'message', 'id', 'truck');

        return view('transporter.chat')->with($data);
    }
}
