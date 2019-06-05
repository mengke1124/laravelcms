<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Observers;

use App\Models\Wechat;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 微信公众号菜单观察者
 *
 * Class WechatObserver
 * @package App\Observers
 */
class WechatObserver
{
    public function creating(Wechat $wechat)
    {
        $wechat->object_id || $wechat->object_id = create_object_id();

    }

    public function saving(Wechat $wechat){
        $wechat->token || $wechat->token = str_random(64);
    }

    public function updating(Wechat $wechat)
    {
        //
    }
}
