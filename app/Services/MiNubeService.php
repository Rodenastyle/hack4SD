<?php
/**
 * Created by PhpStorm.
 * User: sergio.rodenas
 * Date: 23/6/18
 * Time: 16:01
 */

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class MiNubeService {

	protected $client, $externalServiceCategoryIdentifiers;

	protected function __construct()
	{
		$this->client = new Client();
		$this->externalServiceCategoryIdentifiers = [
			"naturalReserves" => [80, 5, 111, 109, 1, 135, 48, 138, 113, 75, 2, 79, 9, 4, 7, 118, 126, 108, 125],
			"greenPaths" => [52, 78, 77],
			"restaurants" => [29, 36, 40, 34, 141, 43, 84, 85, 41],
			"publicEstablishments" => [18, 65, 99],
			"privateEstablishments" => [37, 25, 32, 30, 28, 39, 92, 121, 102, 27, 26],
			"greenActivities" => [47, 49, 48, 53, 61],
			"extraordinaryPlaces" => [39, 17, 127]
		];
	}

	public function getNearNaturalReserves() : Collection {
		//TODO: Complete with house model
		//Cache::get()
	}

	public function getNearGreenPaths() : Collection {

	}

	public function getNearRestaurants() : Collection {

	}

	public function getNearPrivateEstablishments() : Collection {

	}

	public function getNearPublicEstablishments() : Collection {

	}

	public function getNearGreenActivities() : Collection {

	}

	public function getNearExtraordinaryPlaces() : Collection {

	}
}