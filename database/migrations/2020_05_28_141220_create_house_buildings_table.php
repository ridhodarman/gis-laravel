<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_buildings', function (Blueprint $table) {
            $table->string('house_building_id', 7)->primary()->unsigned();
            $table->foreign('house_building_id')->references('building_id')->on('buildings')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('owner_id', 25)->nullable()->unsigned();

            $table->integer('land_building_tax')->nullable();
            $table->integer('land_area')->nullable();
            $table->char('building_status', 1)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('family_cards', function (Blueprint $table) {
            $table->foreign('house_building_id')
                ->references('house_building_id')
                ->on('house_buildings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('family_cards', function (Blueprint $table) {
            $table->dropForeign(['house_building_id']);
        });
        
        Schema::dropIfExists('house_buildings');
    }
}
