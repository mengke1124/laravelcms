<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Permission;

/**
 * 权限授权策略
 *
 * Class PermissionPolicy
 * @package App\Policies
 */
class PermissionPolicy extends Policy
{

    public function index(User $user, Permission $permission)
    {
        return $user->can("manage_permissions");
    }

    public function manage(User $user, Permission $permission)
    {
        return $user->can("manage_permissions");
    }

    public function create(User $user, Permission $permission)
    {
        return $user->can("manage_permissions");
    }

    public function update(User $user, Permission $permission)
    {
        return $user->can("manage_permissions");
    }

    public function destroy(User $user, Permission $permission)
    {
        return $user->can("manage_permissions");
    }
}
