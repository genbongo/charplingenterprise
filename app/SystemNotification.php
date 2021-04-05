<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemNotification extends Model
{
    protected $table        = "system_notifications";
    protected $primaryKey   = 'id';
    protected $guarded      = ['id'];
}
