<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';
    protected $fillable = array('manufacturer_id', 'model', 'color', 'year',);

    /* Relationship: 1 Vehicle BelongsTo 1 Manufacturer */
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    /* Relationship: 1 Identifier hasMany vehicles */
    public function identifier()
    {
        return $this->hasMany(Identifier::class, 'identifier_id');
    }
}
