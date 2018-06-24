<?php

namespace App\Listeners;

use App\House;
use App\Guest;
use App\Events\CreateGuest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Facades\App\Services\TwilioService as Twilio;
use Illuminate\Support\Carbon;

class CreateAndCallGuest
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreateGuest $event)
    {
        $data = $event->getData();

        $guest = Guest::create([
            'name'       => $data['name'],
            'phone'      => $data['phone-number'],
            'start_date' => Carbon::parse($data['date-check-in']),
            'end_date'   => Carbon::parse($data['date-check-out']),
            'house_id'   => House::first()->id,
        ]);

        Twilio::call($guest->phone, route('call', $guest));

        app('botman')->reply("Vale, ya estoy hablando con $guest->name");
    }
}
