<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fees_transaction extends Model
{
    protected $table='fees_transaction';
    protected $primaryKey='master_trans_id';
    public $timestamps=false;
}
