<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorshipBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worship_buildings', function (Blueprint $table) {
            $table->string('worship_building_id', 7)->primary()->unsigned();
            $table->foreign('worship_building_id')->references('building_id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name_of_worship_building', 40);
            $table->foreignId('type_of_worship')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('land_area')->nullable();
            $table->integer('parking_area')->nullable();
            $table->integer('all_imams')->nullable();
            $table->integer('all_teenagers')->nullable();
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
        Schema::dropIfExists('worship_buildings');
    }
}
