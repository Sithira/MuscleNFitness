<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('weight');
            $table->string('height');
            $table->string('bmi');
            $table->string('fat');
            $table->string('chest');
            $table->string('waist');
            $table->string('hip');
            $table->string('arm_left');
            $table->string('arm_right');
            $table->string('forearm_left');
            $table->string('forearm_right');
            $table->string('thigh_left');
            $table->string('thigh_right');
            $table->string('calf_left');
            $table->string('calf_right');
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
        Schema::dropIfExists('measurements');
    }
}
