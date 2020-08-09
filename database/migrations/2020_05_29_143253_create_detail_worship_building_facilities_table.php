<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailWorshipBuildingFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_worship_building_facilities', function (Blueprint $table) {
            $table->string('worshipb_id', 7)->unsigned();
            $table->foreign('worshipb_id')->references('worship_building_id')->on('worship_buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('worship_building_facilities')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity_of_facilities');
            $table->timestamps();
            $table->primary(['worshipb_id', 'worship_building_facilities']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_worship_building_facilities');
    }
}
