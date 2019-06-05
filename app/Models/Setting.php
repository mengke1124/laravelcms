<?php

namespace App\Models;

/**
 * 设置模型
 * 
 * Class Setting
 *
 * @package App\Models
 * @property int $id
 * @property string $owner 所属
 * @property string $module 模块
 * @property string $section 部分
 * @property string $key 键
 * @property string $value 值
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereModule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereSection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Setting whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    protected $fillable = [
        'owner', 'module', 'section','key','value',
    ];

    public $timestamps = false;

    /**
     * 取出
     *
     * @param $section
     * @param string $module
     * @param string $owner
     * @return mixed
     */
    public function take($section, $module = 'common', $owner = 'system'){
        return static::where(['owner'=>$owner,'module'=>$module,'section'=>$section,])->pluck('value','key')->toArray();
    }


    /**
     * 存储
     *
     * @param $data
     * @param $section
     * @param string $module
     * @param string $owner
     * @return bool
     */
    public function store($data, $section, $module = 'common', $owner = 'system'){
        foreach($data as $key => $value){
            empty($value) && $value = '';
            static::updateOrCreate(['owner'=>$owner,'module'=>$module,'section'=>$section,'key'=>$key], ['value'=> is_string($value) ? $value : json_encode($value)]);
        }
        
        return static::clearCache();
    }
    
    /**
     * 清除缓存
     */
    public static function clearCache(){
        $key = 'settings_cache';
        
        \Cache::forget($key);
        
        return true;
    }
    
    /**
     * 获取所有数据
     *
     * @return mixed
     */
    public static function getStore(){

        $key = 'settings_cache';

        $settings = \Cache::get($key);

        if( \App::environment('production') && $settings ){
            return $settings;
        }

        $settings = static::get();

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.settings', 10));
            \Cache::put($key, $settings, $expiredAt);
        }

        return $settings;
    }

    /**
     * 将数据库中的配置信息注入到框架中
     */
    public static function afflux(){
        $config = [];
        foreach(static::getStore() as $item){
            $key = "{$item->owner}.{$item->module}.{$item->section}.{$item->key}";
            $config[$key] = $item->value;
        }

        config($config);
    }

}
