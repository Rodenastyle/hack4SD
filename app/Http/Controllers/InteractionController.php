<?php

namespace App\Http\Controllers;

use Twilio\TwiML;
use Illuminate\Http\Request;
use BotMan\BotMan\Middleware\ApiAi;
use Facades\App\Services\DialogFlowService as DialogFlow;
use App\Guest;

class InteractionController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function botman()
    {
        $botman = app('botman');

        $botman->middleware->received(ApiAi::create(config('services.dialogflow.key'))->listenForAction());

        $botman->hears('{something}', __CLASS__ . '@telegram');

        $botman->listen();
    }

    public function telegram($bot, $data)
    {
        $dialogFlow = $bot->getMessage()->getExtras();

        info([$data, $dialogFlow]);

        $this->dispatchEvent($dialogFlow);

        $bot->reply($dialogFlow['apiReply']);
    }

    public function twilio(Request $request)
    {
        $response = new TwiMl;

        if ($request->has('SpeechResult')) {
            $message = DialogFlow::process($request->input('SpeechResult'), $request->input('Caller'));

            info([$message]);

            $this->dispatchEvent($dialogFlow = $message->getExtras());

            $response->say($dialogFlow['apiReply'], ['voice' => 'woman', 'language' => 'es-ES']);
        } else {
            $gather = $response->gather(['input' => 'speech', 'language' => 'es-ES']);
            $gather->say('Di algo para probar. Tienes 10 segundos.', ['voice' => 'woman', 'language' => 'es-ES']);
        }

        return $response;
    }

    public function call(Guest $guest)
    {
        $response = new TwiMl;

        if ($request->has('SpeechResult')) {
            $message = DialogFlow::process($request->input('SpeechResult'), $request->input('Caller'));

            info([$message]);

            $this->dispatchEvent($dialogFlow = $message->getExtras());

            $response->say($dialogFlow['apiReply'], ['voice' => 'woman', 'language' => 'es-ES']);
        } else {
            $gather->say("Hola, soy Isabel. Veo que tienes una reserva desde el {$guest->start_date->formatLocalized('%A %d %B %Y')} hasta el  {$guest->end_date->formatLocalized('%A %d %B %Y')}. Si tienes alguna duda o pregunta no dudes en contactar. Quedo a tu disposición 🙂", ['voice' => 'woman', 'language' => 'es-ES']);
            $response->gather(['input' => 'speech', 'language' => 'es-ES']);
        }

        return $response;
    }

    protected function dispatchEvent($dialogFlow)
    {
        switch ($dialogFlow['apiAction']) {
            case 'isa.rea.create-guest':
                CreateGuest::dispatch($dialogFlow);
                break;

            case 'isa.local-trade.near':
                // dispatch other event
                break;

            case 'isa.local-trade.best':
                // dispatch other event
                break;

            case 'isa.local-trade.cheap':
                // dispatch other event
                break;

            case 'isa.domotic.washer':
                CheckWasher::dispatch($dialogFlow);
                break;

            case 'isa.domotic.oven-on':
                EnableOven::dispatch($dialogFlow);
                break;

            case 'isa.domotic.light':
                EnableLight::dispatch($dialogFlow);
                break;

            case 'isa.domotic.garage-open':
                OpenGarage::dispatch($dialogFlow);
                break;

            case 'isa.domotic.garage-close':
                CloseGarage::dispatch($dialogFlow);
                break;

            case 'isa.domotic.blind.up':
                LiftBlind::dispatch($dialogFlow);
                break;

            case 'isa.domotic.blind.down':
                LowerBlind::dispatch($dialogFlow);
                break;
        }
    }
}
