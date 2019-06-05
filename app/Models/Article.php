<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\WithCommonHelper;
use App\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\Builder;


/**
 * 文章模型
 * 
 * Class Article
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $annex
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categorys
 * @property-read \App\Models\User $created_user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read \App\Models\User $updated_user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article active()
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAttribute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCreatedOp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereCss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereIsLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereJs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereObjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereReplyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereUpdatedOp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Article whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Article withoutTrashed()
 * @mixin \Eloquent
 */
class Article extends Model
{
    use SoftDeletes;
    use WithCommonHelper;
    use Searchable;


    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'title';
    }

    public $asYouType = true;

    protected $fillable = [
         'id','object_id', 'alias','title', 'subtitle', 'keywords', 'description', 'author', 'source', 'order', 'content', 'attribute', 'thumb', 'type', 'is_link','link', 'template', 'status', 'views', 'reply_count', 'weight', 'css', 'js', 'top', 'created_op', 'updated_op',
    ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where($builder->qualifyColumn('type'), '=', request('type','article'));
            $builder->with(['created_user','updated_user']);
        });
    }
    
    public function toSearchableArray()
    {
//        $array = $this->toArray();
        $array = [
            'id'                => $this->id,
            'title'             => $this->title,
            'subtitle'          => $this->subtitle,
            'keywords'          => $this->keywords,
            'description'       => $this->description,
            'author'            => $this->author,
            'content'           => $this->content,
        ];

        return $array;
    }


    public function user(){
        return $this->created_user();
    }

    public function created_user(){
        return $this->belongsTo(\App\Models\User::class, 'created_op');
    }

    public function updated_user(){
        return $this->belongsTo(\App\Models\User::class, 'updated_op');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * 获取多图
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function images(){
        return $this->multiple_files();
    }

    /**
     * 获取附件
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function annex(){
        return $this->multiple_files();
    }

    /**
     * 多对多多态关联
     *
     * @return MorphToMany
     */
    public function category(): MorphToMany
    {
        return $this->morphToMany(
            \App\Models\Category::class,
            'model',
            'model_has_category',
            'model_id',
            'category_id'
        );
    }

    /**
     * 多对多
     *
     * @return BelongsToMany
     */
    public function categorys(): BelongsToMany
    {
        return $this->belongsToMany(
            \App\Models\Category::class,
            'article_category',
            'article_id',
            'category_id'
        );
    }

    public function giveCategoryTo(...$categorys)
    {
        $categorys = collect($categorys)
            ->flatten()
            ->map(function ($category) {
                return $this->getStoredCategory($category);
            })
            ->each(function ($category) {
                $this->ensureModelSharesArticle($category);
            })
            ->all();

        $this->categorys()->saveMany($categorys);

        return $this;
    }


    public function syncCategory(...$categorys)
    {
        $this->categorys()->detach();

        return $this->giveCategoryTo($categorys);
    }

    protected function getStoredCategory($categorys)
    {
        if (is_string($categorys) || is_int($categorys)) {
            return app(Category::class)->find(intval($categorys));
        }

        if (is_array($categorys)) {
            return app(Category::class)
                ->whereIn('id', $categorys)
                ->get();
        }

        return $categorys;
    }

    protected function ensureModelSharesArticle($category)
    {
        if (! $category) {
            abort(401);
        }
    }

    /**
     * 生成文章链接
     *
     * @param int $navigation_id
     * @param int $category_id
     * @return string
     */
    public function getLink($navigation_id = 0, $category_id = 0){
        if($this->is_link == 1 && !empty($this->link)){
            return $this->link;
        }
        return route('article.show',[$navigation_id, $category_id, $this->id]);
    }

    /**
     * 复写获取属性方法，扩展自定义复合属性
     *
     * @param string $key
     * @return mixed|null
     */
    public function getAttribute($key){

        $value = parent::getAttribute($key);
        
        $attribute = parent::getAttribute('attribute');
        
        if(is_array($attribute)){
            $attribute = empty($attribute) ? new \stdClass() : $attribute;
        }else if( is_string( $attribute ) ){
            $attribute = empty($attribute) ? new \stdClass() : json_decode($attribute, true);
        }
        
        if( $key !== $value && is_array($attribute) && array_key_exists($key, $attribute)){
            $value = $attribute[$key] ?? null;
        }

        return $value;
    }
    
    /**
     * 清除缓存
     *
     * @param $id
     *
     * @return bool
     */
    public static function clearCache($id){
        $id = intval($id);
    
        $key = 'article_active_cache_'.$id;
    
        \Cache::forget($key);
        
        return true;
    }

    /**
     * 前台获取文章详情
     *
     * @param $id
     * @return mixed
     */
    public static function show( $id ){
        $id = intval($id);

        $key = 'article_active_cache_'.$id;

        $article = \Cache::get($key);

        if( \App::environment('production') && $article ){
            return $article;
        }

        $article = static::where('id', $id)->active()->first();

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.article', 10));
            \Cache::put($key, $article, $expiredAt);
        }

        return $article;
    }

}
