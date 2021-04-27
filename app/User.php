<?php

namespace App;

use App\Area;
use App\{Store,AssignedArea};
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function area()
    {
        return $this->belongsTo(Area::class)->where('is_deleted',1);
    }

    public function stores()
    {
        return $this->hasMany(Store::class)->where('stores.is_deleted',1);
        // return $this->hasMany(Store::class)->join('orders', ['orders.store_id' => 'stores.id'])->groupBy('orders.store_id')->where('stores.is_deleted',1);
    }

    public function getStores(){
        return Store::selectRaw('stores.id, stores.store_address, stores.store_name')
                ->join('orders', ['orders.store_id' => 'stores.id'])
                ->where('stores.user_id',auth()->user()->id)
                ->groupBy('orders.store_id')
                ->where('stores.is_deleted',1)
                ->get();
    }

    public function getClient(){
        $area_asigned = AssignedArea::selectRaw('areas.id,areas.area_name')
                                ->join('areas', ['areas.id' => 'assigned_areas.area_id'])
                                ->where(['assigned_areas.user_id' => auth()->user()->id, 'assigned_areas.status' => 'active'])
                                    ->first();

        return User::selectRaw('users.*')->join('stores', ['stores.user_id' => 'users.id'])
                        ->where('stores.area_id', @$area_asigned->id)
                        ->where('users.user_role',2)->get();
    }


}
