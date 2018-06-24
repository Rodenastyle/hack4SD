<?php

use BotMan\BotMan\Facades\BotMan;
use App\Http\Controllers\TelegramController;
use BotMan\Drivers\Twilio\TwilioVoiceDriver;
use App\Http\Controllers\TwilioController;

BotMan::hears('{something}', TelegramController::class.'@handle');
