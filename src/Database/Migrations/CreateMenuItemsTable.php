<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use PWWEB\Core\Models\Menu\Item;

/**
 * CreateMenuItemsTable Migration.
 *
 * Standard migration for the Menu Item Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            Item::getTableName(),
            function (Blueprint $table) {
                $table->id('id');
                $table->foreignId('environment_id');
                $table->integer('_lft');
                $table->integer('_rgt');
                $table->foreignId('parent_id')->nullable();
                $table->integer('level');
                $table->string('identifier');
                $table->string('title');
                $table->boolean('separator');
                $table->string('class');

                $table->timestampsTz();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Item::getTableName());
    }
}
