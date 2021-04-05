<?php

namespace App;

use App\Order;
use App\Store;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'area_name', 'area_code'
    ];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }

    public function staff()
    {
        return $this->hasMany(User::class);
    }

    public function clients()
    {
        $owner_ids =  $this->stores->pluck('user_id');

        return User::find($owner_ids);
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, Store::class);
    }

    public function getStaff(){
        return User::join('areas', ['areas.id' => 'users.area_id'])->selectRaw("users.contact_num as contact,  CONCAT(users.fname, ' ', users.lname) as fullname,areas.area_name")->where(['user_role' => 1, 'is_active' => 1])->get();
    }

    public function getNoAvailableArea(){
        $areas = User::select('area_id')->where('user_role', "1")->where('is_active', '1') ->get();
        $data = array();
        foreach ($areas as $key => $value) {
            $data[] = $value->area_id;
        }
        return $data;
    }
}
