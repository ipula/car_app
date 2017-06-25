<?php
/**
 * Created by PhpStorm.
 * User: Ipula Indeewara
 * Date: 6/25/2017
 * Time: 5:15 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $primaryKey = 'brand_id';
    public $timestamps = false;

    public function getModels()
    {
        return $this->belongsToMany('App\Models','brand_models','brand_models_brand_id','brand_models_models_id');
    }
}