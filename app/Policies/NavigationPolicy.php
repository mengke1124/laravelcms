<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Policies;

use App\Models\User;
use App\Models\Navigation;

/**
 * 导航授权策略
 *
 * Class NavigationPolicy
 * @package App\Policies
 */
class NavigationPolicy extends Policy
{
    public function index(User $user, Navigation $navigation)
    {
        return $user->can('manage_navigation');
    }

    public function create(User $user, Navigation $navigation)
    {
        return $user->can('manage_navigation');
    }

    public function update(User $user, Navigation $navigation)
    {
        return $user->can('manage_navigation');
    }

    public function destroy(User $user, Navigation $navigation)
    {
        return $user->can('manage_navigation');
    }
}
