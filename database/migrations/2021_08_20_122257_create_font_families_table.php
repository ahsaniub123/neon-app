<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFontFamiliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('font_families', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('price')->nullable();
            $table->longText('url')->nullable();
            $table->text('type')->nullable();
            $table->text('size')->nullable();
            $table->bigInteger('shop_id')->unsigned()->nullable();
            $table->integer('price_number')->nullable();
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
        Schema::dropIfExists('font_families');
    }
}
