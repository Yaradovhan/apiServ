<?php

namespace Modules\ClicksModule\Model;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Click extends Model
{
    use Sortable;

    protected $fillable = ['click_id', 'ua', 'ip', 'param1', 'param2','error','bad_domain'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $sortable = ['id','click_id', 'ua', 'ip', 'param1', 'param2','error'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function badDomains()
    {
        return $this->belongsTo('Modules\ClicksModule\Model\BadDomain', 'ip', 'name');
    }

}
