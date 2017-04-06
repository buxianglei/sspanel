<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function plan()
    {
        return $this->belongsTo("App\Models\Plan");
    }

    public function user()
    {
        return $this->hasOne("App\Models\User");
    }
}
