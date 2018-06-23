<?php

use BotMan\BotMan\Facades\BotMan;
use App\Http\Controllers\TelegramController;
use BotMan\Drivers\Twilio\TwilioVoiceDriver;
use App\Http\Controllers\TwilioController;

BotMan::on(TwilioVoiceDriver::INCOMING_CALL, TwilioController::class.'@handle');


BotMan::hears('{something}', TelegramController::class.'@handle');
