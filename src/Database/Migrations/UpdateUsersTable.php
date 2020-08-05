<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use PWWEB\Core\Models\Person;
use PWWEB\Core\Models\User;

/**
 * UpdateSystemUsersTable Migration.
 *
 * Standard update migration for the User Models.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            User::getTableName(),
            function (Blueprint $table) {
                $table->foreignId('person_id')->after('id')->nullable();
                // $table->string('name')->nullable()->change();
            }
        );

        Schema::table(
            User::getTableName(),
            function (Blueprint $table) {
                if (true === Schema::hasColumn(User::getTableName(), 'name')) {
                    // $table->renameColumn('name', 'username');
                }

                $table->foreign('person_id')->references('id')->on(Person::getTableName());
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
        $tableName = User::getTableName();

        Schema::table(
            $tableName,
            function (Blueprint $table) {
                $table->renameColumn('username', 'name');
            }
        );

        Schema::table(
            $tableName,
            function (Blueprint $table) {
                $table->string('username')->nullable(false)->change();
            }
        );

        if (true === Schema::hasColumn($tableName, 'person_id')) {
            Schema::table(
                $tableName,
                function (Blueprint $table) {
                    $table->dropColumn('person_id');
                    $table->dropForeign('person_id');
                }
            );
        }
    }
}
