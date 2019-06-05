<?php

namespace App\Models;

use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use App\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 微信响应模型
 * 
 * Class WechatResponse
 *
 * @package App\Models
 * @property int $id
 * @property int $wechat_id 公众号ID
 * @property string $key Key
 * @property string $group 分组
 * @property string $type 类型
 * @property string|null $source 来源
 * @property string $content 消息内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatResponse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatResponse whereWechatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatResponse withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatResponse withoutTrashed()
 * @mixin \Eloquent
 */
class WechatResponse extends Model
{
    use SoftDeletes;
    
    public $table = 'wechat_response';
    protected $fillable = ['wechat_id', 'key', 'group', 'type', 'source', 'content'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'key';
    }

    /**
     * 生成响应内容
     *
     * @return News|Text|null
     */
    public function handle(){
        switch (strtolower($this->type)){
            case 'text':
                $text = new Text(get_json_params($this->content,'text'));
                return $text;
                break;
            case 'link':
                $text = new Text(get_json_params($this->content,'link'));
                return $text;
                break;
            case 'news':
                $items = [];
                $content = is_json($this->content) ? json_decode($this->content) : new \stdClass();
                $category_id = get_value($content, 'category_id', 0);
                $limit = get_value($content, 'limit', 6);
                $results =  Category::find($category_id)->articles()->recent()->offset(0)->limit($limit)->get();
                foreach($results as $article){
                    $items[] = new NewsItem([
                        'title'       => $article->title,
                        'description' => $article->description,
                        'url'         => $article->getLink(),
                        'image'       => $article->getThumb(),
                    ]);
                }

                return new News($items);
                break;
            default:
                return null;
                break;
        }
    }

    /**
     * 默认响应
     *
     * @param $wechat_id
     * @return null
     */
    public static function defaultResponse($wechat_id){
       $response = static::where('wechat_id', $wechat_id)->where('key', 'default')->first();

       return $response ? $response->handle() : null;
    }
}
