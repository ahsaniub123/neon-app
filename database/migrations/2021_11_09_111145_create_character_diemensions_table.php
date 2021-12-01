<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacterDiemensionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('character_diemensions', function (Blueprint $table) {
            $table->id();
            $table->string('char_name')->nullable();
            $table->string('char_type')->nullable();
            $table->integer('font_type')->nullable();
            $table->string('board_size')->nullable();
            $table->float('length')->nullable();
            $table->float('height')->nullable();
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
        Schema::dropIfExists('character_diemensions');
    }
}
