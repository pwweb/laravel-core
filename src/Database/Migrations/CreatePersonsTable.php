<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PWWEB\Core\Models\Person;
use PWWEB\Localisation\Models\Country;

/**
 * CreatePersonsTable Migration.
 *
 * Standard migration for the Person Model.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            Person::getTableName(),
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('nationality_id')->index()->nullable();
                $table->string('title')->nullable();
                $table->string('name');
                $table->string('middle_name')->nullable();
                $table->string('surname');
                $table->string('maiden_name')->nullable();
                $table->string('gender')->nullable();
                $table->date('dob')->nullable();

                // Add virtual columns.
                $table->string('display_name')->virtualAs('CONCAT(name, " ", surname)')->nullable();
                $table->string('display_middle_name')->virtualAs('CONCAT(name, " ", middle_name, " ", surname)')->nullable();
                $table->string('select_name')->virtualAs('CONCAT(UPPER(surname), ", ", name)')->nullable();

                // Add foreign keys.
                $table->foreign('nationality_id')->references('id')->on(Country::getTableName());
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
        Schema::dropIfExists(Person::getTableName());
    }
}
