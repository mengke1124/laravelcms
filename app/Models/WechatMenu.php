<?php

namespace App\Models;

use EasyWeChat\Kernel\Messages\Text;
use EasyWeChat\Kernel\Messages\News;
use EasyWeChat\Kernel\Messages\NewsItem;
use App\Events\BehaviorLogEvent;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * 微信菜单模型
 * 
 * Class WechatMenu
 *
 * @package App\Models
 * @property int $id
 * @property int $group 公众号ID
 * @property int $parent 父id
 * @property string $name 菜单名称
 * @property string $type 类型
 * @property string|null $data 附加内容
 * @property int $order 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MultipleFile[] $multiple_files
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMenu onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ordered($sortOrder = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model recent($sortOrder = 'desc')
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereParent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenu whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model withOrder($sortField, $sortOrder)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMenu withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\WechatMenu withoutTrashed()
 * @mixin \Eloquent
 */
class WechatMenu extends Model
{
    use SoftDeletes;
    
    public $table = 'wechat_menu';
    protected $fillable = ['group', 'parent', 'name', 'type', 'data', 'order'];
    
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public $dispatchesEvents  = [
        'saved' => BehaviorLogEvent::class,
    ];

    public function titleName(){
        return 'name';
    }

    /**
     * 生成菜单响应
     *
     * @return News|Text|null
     */
    public function handle(){
        switch (strtolower($this->type)){
            case 'text':
                $text = new Text(get_json_params($this->data,'text'));
                return $text;
                break;
            case 'content':
                $items = [];

                $data = is_json($this->data) ? json_decode($this->data) : new \stdClass();
                $category_id = get_value($data, 'category_id', 0);
                $limit = get_value($data, 'limit', 6);

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
            case 'event':
                // 扩展自定义事件....
                // return Event::$action($this->wechat_id);
                return null;
                break;
            default:
                return null;
                break;
        }
    }
}
