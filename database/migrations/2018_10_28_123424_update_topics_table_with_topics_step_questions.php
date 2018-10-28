<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTopicsTableWithTopicsStepQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('topics', function($table){
            $table->text('step_1_question');
            $table->text('step_2_question');
            $table->text('step_3_question')->nullable();
            $table->text('step_4_question')->nullable();
            $table->text('step_5_question')->nullable();
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
            $table->dropColumn('step_1_question');
            $table->dropColumn('step_2_question');
            $table->dropColumn('step_3_question');
            $table->dropColumn('step_4_question');
            $table->dropColumn('step_5_question');
        });
    }
}
