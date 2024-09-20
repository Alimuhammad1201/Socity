<?php

namespace App\Services;

use Twilio\Rest\Client as TwilioClient;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected $twilioClient;

    public function __construct()
    {
        $this->twilioClient = new TwilioClient(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendSms($to, $message)
    {
        try {
            // Format the number to include country code if not present
            if (substr($to, 0, 1) !== '+') {
                $formattedNumber = '+92' . ltrim($to, '0'); // Removing leading zero and adding +92
            } else {
                $formattedNumber = $to; // If already in international format
            }

            // Send the SMS via Twilio
            $message = $this->twilioClient->messages->create($formattedNumber, [
                'from' => env('TWILIO_NUMBER'),
                'body' => $message
            ]);

            \Log::info('Message Sent: ' . $message->sid); // Log the message SID
            return response()->json(['status' => 'SMS Sent Successfully']);
        } catch (\Exception $e) {
            \Log::error('Twilio SMS failed: ' . $e->getMessage()); // Log the error message
            return response()->json(['error' => 'Failed to send SMS: ' . $e->getMessage()], 500);
        }
    }

    public function sendWhatsApp($to, $message)
    {
//        $formattedNumber = 'whatsapp:+92' . substr($to, 1); // Ensure correct formatting

        try {

            if (substr($to, 0, 1) !== '+') {
                $formattedNumber = 'whatsapp:+92' . ltrim($to, '0'); // Removing leading zero and adding +92
            } else {
                $formattedNumber = $to; // If already in international format
            }

            $response = $this->twilioClient->messages->create($formattedNumber, [
                'from' => env('TWILIO_WHATSAPP_NUMBER'),
                'body' => $message
            ]);

            Log::info('WhatsApp Message Sent: SID ' . $response->sid);
            Log::info('WhatsApp Message Status: ' . $response->status);

            return response()->json(['status' => 'WhatsApp Message Sent Successfully']);
        } catch (\Exception $e) {
            Log::error("Error sending WhatsApp message: " . $e->getMessage());
            return response()->json(['error' => 'Failed to send WhatsApp message: ' . $e->getMessage()], 500);
        }
    }

    public function sendEmail($to, $subject, $message)
    {
        // Debugging
        \Log::info("Attempting to send email...");
        \Log::info("Recipient: $to");
        \Log::info("Subject: $subject");
        \Log::info("Message: $message");

        try {
            Mail::raw($message, function ($mail) use ($to, $subject) {
                $mail->to($to)
                    ->subject($subject);
            });

            \Log::info("Email sent successfully to $to with subject $subject");
            return response()->json(['status' => 'Email Sent Successfully']);
        } catch (\Exception $e) {
            \Log::error("Failed to send email: " . $e->getMessage());
            return response()->json(['error' => 'Failed to send email: ' . $e->getMessage()], 500);
        }
    }
}
