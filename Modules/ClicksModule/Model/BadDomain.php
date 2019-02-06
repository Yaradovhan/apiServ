<?php

namespace Modules\ClicksModule\Model;

use Illuminate\Database\Eloquent\Model;

class BadDomain extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    protected $fillable = ['name'];
    protected $hidden = ['created_at', 'updated_at'];

    public function clicks()
    {
        return $this->hasMany('Modules\ClicksModule\Click');
    }
}
