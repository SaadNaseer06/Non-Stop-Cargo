<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Messages;
use App\Models\RequestTruck;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    // customer to transporter messages
    public function fetchMessages($id)
    {
        return Messages::where("request_id", $id)->with('transporter')->get();
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:jpg,png,pdf,doc,docx,xlsx,txt|max:4096',
            'message' => 'nullable|string|max:255',
        ]);

        $requestId = $request->request_id;
        $allocate = RequestTruck::with('winingbid')->find($requestId);

        $transporter_id = $allocate->winingbid->transporter->id;
        $customer_id = session('customer_id');

        $File = null;

        if ($request->hasFile('file')) {
            $File = time() . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('FileMessage'), $File);
        }

        $message = Messages::create([
            'customer_id' => $customer_id,
            'transporter_id' => $transporter_id,
            'request_id' => $requestId,
            'message' => $request->message,
            'file' => $File,
            'sender' => $customer_id
        ]);

        return $message->load('transporter');
    }

    // transporter to customer messages
    public function fetchMessagesSecond($id)
    {
        return Messages::where("request_id", $id)->with('customer')->get();
    }

    public function sendMessageSecond(Request $request)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:jpg,png,pdf,doc,docx,xlsx,txt|max:4096',
            'message' => 'nullable|string|max:255',
        ]);

        $bidId  = $request->request_id; // Bid ID
        $allocate = RequestTruck::with('winingbid')->find($bidId);

        // $allocate = Bid::with('requestTruck')->find($bidId);


        // dd($requestId);

        $requestId = $allocate->id;
        $customer_id = $allocate->customer_id;
        // $customer_id = $allocate->requestTruck->customer_id;
        $transporter_id = session('transporter_id');

        $File = null;

        if ($request->hasFile('file')) {
            $File = time() . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('FileMessage'), $File);
        }

        $message = Messages::create([
            'customer_id' => $customer_id,
            'transporter_id' => $transporter_id,
            'request_id' => $requestId,
            'message' => $request->message,
            'file' => $File,
            'sender' => $transporter_id
        ]);

        return $message->load('customer');
    }
}
