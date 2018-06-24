<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;
use Facades\App\Services\MiNubeService;

class CacheHouseNearPointsOfInterest
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
	    MiNubeService::getNearNaturalReserves($event->house);
	    MiNubeService::getNearGreenPaths($event->house);
	    MiNubeService::getNearRestaurants($event->house);
	    MiNubeService::getNearPublicEstablishments($event->house);
	    MiNubeService::getNearPrivateEstablishments($event->house);
	    MiNubeService::getNearGreenActivities($event->house);
	    MiNubeService::getNearExtraordinaryPlaces($event->house);
    }
}
