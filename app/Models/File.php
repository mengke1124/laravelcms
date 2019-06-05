<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 文件模型
 * 
 * Class File
 *
 * @package App\Models
 * @property int $id
 * @property string $type 文件类型
 * @property string $disks 文件类型
 * @property string $path 文件路径
 * @property string $mime_type 文件mimeType
 * @property string $md5 Md5
 * @property string $title 文件标题
 * @property string $folder 文件对象类型
 * @property string $object_id 文件对象ID
 * @property string|null $storage_id 文件对象ID
 * @property int $size 文件大小
 * @property int $width 宽度
 * @property int $height 高度
 * @property int $downloads 下载次数
 * @property string $public 是否公开
 * @property string $editor 富编辑器图片
 * @property string $status 附件状态
 * @property int $created_op 创建人
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedOp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereDisks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereDownloads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereEditor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereFolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereMd5($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File wherePublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereStorageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereWidth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\File withoutTrashed()
 * @mixin \Eloquent
 */
class File extends Model
{
    use SoftDeletes;
    protected $fillable = ['id','type', 'disks', 'path', 'mime_type', 'md5', 'title', 'folder', 'object_id', 'storage_id', 'size', 'width', 'height', 'downloads', 'public', 'editor', 'status', 'created_op'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
}
