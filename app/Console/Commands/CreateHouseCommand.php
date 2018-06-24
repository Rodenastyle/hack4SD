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
    protected $signature = 'make:house {{--N|name= : The name of the house}} {{--A|adress= : The adress of the house}} {{--T|owner_tel= : The phone of the owner of the house }} {{--M|owner_msg= : The telegram handle of the owner of the house }}';

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

        $house->owner_phone = $this->option('owner_tel') ?? $this->ask('¿Cuál es el teléfono del dueño de la casa?');
        $house->owner_telegram = $this->option('owner_msg') ?? $this->ask('¿Cuál es el telegram del dueño de la casa?');

        $house->save();
    }
}
