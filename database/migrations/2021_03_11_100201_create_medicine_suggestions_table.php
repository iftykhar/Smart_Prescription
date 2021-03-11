<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('symptom_name');
            $table->string('medicine_name');
            $table->integer('medicine_days');
            $table->integer('medicine_morning');
            $table->integer('medicine_afternoon');
            $table->integer('medicine_evening');
            $table->integer('medicine_night');
            $table->integer('medicine_continues');
            $table->integer('ms_score');
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
        Schema::dropIfExists('medicine_suggestions');
    }
}
