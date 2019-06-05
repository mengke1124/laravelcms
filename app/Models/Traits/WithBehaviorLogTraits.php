<?php

namespace App\Models\Traits;

use App\Events\BehaviorLogEvent;

trait WithBehaviorLogTraits
{
    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    /**
     * 返回记录日志的字段名称
     *
     * @return string
     */
    public function titleName(){
        return 'title';
    }

}
