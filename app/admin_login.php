<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class admin_login extends Model
{
    protected $table='admin_login';
    protected $primaryKey='admin_id';
    public $timestamps=false;
}
