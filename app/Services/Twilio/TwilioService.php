<?php

namespace App\Services\Twilio;

use Illuminate\Http\JsonResponse;
use Twilio\Rest\Client;
use App\Traits\ApiResponder;

class TwilioService implements TwilioServiceInterface
{
    use ApiResponder;


    /**
     * @param string $receiverNumber
     * @param string $message
     * @return JsonResponse
     */
    public function sendSms(string $receiverNumber, string $message) : JsonResponse
    {

        try {

            $sId = env("TWILIO_SID");
            $token = env("TWILIO_TOKEN");
            $from = env("TWILIO_FROM");

            $client = new Client($sId, $token);
            $client->messages->create($receiverNumber, [
                'from' => $from,
                'body' => $message]);

            return $this->sendSuccess('SMS Sent Successfully.');

        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

}
