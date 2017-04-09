<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'passwd',
        't',
        'u',
        'd', 
        'transfer_enable', 
        'port'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 订单模型关联
     *
     * @return Order
     */
    public function order()
    {
        return $this->hasMany("App\Models\Order");
    }

    /**
     *  获取用户账户模型关联
     *
     * @return UserAccount
     */
    public function userAccount()
    {
        return $this->hasOne("App\Models\UserAccount");
    }

    /**
     * 获取充值模型关联
     *
     * @return RechargeList
     */
    public function rechargeList()
    {
        return $this->hasMany("App\Models\RechargeList");
    }
    
}
