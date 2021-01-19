<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * UpdateSystemTaxRatesTable Migration.
 *
 * Standard update migration for the Tax Rates Models.
 *
 * @author    Frank Pillukeit <frank.pillukeit@pw-websolutions.com>
 * @author    Richard Browne <richard.browne@pw-websolutions.com>
 * @copyright 2020 pw-websolutions.com
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */
class UpdateTaxRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('pwweb.core.table_names');
        $columnNames = config('pwweb.core.column_names');

        Schema::table(
            $tableNames['tax']['rates'],
            function (Blueprint $table) {
                $table->decimal('decimal', 8, 6)->virtualAs('rate/100')->after('rate');
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
        $tableNames = config('pwweb.core.table_names');
        $columnNames = config('pwweb.core.column_names');

        Schema::table(
            $tableNames['tax']['rates'],
            function (Blueprint $table) {
                $table->dropColumn('decimal');
            }
        );
    }
}
