<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Observers;

use App\Models\Slide;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

/**
 * 幻灯观察者
 *
 * Class SlideObserver
 * @package App\Observers
 */
class SlideObserver
{
    public function creating(Slide $slide)
    {
        $slide->object_id = create_object_id();
        $slide->status = '1';
        $slide->order = 9999;
    }


    public function updating(Slide $slide)
    {
        
    }
}
