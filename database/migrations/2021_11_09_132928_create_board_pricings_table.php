<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardPricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_pricings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('board_id')->nullable();
            $table->integer('characters_count')->nullable();
            $table->bigInteger('font_group_id')->nullable();
            $table->float('pricing')->nullable();
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
        Schema::dropIfExists('board_pricings');
    }
}
