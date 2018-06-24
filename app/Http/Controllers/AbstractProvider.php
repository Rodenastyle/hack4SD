<?php

namespace App\Http\Controllers;

use App\Events\LiftBlind;
use App\Events\EnableOven;
use App\Events\LowerBlind;
use App\Events\OpenGarage;
use App\Events\CloseGarage;
use App\Events\CreateGuest;
use App\Events\EnableLight;

abstract class AbstractProvider extends Controller
{
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
