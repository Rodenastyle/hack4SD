<?php

namespace App\Http\Controllers;

class TelegramController extends AbstractProvider
{
    /**
     * Place your Telegram logic here.
     */
    public function handle($bot, $something)
    {
        $dialogFlow = $bot->getMessage()->getExtras();

        info([$something, $dialogFlow]);

        $this->dispatchEvent($dialogFlow);

        $bot->reply($dialogFlow['apiReply']);
    }
}
