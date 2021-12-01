<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->integer('indoor')->nullable();
            $table->integer('outdoor')->nullable();
            $table->integer('remote_dimmer')->nullable();
            $table->integer('wall_mounting')->nullable();
            $table->integer('sign_hang')->nullable();
            $table->integer('cut_around_acrylic')->nullable();
            $table->integer('rectangle_acrylic')->nullable();
            $table->integer('cut_letter')->nullable();
            $table->integer('acrylic_stand')->nullable();
            $table->integer('open_box')->nullable();
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
        Schema::dropIfExists('options');
    }
}
