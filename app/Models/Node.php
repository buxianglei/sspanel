<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    public function plan()
    {
        return $this->hasMany("App\Models\Plan");
    }
}
