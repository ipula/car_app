<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TechnicianDetail extends Model
{
    protected $table = 'technician_detail';
    protected $primaryKey = 'technician_detail_id';

    public function techData()
    {
        return $this->belongsTo('App\Technician','technician_detail_technician_id');
    }

}
