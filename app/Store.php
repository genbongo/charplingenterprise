<?php

namespace App;

use App\{Area,AssignedArea};
use App\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Store extends Authenticatable
{
    use Notifiable;
    
    protected $fillable = [
        'store_name', 'store_address', 'user_id', 'area_id','is_deleted'
    ];

    public function area()
    {
    	return $this->belongsTo(Area::class);
    }

    public function owner()
    {
    	return $this->belongsTo(User::class);
    }

    public function getArea(){
        $area_name = "";
       if($area = AssignedArea::selectRaw('areas.area_name')
                                ->join('areas', ['areas.id' => 'assigned_areas.area_id'])
                                ->where(['assigned_areas.user_id' => auth()->user()->id, 'assigned_areas.status' => 'active'])
                                ->first()){
                                    $area_name = $area->area_name;
                                }
                        // $str = $area_asigned->area_name;
                    // }
        // return Area::find(auth()->user()->area_id);
        return $area_name;
    }
}
