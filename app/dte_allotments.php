<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dte_allotments extends Model
{
    protected $table='dte_allotments';
    protected $primaryKey='da_master_id';
    public $timestamps=true;
}
