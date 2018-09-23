<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $timestamps = false;
    protected $table = 'sales';
    protected $fillable = array('vehicle_id', 'cost', 'pvp', 'tax', 'seller_id', 'buyer_id', 'sold_on');

    /* Relationship: 1 Sale hasOne 1 Seller */
    public function seller()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    /* Relationship: 1 Sale hasOne 1 Buyer */
    public function buyer()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    /* Relationship: 1 Sale hasOne vehicle */
    public function vehicle()
    {
        return $this->hasOne(Vehicle::class);
    }
}
