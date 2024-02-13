<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guy;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class GuysController extends Controller
{
    public function showSendMessageForm()
    {
        $guys = Guy::all();
        return view('send-message', compact('guys'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'guys' => 'required|array|min:1',
            'message' => 'required|string',
        ]);

        $guyIds = $request->guys;
        $messageText = $request->message;

        $sid = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $twilioFrom = env('TWILIO_FROM');
        $client = new Client($sid, $token);

        $errors = [];

        Guy::findMany($guyIds)->each(function ($guy) use ($client, $twilioFrom, $messageText, &$errors) {
            try {
                if (!empty($guy->mobile)) {
                    $message = $client->messages->create($guy->mobile, [
                        'from' => $twilioFrom,
                        'to' => $guy->mobile, // Use the mobile number from the database
                        'body' => $messageText,
                    ]);
                    Log::info("Message sent to {$guy->name} (ID: {$guy->id}) with SID {$message->sid}");
                } else {
                    Log::warning("Skipped sending message to {$guy->name} (ID: {$guy->id}) due to empty mobile number.");
                }
            } catch (TwilioException $e) {
                Log::error("Failed to send message to {$guy->name} (ID: {$guy->id}). Twilio Error: " . $e->getMessage());
                $errors[] = "Failed to send message to {$guy->name}: " . $e->getMessage();
            }
        });

        if (!empty($errors)) {
            return back()->withErrors($errors)->withInput();
        }

        return back()->with('success', 'Messages sent successfully!');
    }

    public function create()
    {
        return view('guys.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|regex:/^\+[1-9]\d{1,14}$/',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $guy = new Guy();
        $guy->name = $request->name;
        $guy->mobile = $request->mobile;
        $guy->save();

        return redirect()->route('guys.index')->with('success', 'New guy added successfully!');
    }

    public function edit($id)
    {
        $guy = Guy::findOrFail($id); // Find the guy or fail
        return view('guys.edit', compact('guy'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|regex:/^\+[1-9]\d{1,14}$/',
        ]);

        $guy = Guy::findOrFail($id);
        $guy->name = $request->name;
        $guy->mobile = $request->mobile;
        $guy->save();

        return redirect()->route('guys.edit', $guy->id)->with('success', 'Guy updated successfully!');
    }

    public function index()
    {
        $guys = Guy::all(); // Fetch all guys
        return view('guys.index', compact('guys'));
    }


}
