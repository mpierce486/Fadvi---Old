<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDetailsTableColumnType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('details', function($table){
            $table->text('step_1')->nullable()->change();
            $table->text('step_2')->nullable()->change();
            $table->text('step_3')->nullable()->change();
            $table->text('step_4')->nullable()->change();
            $table->text('step_5')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
