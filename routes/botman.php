<?php
use BotMan\BotMan\Middleware\ApiAi;
use App\Http\Controllers\BotManController;
use App\Conversations\CallConversation;
use BotMan\Drivers\Twilio\TwilioVoiceDriver;

$botman = resolve('botman');

$botman->middleware->received(ApiAi::create('0434b78f742e417985c091b6ca27bbc1')->listenForAction());

$botman->on(TwilioVoiceDriver::INCOMING_CALL, function ($payload, $bot) {
    $bot->startConversation(new CallConversation);
});


$botman->hears('{something}', function ($bot, $something) {
    $extras = $bot->getMessage()->getExtras();
    info([$something, $extras]);
    switch ($extras['apiAction']) {
        case 'some_action':
            // dispatch event
            break;

        case 'some_other_action':
            // dispatch other event
            break;
        
        default:
            $bot->reply($extras['apiReply']);
            break;
    }
});
