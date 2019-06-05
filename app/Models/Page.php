<?php

namespace App\Models;

use App\Models\Traits\WithCommonHelper;
use App\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;


/**
 * 页面模型
 * 
 * Class Page
 *
 * @package App\Models
 * @property int $id
 * @property string $object_id objectId
 * @property string|null $alias 别名
 * @property string $title 文章标题
 * @property string|null $subtitle 副标题
 * @property string|null $keywords 关键字
 * @property string|null $description 文章描述
 * @property string $author 文章作者
 * @property string|null $source 文章来源
 * @property string $content 文章内容
 * @property mixed|null $attribute 附加属性
 * @property string|null $thumb 封面
 * @property string $is_link isLink
 * @property string|null $link Link
 * @property string $type 类型
 * @property int $reply_count 回复量
 * @property int $views 浏览数
 * @property int $order 排序
 * @property int $weight 权重
 * @property string|null $template 模板
 * @property string|null $css style
 * @property string|null $js javascript
 * @property string $top 置顶
 * @property string $status 状态
 * @property int $created_op 创建人
 * @property int $updated_op 更新人
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $created_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @property-read \App\Models\User $updated_user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCreatedOp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereIsLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereJs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereReplyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereUpdatedOp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Page whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Page withoutTrashed()
 * @mixin \Eloquent
 */
class Page extends Model
{
    use WithCommonHelper;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', '=', 'page');
            $builder->with(['created_user','updated_user']);
        });
    }

    public $table = 'articles';
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    protected $fillable = [
        'id', 'object_id', 'alias','title', 'subtitle', 'keywords', 'description', 'author', 'source', 'order', 'content', 'thumb', 'type', 'is_link','link', 'template', 'status', 'views', 'weight', 'css', 'js', 'top', 'created_op', 'updated_op',
        'created_at', 'updated_at', 'deleted_at',
        ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    
    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'title';
    }

    public function created_user(){
        return $this->belongsTo(\App\Models\User::class, 'created_op');
    }

    public function updated_user(){
        return $this->belongsTo(\App\Models\User::class, 'updated_op');
    }

    /**
     * 生成单页面URL
     *
     * @param int $navigation_id
     * @return string
     */
    public function getLink($navigation_id = 0){
        if($this->is_link == 1 && !empty($this->link)){
            return $this->link;
        }
        return route('page.show',[$navigation_id, $this->id]);
    }
    
    /**
     * 检查是否允许删除
     */
    public function isDestroy(){
        $navigations = Navigation::where('type', 'page')->get();
        
        foreach($navigations as $navigation){
            $params = is_json($navigation->params) ? json_decode($navigation->params) : new \stdClass;
            if( $this->id == $params->page_id ){
                return false; // 找到已使用，不允许删除
            }
        }
        
        return true; // 未被使用.可以删除
    }

    /**
     * 前台获取页面详情
     *
     * @param $id
     * @return mixed
     */
    public static function show( $id ){
        $id = intval($id);

        $key = 'page_active_cache_'.$id;

        $page = \Cache::get($key);

        if( \App::environment('production') && $page ){
            return $page;
        }

        $page = static::where('id', $id)->active()->first();

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.page', 10));
            \Cache::put($key, $page, $expiredAt);
        }

        return $page;
    }

}
