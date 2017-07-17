<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    protected $table = 'grn';
    protected $primaryKey = 'grn_id';

    public function getGrnDetail()
    {
        return $this->hasMany('App\GrnDetail','grn_detail_grn_id');
    }

    public function getSupplier()
    {
        return $this->belongsTo('App\Supplier','grn_sup_id');
    }
}
