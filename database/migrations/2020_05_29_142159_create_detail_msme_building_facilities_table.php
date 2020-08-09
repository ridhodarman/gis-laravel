<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMsmeBuildingFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_msme_building_facilities', function (Blueprint $table) {
            $table->string('msmeb_id', 7)->unsigned();
            $table->foreign('msmeb_id')->references('msme_building_id')->on('msme_buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('msme_building_facilities')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantity_of_facilities');
            $table->timestamps();
            $table->primary(['msmeb_id', 'msme_building_facilities']);
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
        Schema::dropIfExists('detail_msme_building_facilities');
    }
}
