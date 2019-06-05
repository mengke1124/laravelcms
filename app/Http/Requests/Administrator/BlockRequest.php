<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Http\Requests\Administrator;

use Illuminate\Validation\Rule;

class BlockRequest extends Request
{
    public function rules()
    {

        return [
            'type' => 'required|'.Rule::in(array_keys(config('blocks.types'))),
            'title' => 'required|min:1|max:255',
            'more_title' => 'nullable|max:255',
            'more_link' => 'nullable|max:255',
        ];
    }
    
    public function attributes()
    {
        return [
            'type' => '类型',
            'title' => '名称',
            'more_title' => '更多链接标题',
            'more_link' => '更多链接地址',
        ];
    }
}
