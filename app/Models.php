<?php
/**
 * Created by PhpStorm.
 * User: Ipula Indeewara
 * Date: 6/25/2017
 * Time: 5:16 PM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $table = 'models';
    protected $primaryKey = 'models_id';
    public $timestamps = false;
}