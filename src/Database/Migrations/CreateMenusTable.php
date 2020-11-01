<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PWWEB\Core\Database\Seeders\MenuSeeder;
use PWWEB\Core\Models\Menu;

/**
 * CreateMenusTable Migration.
 *
 * Standard migration for the Menu Item Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            Menu::getTableName(),
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('route');
                $table->string('title');
                $table->boolean('separator');
                $table->string('class')->nullable();
                $table->boolean('visible')->default(true);
                $table->timestampsTz();
                $table->nestedSet();
            }
        );

        Artisan::call('db:seed', [
            '--force' => true,
            '--class' => MenuSeeder::class,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Menu::getTableName());
    }
}
