<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Listeners;

use Ip;
use DB;
use Log;
use Request;
use Illuminate\Support\Carbon;
use Vod\Request\V20170321 as Vod;
use App\Jobs\GetVodCoverURL;


class ArticleEventSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $event
     */
    public function onArticleSaved($event){

    }

    /**
     * 更新 Vod 视频缩略图
     *
     * @param $event
     */
    public function onVideoSaved($event){
        $article = $event->article;
        $attribute = json_decode($article->attribute, true);

        if( $attribute['video_id'] ){ // 更新 vod 视频缩略图
            // 分发任务, 30 秒后
            GetVodCoverURL::dispatch($article->id, $attribute, 0)->delay(now()->addSeconds(30));
        }

    }


    /**
     * 为订阅者注册监听器。
     *
     * @param
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\ArticleSavedEvent',
            'App\Listeners\ArticleEventSubscriber@onArticleSaved'
        );

        $events->listen(
            'App\VideoSavedEvent',
            'App\Listeners\UserEventSubscriber@onVideoSaved'
        );

    }
}
