<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * 获取套餐模型关联
     *
     * @return Plan
     */
    public function plan()
    {
        return $this->belongsTo("App\Models\Plan");
    }

    /**
     * 获取用户模型关联
     *
     * @return User
     */
    public function user()
    {
        return $this->hasOne("App\Models\User");
    }
}
