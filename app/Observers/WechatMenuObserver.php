<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Observers;

use App\Models\WechatMenu;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 微信菜单观察者
 *
 * Class WechatMenuObserver
 * @package App\Observers
 */
class WechatMenuObserver
{
    public function creating(WechatMenu $wechat_menu)
    {
        //
    }

    public function updating(WechatMenu $wechat_menu)
    {
        //
    }

    public function saving(WechatMenu $wechat_menu){
        if(is_array($wechat_menu->data) || is_object($wechat_menu->data)){
            $wechat_menu->data = json_encode($wechat_menu->data, JSON_UNESCAPED_UNICODE);
        }

        $wechat_menu->order || $wechat_menu->order = 999;
    }
}
