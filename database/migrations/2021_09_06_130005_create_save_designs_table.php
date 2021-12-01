<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaveDesignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('save_designs', function (Blueprint $table) {
            $table->id();
            $table->text('slug')->nullable();
            $table->text('text')->nullable();
            $table->text('font')->nullable();
            $table->text('color')->nullable();
            $table->text('length')->nullable();
            $table->text('width')->nullable();
            $table->text('shape')->nullable();
            $table->text('supply')->nullable();
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
        Schema::dropIfExists('save_designs');
    }
}
