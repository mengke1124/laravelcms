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

class AddRemarksToRolesAndPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');

        Schema::table($tableNames['roles'], function (Blueprint $table) {
            $table->string('remarks')->nullable()->comment('备注');
        });

        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->string('remarks')->nullable()->comment('备注');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');
        Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        Schema::table($tableNames['roles'], function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
        Schema::table($tableNames['permissions'], function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
}
