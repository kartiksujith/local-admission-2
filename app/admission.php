<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admission extends Model
{
     protected $table='admission';
    protected $primaryKey='admission_id';
    public $timestamps=false;
}
