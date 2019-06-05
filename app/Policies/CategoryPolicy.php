<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

/**
 * 分类授权策略
 *
 * Class CategoryPolicy
 * @package App\Policies
 */
class CategoryPolicy extends Policy
{
    public function index(User $user, Category $category)
    {
        return $user->can('manage_category');
    }

    public function create(User $user, Category $category)
    {
        return $user->can('manage_category');
    }

    public function update(User $user, Category $category)
    {
        return $user->can('manage_category');
    }

    public function destroy(User $user, Category $category)
    {
        return $user->can('manage_category');
    }
}
