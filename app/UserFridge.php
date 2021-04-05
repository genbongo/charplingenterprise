<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFridge extends Model
{
    protected $table        = "user_fridges";
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];
}
