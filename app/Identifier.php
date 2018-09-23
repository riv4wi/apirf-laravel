<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    //
    protected $fillable = [
        "vehicle_id", //FK
        "plate",
        "engine_serial",
        "body_vin",
    ];

    public function vehicle () {
        return $this->belongsTo(Vehicle::class);
    }
}
