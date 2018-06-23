<?php

namespace App\Http\Controllers;

use BotMan\BotMan\Middleware\ApiAi;

class BotManController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->middleware->received(ApiAi::create(config('services.dialogflow.key'))->listenForAction());

        $botman->listen();
    }
}
