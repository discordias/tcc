<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourseCurriculumToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('course_curriculum_id')
                ->unsigned()
                ->nullable()
                ->default(null)
                ->onUpdate('cascade');
            $table->foreign('course_curriculum_id')
                ->references('id')
                ->on('course_curricula');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_course_curriculum_id_foreign');
            $table->dropColumn('course_curriculum_id');
        });
    }
}
