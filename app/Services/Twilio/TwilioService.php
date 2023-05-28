<?php

namespace App\Services\Twilio;

use Twilio\Rest\Client;

class TwilioService implements TwilioServiceInterface
{

    public function sendSms(string $receiverNumber, string $message) : bool
    {

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            dd('SMS Sent Successfully.');

        } catch (\Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }

}
