<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\House;

class CreateHouseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:house {{--N|name= : The name of the house}} {{--A|adress= : The adress of the house}} {{--O|owner= : The owner of the house }}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new house to the database';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $house = new House;

        $house->name = $this->option('name') ?? $this->ask('¿Cuál es el nombre de la casa?');

        [$house->lat, $house->lng] = value(function () {
            $coordinates = json_decode(file_get_contents('https://maps.google.com/maps/api/geocode/json?address=' . str_replace(' ', '+', $this->option('adress') ?? $this->ask('¿Cuál es la dirección de la casa?')) . '&sensor=false&key=AIzaSyBRS_dwFgE2-AWy3IVovKUfkoRjGuQaqOo'), true);

            return [$coordinates['results'][0]['geometry']['location']['lat'], $coordinates['results'][0]['geometry']['location']['lng']];
        });

        $house->owner = $this->option('owner') ?? $this->ask('¿Quién es el dueño de la casa?');

        $house->save();
    }
}
