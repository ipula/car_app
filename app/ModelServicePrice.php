<?php
/**
 * Created by PhpStorm.
 * User: genius
 * Date: 7/7/2017
 * Time: 3:47 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ModelServicePrice extends Model
{
    protected $table = 'model_service_price';
    protected $primaryKey = 'model_service_price_id';
    public $timestamps=false;

    public function getModels()
    {
        return $this->belongsTo('App\Models','model_service_price_model_id');
    }
    public function getService()
    {
        return $this->belongsTo('App\Service','model_service_price_service_id');
    }
}