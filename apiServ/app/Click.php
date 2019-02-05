<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Click extends Model
{
    use Sortable;

    public $fillable = ['click_id', 'ua', 'ip', 'param1', 'param2','error','bad_domain'];

    public $hidden = ['created_at', 'updated_at'];

    public $sortable = ['id','click_id', 'ua', 'ip', 'param1', 'param2','error'];

    public function bad_domains()
    {
        return $this->belongsTo('App\Bad_domain', 'ip', 'name');
    }
}
