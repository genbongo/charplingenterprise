<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignedArea extends Model
{
    protected $table        = "assigned_areas";
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];

    protected $fillable = ['user_id', 'area_id'];
}
