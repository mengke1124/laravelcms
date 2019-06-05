<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 幻灯模型
 * 
 * Class Slide
 *
 * @package App\Models
 * @property int $id
 * @property string $object_id objectId
 * @property int $group 分组
 * @property string $title 标题
 * @property string $description 描述
 * @property string $target 是否新建标签
 * @property string $link URL
 * @property string $image 图片
 * @property int $order 排序
 * @property string $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slide onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereTarget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Slide whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slide withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Slide withoutTrashed()
 * @mixin \Eloquent
 */
class Slide extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['id','object_id', 'group', 'title', 'description', 'target', 'link', 'image', 'order', 'status'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    /**
     * 追加过滤条件
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

}
