<?php

namespace App\Services\Twilio;

use Illuminate\Http\JsonResponse;

interface TwilioServiceInterface
{

    /**
     * @param string $receiverNumber
     * @param string $message
     * @return JsonResponse
     */
    public function sendSms(string $receiverNumber, string $message) : JsonResponse;
}
