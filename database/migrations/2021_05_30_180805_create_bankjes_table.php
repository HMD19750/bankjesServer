<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankjesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankjes', function (Blueprint $table) {
            $table->id();
            $table->string("typeBankje");
            $table->decimal("Latitude", $precision = 10, $scale = 8);
            $table->decimal("Longitude", $precision = 11, $scale = 8);
            $table->string("source")->default("osm");
            $table->string("status")->default("osm");
            $table->timestamps();

            $table->index(['Latitude', 'Longitude']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bankjes');
    }
}
