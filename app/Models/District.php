<?php

namespace App\Models;

/**
 * 中国行政区
 * 
 * Class Block
 *
 * @package App\Models
 * @property int $id
 * @property string $citycode 城市编码
 * @property string $adcode 区域编码
 * @property string $name 行政区名称
 * @property string $level 行政区划级别
 * @property string $center 城市中心点
 * @property int $parent 父级ID
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereAdcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereCenter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereCitycode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\District whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @mixin \Eloquent
 */
class District extends Model
{
    protected $fillable = ['id','citycode', 'adcode', 'name', 'level', 'center', 'parent'];
}
