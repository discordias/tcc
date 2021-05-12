<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAxleCourseCurriculumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('axle_course_curriculum', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('axle_id')->unsigned();
            $table->bigInteger('course_curriculum_id')->unsigned();
            $table->foreign('axle_id')
                ->references('id')
                ->on('axles');
            $table->foreign('course_curriculum_id')
                ->references('id')
                ->on('course_curricula');
            $table->integer('total_minutes');
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
        Schema::dropIfExists('axle_course_curriculum');
    }
}
