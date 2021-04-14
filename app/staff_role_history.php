<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff_role_history extends Model
{
    protected $table='staff_role_history';
    protected $primaryKey='staff_role_id';
    public $timestamps=false;
}
