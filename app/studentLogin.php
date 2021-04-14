<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentLogin extends Model
{
    //
    protected $table='student_login';
    protected $primaryKey='dte_id';
    public $timestamps=false;
}
