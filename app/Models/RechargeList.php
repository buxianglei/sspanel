<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RechargeList extends Model
{
    /**
     * 用户模型关联
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    /**
     * 获取用户账户模型
     *
     * @return UserAccount
     */
    public function userAccount()
    {
        return $this->belongsTo("App\Models\UserAccount");
    }
}
