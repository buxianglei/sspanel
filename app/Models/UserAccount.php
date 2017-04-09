<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    /**
     * 获取用户模型关联
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    /**
     * 充值模型关联
     *
     * @return RechargeList
     */
    public function rechargeList()
    {
        return $this->hasOne("App\Models\RechargeList");
    }
}
