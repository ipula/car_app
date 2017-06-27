<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCardDetail extends Model
{
    protected $table = 'job_card_detail';
    protected $primaryKey = 'job_card_detail_id';

    public function getTechnician()
    {
        return $this->belongsTo('App\Technician','job_card_detail_technician_id');
    }
    public function getService()
    {
        return $this->belongsTo('App\Service','job_card_detail_service_id');
    }
    public function getServiceType()
    {
        return $this->belongsTo('App\ServiceType','job_card_detail_service_type_id');
    }
}
