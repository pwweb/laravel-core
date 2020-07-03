<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PWWEB\Core\Models\Menu\Environment;

/**
 * CreateMenuEnvironmentsTable Migration.
 *
 * Standard migration for the Menu Environment Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CreateMenuEnvironmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            Environment::getTableName(),
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
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
        Schema::drop(Environment::getTableName());
    }
}
