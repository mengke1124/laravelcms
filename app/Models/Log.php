<?php

namespace App\Models;

/**
 * 日志模型
 * 
 * Class Log
 *
 * @package App\Models
 * @property int $id
 * @property string $group 分组
 * @property string $type 类型
 * @property string $account 用户名
 * @property string $browser 浏览器
 * @property string $host Host
 * @property string $uri Uri
 * @property string $method Method
 * @property string $model
 * @property string $ip IP
 * @property string $location 地址
 * @property string $user_agent UserAgent
 * @property string $description 操作内容
 * @property string $data 数据
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereBrowser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Log whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @mixin \Eloquent
 */
class Log extends Model
{
    protected $fillable = ['group','type', 'account', 'browser', 'host', 'uri', 'method', 'model', 'ip', 'location', 'user_agent', 'description', 'data', 'user_id',];
}
