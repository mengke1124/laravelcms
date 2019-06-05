<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Transformers;

use App\Models\Page;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract
{
    public function transform(Page $page)
    {
        return [
            'id' => $page->id,
            'object_id' => $page->object_id,
            'title' => $page->title,
            'subtitle' => $page->subtitle,
            'keywords' => $page->keywords,
            'description' => $page->description,
            'author' => $page->author,
//            'thumb' => storage_image_url($page->thumb),
            'content' => $page->content,
            'is_link' => $page->is_link,
            'link' => $page->getLink(),
            'created_at' => $page->created_at->toDateTimeString(),
            'updated_at' => $page->updated_at->toDateTimeString(),
        ];
    }

}
