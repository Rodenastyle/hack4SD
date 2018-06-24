<?php
/**
 * Created by PhpStorm.
 * User: sergio.rodenas
 * Date: 23/6/18
 * Time: 16:01
 */

namespace App\Services;

use App\House;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class MiNubeService
{
	protected $client, $externalServiceCategoryIdentifiers, $defaultOptions;

	protected function __construct()
	{
		$this->client = new Client([
			'base_uri' => 'http://papi.minube.com/'
		]);

		$this->defaultOptions = [
			'lang' => 'es',
			'api_key' => env('MINUBE_API_KEY')
		];

		$this->externalServiceCategoryIdentifiers = collect([
			"naturalReserves" => [80, 5, 111, 109, 1, 135, 48, 138, 113, 75, 2, 79, 9, 4, 7, 118, 126, 108, 125],
			"greenPaths" => [52, 78, 77],
			"restaurants" => [29, 36, 40, 34, 141, 43, 84, 85, 41],
			"publicEstablishments" => [18, 65, 99],
			"privateEstablishments" => [37, 25, 32, 30, 28, 39, 92, 121, 102, 27, 26],
			"greenActivities" => [47, 49, 48, 53, 61],
			"extraordinaryPlaces" => [39, 17, 127]
		]);
	}

	public function getNearNaturalReserves(House $house): Collection
	{
		return Cache::rememberForever('pois' . $house->id . 'nr', function() use ($house) {
			return $this->externalServiceCategoryIdentifiers
				->get("naturalReserves")
				->map(function($interestPoint) use ($house) {
					$response = $this->client->get("/pois", [
						"subcategory_id" => $interestPoint,
						"latitude" => $house->lat,
						"longitude" => $house->lng,
						"max_distance" => '40000'
					] + $this->defaultOptions)->getBody();

					return $response['name'];
				});
		});
	}

	public function getNearGreenPaths(House $house): Collection
	{
		return Cache::rememberForever('pois' . $house->id . 'gp', function() use ($house) {
			return $this->externalServiceCategoryIdentifiers
				->get("greenPaths")
				->map(function($interestPoint) use ($house) {
					$response = $this->client->get("/pois", [
						"subcategory_id" => $interestPoint,
						"latitude" => $house->lat,
						"longitude" => $house->lng,
						"max_distance" => '40000'
					] + $this->defaultOptions)->getBody();

					return $response['name'];
				});
		});
	}

	public function getNearRestaurants(House $house): Collection
	{
		return Cache::rememberForever('pois' . $house->id . 'r', function() use ($house) {
			return $this->externalServiceCategoryIdentifiers
				->get("restaurants")
				->map(function($interestPoint) use ($house) {
					$response = $this->client->get("/pois", [
						"subcategory_id" => $interestPoint,
						"latitude" => $house->lat,
						"longitude" => $house->lng,
						"max_distance" => '40000'
					] + $this->defaultOptions)->getBody();

					return $response['name'];
				});
		});
	}

	public function getNearPublicEstablishments(House $house): Collection
	{
		return Cache::rememberForever('pois' . $house->id . 'pe', function() use ($house) {
			return $this->externalServiceCategoryIdentifiers
				->get("publicEstablishments")
				->map(function($interestPoint) use ($house) {
					$response = $this->client->get("/pois", [
						"subcategory_id" => $interestPoint,
						"latitude" => $house->lat,
						"longitude" => $house->lng,
						"max_distance" => '40000'
					] + $this->defaultOptions)->getBody();

					return $response['name'];
				});
		});
	}

	public function getNearPrivateEstablishments(House $house): Collection
	{
		return Cache::rememberForever('pois' . $house->id . 'pre', function() use ($house) {
			return $this->externalServiceCategoryIdentifiers
				->get("privateEstablishments")
				->map(function($interestPoint) use ($house) {
					$response = $this->client->get("/pois", [
						"subcategory_id" => $interestPoint,
						"latitude" => $house->lat,
						"longitude" => $house->lng,
						"max_distance" => '40000'
					] + $this->defaultOptions)->getBody();

					return $response['name'];
				});
		});
	}

	public function getNearGreenActivities(House $house): Collection
	{
		return Cache::rememberForever('pois' . $house->id . 'ga', function() use ($house) {
			return $this->externalServiceCategoryIdentifiers
				->get("greenActivities")
				->map(function($interestPoint) use ($house) {
					$response = $this->client->get("/pois", [
						"subcategory_id" => $interestPoint,
						"latitude" => $house->lat,
						"longitude" => $house->lng,
						"max_distance" => '40000'
					] + $this->defaultOptions)->getBody();

					return $response['name'];
				});
		});
	}

	public function getNearExtraordinaryPlaces(House $house): Collection
	{
		return Cache::rememberForever('pois' . $house->id . 'exp', function() use ($house) {
			return $this->externalServiceCategoryIdentifiers
				->get("extraordinaryPlaces")
				->map(function($interestPoint) use ($house) {
					$response = $this->client->get("/pois", [
						"subcategory_id" => $interestPoint,
						"latitude" => $house->lat,
						"longitude" => $house->lng,
						"max_distance" => '40000'
					] + $this->defaultOptions)->getBody();

					return $response['name'];
				});
		});
	}
}