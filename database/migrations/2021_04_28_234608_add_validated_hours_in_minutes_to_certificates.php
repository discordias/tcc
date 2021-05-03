<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidatedHoursInMinutesToCertificates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->integer('validated_hours_in_minutes')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropColumn('validated_hours_in_minutes');
        });
    }
}
