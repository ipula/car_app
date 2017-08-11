<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicle';
    protected $primaryKey = 'vehicle_id';

    public function getBrand()
    {
        return $this->belongsTo('App\Brand','vehicle_vehicle_brand_id');
    }
    public function getModel()
    {
        return $this->belongsTo('App\Models','vehicle_vehicle_models_id');
    }
    public function getAgent()
    {
        return $this->belongsTo('App\Agent','vehicle_agent_id');
    }

}
