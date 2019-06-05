<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Observers;

use App\Models\WechatResponse;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 微信响应观察者
 *
 * Class WechatResponseObserver
 * @package App\Observers
 */
class WechatResponseObserver
{
    public function creating(WechatResponse $wechatResponse)
    {
        //
    }

    public function updating(WechatResponse $wechatResponse)
    {
        //
    }

    public function saving(WechatResponse $wechatResponse)
    {
        if(is_array($wechatResponse->content) || is_object($wechatResponse->content)){
            $wechatResponse->content = json_encode($wechatResponse->content, JSON_UNESCAPED_UNICODE);
        }
    }
}
