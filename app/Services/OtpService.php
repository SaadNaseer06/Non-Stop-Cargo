<?php

namespace App\Services;

use App\Models\Customers;
use App\Models\Transporters;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class OtpService
{
    // private static $apiUrl = 'http://bhashsms.com/api/sendmsg.php';

    // // Send OTP via SMS using BhashSMS
    // public static function sendSms($phone, $otp)
    // {
    //     try {
    //         $response = Http::get(self::$apiUrl, [
    //             'user' => 'nonstopcourier',
    //             'pass' => 'nonstop',
    //             'sender' => 'NONSTP',
    //             'phone' => $phone,
    //             'text' => "Welcome to Nonstop Couriers User Login. Your OTP is $otp", // The message you want to send
    //             'priority' => 'ndnd',
    //             'stype' => 'normal',
    //         ]);

    //         if ($response->successful()) {
    //             Log::info("OTP sent successfully to phone: {$phone}");
    //             return true;
    //         }

    //         // Log the response for debugging
    //         Log::error('SMS sending failed: ' . $response->body());
    //     } catch (\Exception $e) {
    //         // Log any exceptions that occur
    //         Log::error('Error sending SMS: ' . $e->getMessage());
    //     }

    //     return false;
    // }

    private static $apiUrl = 'http://sms.hspsms.com/sendSMS';

    public static function sendSms($phone, $otp)
    {
        try {
            // Prepare the message by replacing the template variable with the actual OTP
            $message = "Welcome to Nonstop Couriers User Login. Your OTP is $otp";

            // Make the API request with the message and other required parameters
            $response = Http::get(self::$apiUrl, [
                'username'   => 'Syedanwar',                     // Your HSP SMS API username
                'message'    => $message,                        // The message with the OTP included
                'sendername' => 'NONSTP',                           // Sender name (approved sender ID)
                'smstype'    => 'TRANS',                         // SMS type (Transactional)
                'numbers'    => $phone,                          // Phone number to send the message
                'apikey'     => 'e4d37c10-b575-4bcb-a996-920c1b584f45' // Your API key
            ]);

            if ($response->successful()) {
                Log::info("OTP sent successfully to phone: {$phone}");
                return true;
            }

            // Log the response in case of failure
            Log::error('SMS sending failed: ' . $response->body());
        } catch (\Exception $e) {
            // Log any exceptions
            Log::error('Error sending SMS: ' . $e->getMessage());
        }

        return false;
    }

    // Store OTP in cache for verification
    public static function storeOtp($phone, $otp)
    {
        // Cache::put('otp_' . $phone, $otp, 5);
        // Cache::put('otp_' . $phone, $otp, now()->addMinutes(10));
        $customer = Customers::where('phone', $phone)->first();

        if ($customer) {
            $customer->update([
                'phone_otp' => $otp,
                'phone_otp_expires_at' => now()->addMinutes(5), // Set OTP expiration time
            ]);
        } else {
            Log::error("Customer with phone {$phone} not found.");
        }
    }

    // Verify OTP from cache
    public static function verifyOtp($phone, $otp)
    {

        $otpRecord = Customers::where('phone', $phone)
            ->where('phone_otp', $otp)
            ->latest()
            ->first();

        if ($otpRecord) {
            if ($otpRecord->phone_otp_expires_at && $otpRecord->phone_otp_expires_at->isFuture()) {
                $otpRecord->update([
                    'phone_otp' => null,
                    'phone_otp_expires_at' => null,
                ]);

                return true;
            }
        }

        return false;

    }

    public static function verifyOtpTransporter($phone, $otp)
    {
        $otpRecord = Transporters::where('phone', $phone)
            ->where('phone_otp', $otp)
            ->latest()
            ->first();

        if ($otpRecord) {
            if ($otpRecord->phone_otp_expires_at && $otpRecord->phone_otp_expires_at->isFuture()) {
                $otpRecord->update([
                    'phone_otp' => null,
                    'phone_otp_expires_at' => null,
                ]);

                return true;
            }
        }

        return false;
    }

    public static function resendOtp($phone)
    {
        $transporter = Transporters::where('phone', $phone)->first();
        if ($transporter && $transporter->phone_otp_expires_at && $transporter->phone_otp_expires_at->isFuture()) {
            return false;
        }

        $newOtp = rand(100000, 999999);

        $smsSent = self::sendSms($phone, $newOtp);
        if ($smsSent) {

            $transporter = Transporters::where('phone', $phone)->first();

            if ($transporter) {
                $transporter->update([
                    'phone_otp' => $newOtp,
                    'phone_otp_expires_at' => now()->addMinutes(5), // Set OTP expiration time
                ]);
            } else {
                Log::error("Transporter with phone {$phone} not found.");
            }
            return true;
        }

        return false;
    }

    public static function resendOtpCustomer($phone)
    {
        $customer = Customers::where('phone', $phone)->first();
        if ($customer && $customer->phone_otp_expires_at && $customer->phone_otp_expires_at->isFuture()) {
            return false;
        }

        $newOtp = rand(100000, 999999);

        $smsSent = self::sendSms($phone, $newOtp);
        if ($smsSent) {
            // Update OTP in database
            self::storeOtp($phone, $newOtp);
            return true;
        }

        return false;
    }
}
