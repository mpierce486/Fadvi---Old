<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTopicsTableWithOptionsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function($table){
            $table->text('step_1_options');
            $table->text('step_2_options');
            $table->text('step_3_options');
            $table->text('step_4_options');
            $table->text('step_5_options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('topics', function($table) {
            $table->dropColumn('step_1_options');
            $table->dropColumn('step_2_options');
            $table->dropColumn('step_3_options');
            $table->dropColumn('step_4_options');
            $table->dropColumn('step_5_options');
        });
    }
}
