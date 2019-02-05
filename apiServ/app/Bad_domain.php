<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bad_domain extends Model
{
    public function clicks()
    {
        return $this->hasMany('App\Click');
    }
}
