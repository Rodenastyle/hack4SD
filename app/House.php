<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    // This is where guests live and sleep

	protected $fillable = ['name', 'lat', 'lng', 'owner'];
}
