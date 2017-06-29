<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $primaryKey = 'invoice_id';

    public function getJobCard()
    {
        return $this->belongsTo('App\JobCard','invoice_job_card_id');
    }

    public function getUsers()
    {
        return $this->belongsTo('App\User','invoice_card_users_id');
    }
}
