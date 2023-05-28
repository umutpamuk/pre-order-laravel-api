<?php

namespace App\Services\Twilio;

interface TwilioServiceInterface
{
    /**
     * @param int $receiverNumber
     * @param string $message
     * @return bool
     */
    public function sendSms(string $receiverNumber, string $message) : bool;
}
