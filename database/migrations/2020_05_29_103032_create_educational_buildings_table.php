<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationalBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educational_buildings', function (Blueprint $table) {
            $table->string('educational_building_id', 7)->primary()->unsigned();
            $table->foreign('educational_building_id')->references('building_id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name_of_educational_building', 40);
            $table->foreignId('level_of_education')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('all_students')->nullable();
            $table->integer('all_teachers')->nullable();
            $table->string('headmaster_name', 40)->nullable();
            $table->char('school_type', 1)->nullable();
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
        Schema::dropIfExists('educational_buildings');
    }
}
