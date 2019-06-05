<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Policies;

use App\Models\User;
use App\Models\Slide;

/**
 * 幻灯授权策略
 *
 * Class SlidePolicy
 * @package App\Policies
 */
class SlidePolicy extends Policy
{
    public function index(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }

    public function manage(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }

    public function create(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }

    public function update(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }

    public function destroy(User $user, Slide $slide)
    {
        return $user->can("manage_slide");
    }
}
