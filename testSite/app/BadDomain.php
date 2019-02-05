<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BadDomain extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function clicks()
    {
        return $this->hasMany('App\Click');
    }
}
