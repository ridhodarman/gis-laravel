<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthServiceBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('health_service_buildings', function (Blueprint $table) {
            $table->string('health_service_building_id', 7)->primary()->unsigned();
            $table->foreign('health_service_building_id')->references('building_id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name_of_service_health_building', 40);
            $table->foreignId('type_of_health_service')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('all_medical_personnel')->nullable();
            $table->integer('all_non_medical_personnel')->nullable();
            $table->string('name_of_head', 40)->nullable();
            $table->integer('parking_area')->nullable();
            $table->integer('land_area')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('health_service_buildings');
    }
}
