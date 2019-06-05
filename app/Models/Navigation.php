<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\BehaviorLogEvent;

/**
 * 导航模型
 * 
 * Class Navigation
 *
 * @package App\Models
 * @property int $id
 * @property string $category 导航分类
 * @property string $type 类型
 * @property string $title 标题
 * @property string|null $description 描述
 * @property string $target 是否新建标签
 * @property string|null $link URL
 * @property string|null $image 图片
 * @property string|null $icon 图标
 * @property int $parent 父id
 * @property string $path 路径
 * @property mixed $params 参数
 * @property string $is_show 是否显示
 * @property int $order 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Navigation onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Navigation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Navigation withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Navigation withoutTrashed()
 * @mixin \Eloquent
 */
class Navigation extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','category', 'type', 'title', 'description', 'target', 'link', 'image', 'icon', 'parent', 'path', 'params', 'order', 'is_show'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    
    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'title';
    }
    
    /**
     * 清除缓存
     *
     * @param $id
     * @param $category
     *
     * @return bool
     */
    public static function clearCache($id, $category = 'desktop'){
        $key = 'navigation_cache_'.$category;
        \Cache::forget($key);
    
        $key = 'navigation_item_cache_'.$id;
        \Cache::forget($key);
        
        return true;
    }
    
}
