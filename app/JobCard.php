<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobCard extends Model
{
    protected $table = 'job_card';
    protected $primaryKey = 'job_card_id';

    public function getUser()
    {
        return $this->belongsTo('App\User','job_card_users_id');
    }
    public function getVehicle()
    {
        return $this->belongsTo('App\Vehicle','job_card_vehicle_id');
    }
    public function getJobCardDetails()
    {
        return $this->hasMany('App\JobCardDetail','job_card_detail_job_card_id');
    }
    public function getJobCardMaterial()
    {
        return $this->hasMany('App\ServiceMaterialDetail','service_material_detail_job_card_id');
    }
}
