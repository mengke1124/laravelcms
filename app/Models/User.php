<?php

namespace App\Models;

use Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Traits\WithOrderHelper;
use App\Events\BehaviorLogEvent;

/**
 * 用户模型
 * 
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string $email_is_activated
 * @property string|null $email_activated_time
 * @property string $sex
 * @property string|null $email_verified_at
 * @property string|null $password
 * @property string|null $weixin_openid
 * @property string|null $weixin_unionid
 * @property string|null $weibo_id 微博openid
 * @property string|null $qq_id QQopenid
 * @property string|null $github_id Github openid
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $avatar
 * @property string|null $introduction
 * @property string $status 状态
 * @property int $notification_count
 * @property string|null $last_ip 最后一次登录IP
 * @property string|null $last_location 最后一次登录地址
 * @property \Illuminate\Support\Carbon|null $last_at 最后一次登录时间
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User recent($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailActivatedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailIsActivated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNotificationCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereQqId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWeiboId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWeixinOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereWeixinUnionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User withOrder($sortField, $sortOrder)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
 
//    use SoftDeletes;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'phone', 'email', 'password', 'avatar', 'introduction', 'status', 'weixin_openid', 'weixin_unionid', 'weibo_id', 'qq_id', 'github_id', 'last_ip', 'last_location', 'last_at',
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'last_at'];

    public function titleName(){
        return 'name';
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    use HasRoles;
    use WithOrderHelper;
    use Notifiable{
        notify as protected laravelNotify;
    }

    public function notify($instance)
    {
        // 如果要通知的人是当前用户，就不必通知了！
        if ($this->id == Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->laravelNotify($instance);
    }

    public function isAuthorOf($model)
    {
        return $this->id == $model->user_id;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute($value)
    {
        // 如果值的长度等于 60，即认为是已经做过加密的情况
        if (strlen($value) != 60) {

            // 不等于 60，做密码加密处理
            $value = bcrypt($value);
        }

        $this->attributes['password'] = $value;
    }

    /**
     * 处理用户头像地址
     *
     * @param $path
     */
    public function setAvatarAttribute($path)
    {
        $this->attributes['avatar'] = $path;
    }

    /**
     * 返回完整的头像地址
     *
     * @return mixed|string
     */
    public function getAvatar(){

        if ( ! starts_with($this->avatar, 'http')) {
            // 拼接完整的 URL
            $this->avatar = storage_image_url($this->avatar);
        }

        return $this->avatar;
    }



}
