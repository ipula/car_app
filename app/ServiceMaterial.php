<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceMaterial extends Model
{
    protected $table = 'service_material';
    protected $primaryKey = 'service_material_id';

    public function getServiceMaterialDetails()
    {
        return $this->hasMany('App\ServiceMaterialDetail','service_material_detail_service_material_id');
    }
}
