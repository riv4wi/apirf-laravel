<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $table = "manufacturers";
    protected $fillable = array('name', 'website');

    // Hide those field in json
    protected $hidden = ['created_at', 'updated_at'];

    // Relationship: 1 Manufacturer hasMany N Vehicles
    public function vehicle()
    {
        return $this->hasMany(Vehicle::class);
    }
}
