<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    protected $primaryKey = 'service_id';
//    public $timestamps=false;

    public function getServiceTypes()
    {
        return $this->belongsToMany('App\ServiceType','service_service_type','service_service_type_service_id','service_service_type_service_type_id');
    }

    public function getModels()
    {
        return $this->belongsTo('App\Models','service_models_id');
    }
}
