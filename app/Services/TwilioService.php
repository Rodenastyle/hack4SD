<?php

namespace App\Services;

use Twilio\Rest\Client as Twilio;
use BotMan\BotMan\Middleware\ApiAi;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Twilio(config('botman.twilio.sid'), config('botman.twilio.token'));
    }

    public function call($number, $action)
    {
        $this->client->calls->create($number, config('botman.twilio.fromNumber'), ['url' => $action]);
    }
}
