<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class ArticleRequest extends Request
{
    public function rules()
    {

        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    'category_id' => 'required|array',
                    'category_id.*' => 'integer',
                    'title' => 'required|min:1|max:191',
                    'object_id' => 'required|alpha_dash|unique:articles|min:1|max:64',
                    'keywords' => 'nullable|max:191',
                    'description' => 'nullable|max:191',
                    'author' => 'nullable|max:191',
                    'source' => 'nullable|max:191',
                    'content' => 'required|min:1|max:65535',
                    'attribute' => 'nullable|array',
                    'thumb' => 'nullable|max:191',
                    'order' => 'nullable|integer',
                    'status' => 'nullable|integer',
                    'views' => 'nullable|integer',
                    'weight' => 'nullable|integer',
                    'top' => 'nullable|'.Rule::in(['0','1']),
                    'is_link' => 'nullable|'.Rule::in(['0','1']),
                    'link' => 'nullable|alpha_dash|unique:article|max:191',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'category_id' => 'required|array',
                    'category_id.*' => 'integer',
                    'title' => 'required|min:1|max:191',
                    'object_id' => 'required|alpha_dash|unique:articles,object_id,'.$this->article->id.'|min:1|max:64',
                    'keywords' => 'nullable|max:191',
                    'description' => 'nullable|max:191',
                    'author' => 'nullable|max:191',
                    'source' => 'nullable|max:191',
                    'content' => 'required|min:1|max:65535',
                    'attributes' => 'nullable|array',
                    'thumb' => 'nullable|max:191',
                    'order' => 'nullable|integer',
                    'status' => 'nullable|integer',
                    'views' => 'nullable|integer',
                    'weight' => 'nullable|integer',
                    'top' => 'nullable|'.Rule::in(['0','1']),
                    'is_link' => 'nullable|'.Rule::in(['0','1']),
                    'link' => 'nullable|alpha_dash|unique:article|max:191',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }
    
    public function attributes()
    {
        return [
            'category_id' => '分类',
        ];
    }
}
