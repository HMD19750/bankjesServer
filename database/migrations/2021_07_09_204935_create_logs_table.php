<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string("ip");
            $table->string("action");
            $table->unsignedBigInteger('bankje_id')->references('id')->on('bankjes_table')->nullable();
            $table->decimal("Lat", $precision = 10, $scale = 8)->nullable();
            $table->decimal("Lng", $precision = 11, $scale = 8)->nullable();
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
        Schema::dropIfExists('logs');
    }
}
