<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->id();
            $table->string('num');
            $table->string('year');
            $table->string('caseno');
            $table->date('filing_date');
            $table->date('n_date');
            $table->string('n_for');
            $table->string('status')->default('Under Trial');
            $table->string('final_result')->nullable();
            $table->string('pdf')->nullable();
            $table->date('date_final_result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
};
