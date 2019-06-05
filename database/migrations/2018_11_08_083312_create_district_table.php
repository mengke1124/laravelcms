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

class CreateDistrictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->increments('id');
            $table->string("citycode",30)->comment('城市编码');
            $table->string("adcode",30)->comment('区域编码');
            $table->string("name",30)->comment('行政区名称');
            $table->enum("level", ['country', 'province', 'city', 'district', 'street'])->comment('行政区划级别');
            $table->string("center",30)->comment('城市中心点');
            $table->integer("parent")->default(0)->comment('父级ID');
            $table->timestamps();
    
            $table->index('parent','parent_index');
            $table->index('adcode','adcode_index');
            $table->index('level','level_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('districts');
    }
}
