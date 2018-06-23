<?php

namespace App\Http\Controllers;

class TelegramController extends Controller
{
    /**
     * Place your Telegram logic here.
     */
    public function handle($bot, $something)
    {
        $extras = $bot->getMessage()->getExtras();
        info([$something, $extras]);
        switch ($extras['apiAction']) {
            case 'isa.rea.create-guest':
                CreateGuest::dispatch();
                break;

            case 'some_other_action':
                // dispatch other event
                break;
        }
        $bot->reply($extras['apiReply']);
    }
}
