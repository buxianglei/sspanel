<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    public function node()
    {
        return $this->belongsTo("App\Models\Node");
    }

    public function order()
    {
        return $this->hasOne("App\Models\Order");
    }
}
