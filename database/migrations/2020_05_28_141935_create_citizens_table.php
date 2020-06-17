<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->string('national_identity_number', 25)->primary();
            $table->string('name', 40);
            $table->char('gender', 1)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('place_of_birth', 40)->nullable();
            $table->string('mother_name', 40)->nullable();
            $table->string('father_name', 40)->nullable();
            $table->char('marital_status', 1)->nullable();
            $table->char('blood_group', 1)->nullable();
            $table->string('religion', 10)->nullable();
            $table->foreignId('educations')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('job_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('datuk_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('income')->nullable();
            
            // $table->unsignedBigInteger('education_id')->nullable();
            // $table->foreign('education_id')->references('id')->on('educations')->onDelete('cascade')->onUpdate('cascade');

            $table->string('family_card_number', 25)->nullable()->unsigned();
            $table->foreign('family_card_number')->references('family_card_number')->on('family_cards')->onDelete('cascade')->onUpdate('cascade');

            $table->string('status_in_family', 15)->nullable();
            $table->timestamps();
        });

        Schema::table('house_buildings', function (Blueprint $table) {
            $table->foreign('owner_id')
                ->references('national_identity_number')
                ->on('citizens')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('house_buildings', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
        });

        Schema::dropIfExists('citizens');
    }
}
