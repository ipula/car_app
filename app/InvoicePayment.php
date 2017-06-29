<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicePayment extends Model
{
    protected $table = 'payment';
    protected $primaryKey = 'payment_id';
}
