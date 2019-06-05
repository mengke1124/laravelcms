<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 分类模型
 * 
 * Class Category
 *
 * @package App\Models
 * @property int $id
 * @property string $name 分类名称
 * @property string|null $keywords 关键字
 * @property string|null $description 描述
 * @property int $parent 父id
 * @property int $order 排序
 * @property string $path 路径
 * @property string $type 类型
 * @property string|null $link 链接
 * @property string|null $template 模板
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereTemplate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Category withoutTrashed()
 * @mixin \Eloquent
 */
class Category extends Model
{
    use SoftDeletes;
    
    protected $table = 'categorys';
    protected $fillable = ['id','name', 'keywords', 'description', 'parent', 'order', 'path', 'type', 'link', 'template', ];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    
    public function articles(){
        return $this->belongsToMany(
            \App\Models\Article::class,
            'article_category',
            'category_id',
            'article_id'
        );
    }
    
    /**
     * 检查是否允许删除
     */
    public function isDestroy(){
        
        // 1. 检查导航中是否已使用
        $navigations = Navigation::whereIn('type', ['article', 'category'])->get();
        foreach($navigations as $navigation){
            $params = is_json($navigation->params) ? json_decode($navigation->params) : new \stdClass;
            if( $this->id == $params->category_id ){
                return '导航已使用，无法删除！'; // 找到已使用，不允许删除
            }
        }
        
        // 2. 检查区块中是否已使用
        $blocks = Block::whereIn('type', ['latestArticle', 'hotArticle','latestProduct','hotProduct',])->get();
        foreach($blocks as $block){
            $params = is_json($block->params) ? json_decode($block->params) : new \stdClass;
            if( $this->id == get_value($params,'category_id', 0) ){
                return '区块已使用，无法删除！'; // 找到已使用，不允许删除
            }
        }
        
        // 3. 检查是否有子分类
        $count = static::where('parent',$this->id)->count();
        if($count > 0){
            return '当前分类下有子分类，无法删除！'; // 找到已使用，不允许删除
        }
        
        // 4. 检查分类下是否有文章
        $count = DB::table('article_category')->where('category_id',$this->id)->count();
        if($count > 0){
            return '当前分类下有内容，无法删除！'; // 找到已使用，不允许删除
        }
        
        return true; // 未被使用.可以删除
    }

    /**
     *
     * @param string $template
     * @return string
     */
    public function getTemplate( $template = 'index' ){
        if($this->template){
            $template = $template . '-' . strtolower($this->template);
        }

        return $template;
    }
    
    /**
     * 删除缓存
     *
     * @param        $id
     * @param string $type
     *
     * @return bool
     */
    public static function clearCache($id, $type = 'article'){
        $id      = intval($id);
        $type    = strtolower($type);
    
        $key = $type.'_category_active_cache_'.$id;
    
        \Cache::forget($key);
    
        return true;
    }

    /**
     * 前台获取分类详情
     *
     * @param $id
     * @param string $type
     * @return mixed
     */
    public static function show($id, $type = 'article' ){

        $id      = intval($id);
        $type    = strtolower($type);

        $key = $type.'_category_active_cache_'.$id;
        $category = \Cache::get($key);

        if( \App::environment('production') && $category ){
            return $category;
        }

        $category = static::where('id', $id)->where('type', $type)->first();

        if(\App::environment('production')){
            $expiredAt = now()->addMinutes(config('cache.expired.category', 10));
            \Cache::put($key, $category, $expiredAt);
        }

        return $category;
    }
}
