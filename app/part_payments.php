<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class part_payments extends Model
{
    protected $table='part_payment';
    protected $primaryKey='part_payment_id';
    public $timestamps=false;
}
