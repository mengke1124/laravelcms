<?php
/**
 * CMS - CMS based on laravel
 *
 * @category  CMS
 * @package   Laravel
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Setting;

class SeedSettingsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 站点信息
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'status', 'value' => '0']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'close_tips', 'value' => '非常抱歉，站点正在维护，稍后恢复...']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'name', 'value' => config('app.name')]);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'copyright', 'value' => 'CMS']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'create_year', 'value' => date('Y')]);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'keywords', 'value' => 'mycms']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'index_keywords', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'slogan', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'icp', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'icp_link', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'meta', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'description', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'basic', 'key' => 'statistics', 'value' => '']);

        // 公司信息
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'company', 'key' => 'name', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'company', 'key' => 'description', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'company', 'key' => 'content', 'value' => '']);

        // 联系方式
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'contacts', 'value' => 'sudongyan']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'phone', 'value' => '13300000000']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'fax', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'email', 'value' => 'sudongyan1874@gmail.com']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'qq', 'value' => '0000000']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'weixin', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'weibo', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'wangwang', 'value' => '']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'site', 'value' => 'http://localhost/']);
        Setting::create(['owner' => 'system', 'module' => 'common', 'section' => 'contact', 'key' => 'address', 'value' => 'Beijing']);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Setting::where('id', '>', 0)->delete();
    }
}
