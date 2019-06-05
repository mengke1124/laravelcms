<?php

namespace App\Models;

/**
 * 区块模型
 * 
 * Class Block
 *
 * @package App\Models
 * @property int $id
 * @property string $object_id objectId
 * @property int $group 分组
 * @property string $type 类型
 * @property string $template 模板
 * @property string $title 标题
 * @property string|null $icon 图标
 * @property string|null $more_title 更多链接名称
 * @property string|null $more_link 更多链接
 * @property string|null $content 内容
 * @property int $created_op 创建人
 * @property int $updated_op 更新人
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereCreatedOp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereMoreLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereMoreTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Block whereUpdatedOp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @mixin \Eloquent
 */
class Block extends Model
{
    protected $fillable = ['id','type', 'object_id', 'title', 'template', 'icon', 'more_title', 'more_link', 'content','created_op','updated_op'];

    public function getRouteKeyName()
    {
        return 'id';
    }
    
    /**
     * 清除缓存
     *
     * @param $object_id
     *
     * @return bool
     */
    public static function clearCache($object_id){
        $key = 'block_cache_'.$object_id;
    
        \Cache::forget($key);
    
        return true;
    }
}
