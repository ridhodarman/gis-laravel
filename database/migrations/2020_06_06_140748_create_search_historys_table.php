<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistorysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_historys', function (Blueprint $table) {
            $table->id();
            $table->string('national_identity_number', 20);
            $table->string('name', 40);
            $table->string('phone_number', 15);
            $table->text('address');
            $table->foreignId('job_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->text('necessary');
            $table->string('search_type', 90);
            $table->string('search_value', 90);
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('search_historys');
    }
}
