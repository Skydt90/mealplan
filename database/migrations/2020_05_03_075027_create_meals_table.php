<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('day_id')->nullable();
            $table->string('name', 50);
            $table->unsignedTinyInteger('effort')->default(1)->comment('1: easy, 2: medium, 3: avarage, 4: hard');
            $table->timestamps();
            $table->foreign('day_id')->references('id')->on('days')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
