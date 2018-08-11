<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advisors', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('username');
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('image_path')->nullable();
            $table->string('advisor_type')->nullable();
            $table->string('title')->nullable();
            $table->string('firm_name')->nullable();
            $table->string('firm_address')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->text('services')->nullable();
            $table->text('about')->nullable();
            $table->string('designations')->nullable();
            $table->string('fees')->nullable();
            $table->string('languages')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advisors');
    }
}
