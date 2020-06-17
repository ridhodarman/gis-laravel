<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailOfficeBuildingFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_office_building_facilities', function (Blueprint $table) {
            $table->string('officeb_id', 7)->unsigned();
            $table->foreign('officeb_id')->references('office_building_id')->on('office_buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('office_building_facilities')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity_of_facilities');
            $table->timestamps();
            $table->primary(['officeb_id', 'office_building_facilities']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_office_building_facilities');
    }
}
