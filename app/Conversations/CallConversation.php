<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use Twilio\TwiML\TwiML;
use BotMan\BotMan\Messages\Incoming\Answer;

class CallConversation extends Conversation
{
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $answer = $this->ask('Something', function (Answer $answer) {
            return $answer->getText();
        }, ['timeout' => 'something']);

        $this->say("Hemos entendido \"$answer\"");
    }
}
