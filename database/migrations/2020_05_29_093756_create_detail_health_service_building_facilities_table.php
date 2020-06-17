<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailHealthServiceBuildingFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_health_service_building_facilities', function (Blueprint $table) {
            $table->string('healthb_id', 7)->unsigned();
            $table->foreign('healthb_id')->references('health_service_building_id')->on('health_service_buildings')->onDelete('cascade')->onUpdate('cascade');
            
            // $table->unsignedBigInteger('facility_id')->nullable();
            // $table->foreign('facility_id')->references('id')->on('health_service_building_facilities')->onDelete('cascade')->onUpdate('cascade');
            //$table->dropForeign(['health_service_building_facilities']);
            $table->foreignId('health_service_building_facilities')->constrained()->onDelete('cascade')->onUpdate('cascade');
            
            $table->integer('quantity_of_facilities');
            $table->timestamps();
            $table->primary(['healthb_id', 'health_service_building_facilities']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_health_service_building_facilities');
    }
}
