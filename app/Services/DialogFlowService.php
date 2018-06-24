<?php

namespace App\Services;

use BotMan\BotMan\Middleware\ApiAi;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;


class DialogFlowService {

    protected $client;

    public function __construct()
    {
        $this->client = ApiAi::create(config('services.dialogflow.key', 'es'));
    }

    public function process($message, $sender) : IncomingMessage
    {
        return $this->client->received(new IncomingMessage($message, $sender, config('botman.twilio.fromNumber')), function ($message) {
            return $message;
        }, app('botman'));
    }
}