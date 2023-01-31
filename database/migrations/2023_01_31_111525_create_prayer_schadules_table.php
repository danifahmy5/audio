<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrayerSchadulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prayer_schadules', function (Blueprint $table) {
            $table->id();
            $table->time('subuh');
            $table->time('dhuhur');
            $table->time('ashar');
            $table->time('manggrip');
            $table->time('isya');
            $table->date('date');
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
        Schema::dropIfExists('prayer_schadules');
    }
}
