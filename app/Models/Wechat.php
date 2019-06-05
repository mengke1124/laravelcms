<?php

namespace App\Models;

use EasyWeChat\Factory;
use App\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 微信公众号模型
 * 
 * Class Wechat
 *
 * @package App\Models
 * @property int $id
 * @property string $object_id objectId
 * @property string $type 公共号类型:subscribe订阅号;service服务号
 * @property string $name 公众号名称
 * @property string $account 原始ID
 * @property string $app_id appID
 * @property string $app_secret appSecret
 * @property string|null $url url
 * @property string|null $token Token
 * @property string|null $qrcode 二维码Code
 * @property string $primary 默认公众号:0未认证;1已认证
 * @property string $certified 认证类型:0未认证;1已认证
 * @property string $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Wechat onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereAppSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereCertified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat wherePrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereQrcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Wechat whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Wechat withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Wechat withoutTrashed()
 * @mixin \Eloquent
 */
class Wechat extends Model
{
    use SoftDeletes;
    
    public $table = 'wechat';
    protected $fillable = ['type', 'object_id', 'name', 'account', 'app_id', 'app_secret', 'url', 'token', 'qrcode', 'primary', 'certified'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'name';
    }

    public function app(){

        $config = config('wechat.default');
        $config['app_id'] = $this->app_id;
        $config['secret'] = $this->app_secret;

        return Factory::officialAccount($config);
    }
}
