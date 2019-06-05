<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Policies;

use App\Models\User;
use App\Models\Form;

/**
 * 表单授权策略
 *
 * Class PagePolicy
 * @package App\Policies
 */
class FormPolicy extends Policy
{

    public function index(User $user, Form $form)
    {
        return $user->can("manage_form");
    }

    public function show(User $user, Form $form)
    {
        return $user->can("manage_form");
    }

    public function destroy(User $user, Form $form)
    {
        return $user->can("manage_form");
    }
}
