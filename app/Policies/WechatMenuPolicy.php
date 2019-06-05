<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Policies;

use App\Models\User;
use App\Models\WechatMenu;

/**
 * 微信菜单授权策略
 *
 * Class WechatMenuPolicy
 * @package App\Policies
 */
class WechatMenuPolicy extends Policy
{
    public function update(User $user, WechatMenu $wechat_menu)
    {
        return $user->can("manage_wechat");
    }

    public function destroy(User $user, WechatMenu $wechat_menu)
    {
        return $user->can("manage_wechat");
    }
}
