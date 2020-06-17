<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_buildings', function (Blueprint $table) {
            $table->string('office_building_id', 7)->primary()->unsigned();
            $table->foreign('office_building_id')->references('building_id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name_of_office_building', 40);
            $table->foreignId('type_of_office')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('land_area')->nullable();
            $table->integer('parking_area')->nullable();
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
        Schema::dropIfExists('office_buildings');
    }
}
