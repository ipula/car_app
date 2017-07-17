<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrnDetail extends Model
{
    protected $table = 'grn_detail';
    protected $primaryKey = 'grn_detail_id';

    public function getServiceMaterial()
    {
        return $this->belongsTo('App\ServiceMaterial','grn_detail_service_material_id');
    }
}
