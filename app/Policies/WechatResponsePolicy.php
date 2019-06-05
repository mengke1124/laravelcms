<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Policies;

use App\Models\User;
use App\Models\WechatResponse;

/**
 * 微信响应授权策略
 *
 * Class WechatResponsePolicy
 * @package App\Policies
 */
class WechatResponsePolicy extends Policy
{
    public function update(User $user, WechatResponse $wechatResponse)
    {
        return $user->can("manage_wechat");
    }

    public function destroy(User $user, WechatResponse $wechatResponse)
    {
        return $user->can("manage_wechat");
    }
}
