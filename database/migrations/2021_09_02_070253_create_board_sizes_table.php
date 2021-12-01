<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('board_sizes', function (Blueprint $table) {
            $table->id();
            $table->text('length')->nullable();
            $table->text('width')->nullable();
            $table->text('font_type')->nullable();
            $table->text('letter')->nullable();
            $table->text('predicted_length')->nullable();
            $table->text('price')->nullable();
            $table->text('weight')->nullable();
            $table->bigInteger('shop_id')->unsigned()->nullable();
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
        Schema::dropIfExists('board_sizes');
    }
}
