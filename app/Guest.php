<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $guarded = [];

    protected $dates = ['start_date', 'end_date'];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
