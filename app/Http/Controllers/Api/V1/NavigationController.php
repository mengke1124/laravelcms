<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller;

/**
 * 导航控制器
 *
 * Class NavigationController
 * @package App\Http\Controllers\Api\V1
 */
class NavigationController extends Controller
{
    /**
     * 列表
     *
     * @param string $navigation_type
     * @return mixed
     */
    public function index($navigation_type = 'desktop')
    {
        return $this->response->array(frontend_navigation($navigation_type));
    }
}
