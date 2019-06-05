<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Handlers;

use App\Http\Requests\Request;
use App\Models\WechatMenu;
use App\Models\Wechat;
use App\Models\WechatResponse;
use EasyWeChat\Kernel\Contracts\EventHandlerInterface;

/**
 * 微信文本消息处理
 *
 * Class TextMessageHandler
 * @package App\Handlers
 */
class TextMessageHandler
{

    public function handle(Wechat $wechat, $message = []){
        return $this->text($wechat,$message['Content']);
    }

    /**
     * 文本响应处理
     *
     * @param Wechat $wechat
     * @param $key
     * @return null
     */
    protected function text(Wechat $wechat, $key){
        $response = WechatResponse::where('wechat_id',$wechat->id)->where('key', $key)->first();

        return $response ? $response->handle() : WechatResponse::defaultResponse($wechat->id);
    }


}
