<?php

namespace App\Http\Controllers;

use Twilio\TwiML;
use Illuminate\Http\Request;
use App\Conversations\CallConversation;
use BotMan\BotMan\Middleware\ApiAi;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;

class TwilioController extends AbstractProvider
{
    /**
     * Place your Twilio logic here.
     */
    public function handle(Request $request)
    {
        $response = new TwiMl;

        if ($request->has('SpeechResult')) {
            $message = $this->processMessage($request->input('SpeechResult'), $request->input('Caller'));

            info([$message]);

            $this->dispatchEvent($dialogFlow = $message->getExtras());

            $response->say($dialogFlow['apiReply'], ['voice' => 'woman', 'language' => 'es-ES']);
        } else {
            $gather = $response->gather(['input' => 'speech', 'language' => 'es-ES']);
            $gather->say('Di algo para probar. Tienes 10 segundos.', ['voice' => 'woman', 'language' => 'es-ES']);
        }

        return $response;
    }

    public function processMessage($message, $sender)
    {
        return ApiAi::create(config('services.dialogflow.key', 'es'))->received(new IncomingMessage($message, $sender, config('botman.twilio.fromNumber')), function($message) {
            return $message;
        }, app('botman'));
    }
}
