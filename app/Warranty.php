<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warranty extends Model
{
    protected $table = 'warranty';
    protected $primaryKey = 'warranty_id';

    public function getVehicle()
    {
        return $this->belongsTo('App\Vehicle','warranty_vehicle_id');
    }
}
