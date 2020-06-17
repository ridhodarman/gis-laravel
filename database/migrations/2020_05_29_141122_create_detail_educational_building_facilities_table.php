<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailEducationalBuildingFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_educational_building_facilities', function (Blueprint $table) {
            $table->string('educationalb_id', 7)->unsigned();
            $table->foreign('educationalb_id')->references('educational_building_id')->on('educational_buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('educational_building_facilities')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity_of_facilities');
            $table->timestamps();
            $table->primary(['educationalb_id', 'educational_building_facilities']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_educational_building_facilities');
    }
}
