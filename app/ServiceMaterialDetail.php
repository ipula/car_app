<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceMaterialDetail extends Model
{
    protected $table = 'service_material_detail';
    protected $primaryKey = 'service_material_detail_id';

    public function getMaterial()
    {
        return $this->belongsTo('App\ServiceMaterial','service_material_detail_service_material_id');
    }
}
