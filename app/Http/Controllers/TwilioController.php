<?php

namespace App\Http\Controllers;

use App\Conversations\CallConversation;

class TwilioController extends Controller
{
    /**
     * Place your Twilio logic here.
     */
    public function handle($bot, $something)
    {
        $bot->startConversation(new CallConversation);
    }
}
