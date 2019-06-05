<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;

/**
 * 角色授权策略
 *
 * Class RolePolicy
 * @package App\Policies
 */
class RolePolicy extends Policy
{

    public function index(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }

    public function manage(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }

    public function create(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }

    public function update(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }

    public function destroy(User $user, Role $role)
    {
        return $user->can("manage_roles");
    }
}
