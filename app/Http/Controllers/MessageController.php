<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guy; // Use the Guy model
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function showSendMessageForm()
    {
        // Retrieve all guys to be listed in the form
        $guys = Guy::all(); // Adjust as necessary for your application
        return view('send-message', compact('guys'));
    }

    public function sendMessage(Request $request)
    {
        $guyIds = $request->input('guys', []);
        $messageText = $request->input('message');

        // Validation to ensure message and at least one guy is selected


        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioFrom = env('TWILIO_FROM');
        $client = new Client($sid, $token);

        // Process in chunks to handle potentially large number of guys
        Guy::whereIn('id', $guyIds)->chunkById(100, function ($guys) use ($client, $twilioFrom, $messageText) {
            foreach ($guys as $guy) {
                try {
                    if (!empty($guy->mobile)) { // Ensure there's a mobile number
                        $client->messages->create(
                            $guy->mobile, // Use the mobile number from the database
                            [
                                'from' => $twilioFrom,
                                'body' => $messageText
                            ]
                        );
                        Log::info("Message sent to Guy ID: {$guy->id}");
                    }
                } catch (\Exception $e) {
                    Log::error("Failed to send message to Guy ID: {$guy->id}, Error: {$e->getMessage()}");
                }
            }
        });

        return back()->with('success', 'Messages sent successfully!');
    }
}
