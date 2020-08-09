<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsmeBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msme_buildings', function (Blueprint $table) {
            $table->string('msme_building_id', 7)->primary()->unsigned();
            $table->foreign('msme_building_id')->references('building_id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name_of_msme_building', 40);
            $table->foreignId('type_of_msme')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('monthly_income')->nullable();
            $table->integer('all_employee')->nullable();
            $table->string('owner_name', 40)->nullable();
            $table->string('contact_person', 40)->nullable();
            $table->integer('land_area')->nullable();
            $table->integer('parking_area')->nullable();
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
        Schema::dropIfExists('msme_buildings');
    }
}
