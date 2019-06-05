<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\Redis;

/**
 * 微信控制器
 *
 * Class WeChatController
 * @package App\Http\Controllers
 */
class TestController extends Controller
{

   public function redis(Request $request){
       
       
       
       $this->updateCounter('hits', 1, now());
       
        echo 'redis';
   }
   
   protected function updateCounter($name,  $count, $now){
       
       $precision = [1, 5, 60, 300, 3600, 18000, 86400];
       
       Redis::pipeline(function($pipe) use ($precision, $name,  $count, $now){
           foreach($precision as $prec){
               $pnow = intval($now->timestamp / $prec) * $prec;
               $hash = sprintf("%s:%s", $prec, $name);
               $pipe->zadd('known:', floatval(0), $hash);
               $pipe->hincrby('count:'.$hash, $pnow, $count);
           }
       });
       
   }
   
}
