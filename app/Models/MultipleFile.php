<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;

/**
 * 分类模型
 * 
 * Class Category
 *
 * @package App\Models
 * @property int $id
 * @property int $multiple_file_table_id
 * @property string $multiple_file_table_type
 * @property string $field
 * @property int $order 排序
 * @property string|null $path 路径
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\File $file
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $multiple_file_table
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile whereField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile whereMultipleFileTableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile whereMultipleFileTableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MultipleFile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @mixin \Eloquent
 */
class MultipleFile extends Model
{
    protected $table = 'multiple_files';
    protected $fillable = ['id','multiple_file_table_id', 'multiple_file_table_type', 'field', 'order', 'path', ];

    public function multiple_file_table(){
        return $this->morphTo();
    }

    public function file()
    {
        return $this->hasOne(\App\Models\File::class, 'path', 'path');
    }

    public function toArray()
    {
        $array = [
            'id'        => $this->id,
            'field'     => $this->field,
            'order'     => $this->order,
            'path'      => $this->path,

            'name'     => $this->file->title,
            'folder'    => $this->file->folder,
            'size'      => $this->file->size,
            'origSize'  => $this->file->size,
            'type'      => $this->file->mime_type,
        ];

        if($this->file->type == 'image'){
            $array['previewImage']  = $array['url'] = storage_image_url($this->path);
        }else{
            $array['url'] = storage_url($this->path);
        }

        return $array;
    }

}
