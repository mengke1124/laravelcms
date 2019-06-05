<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Observers;

use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 用户观察者
 *
 * Class UserObserver
 * @package App\Observers
 */
class UserObserver
{

    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }
}
