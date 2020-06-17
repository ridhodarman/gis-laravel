<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->string('building_id', 7)->primary();
            $table->integer('building_area')->nullable();
            $table->integer('standing_year')->nullable();
            $table->integer('electricity_capacity')->nullable();
            $table->text('address')->nullable();
            $table->char('tap_water', 1)->nullable();
            $table->foreignId('building_model')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_of_construction')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->char('heirloom_status_of_the_land', 1)->nullable();
            $table->char('heirloom_status_of_the_building', 1)->nullable();
            $table->multiPolygon('geom');
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
        Schema::dropIfExists('buildings');
    }
}
