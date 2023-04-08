<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_id');
            $table->string('nickname')->nullable();
            $table->integer('age');
            $table->date('birthdate');
            $table->enum('martial_status', ['Single', 'Married', 'Divorced', 'Widowed']);
            $table->enum('sex', ['Male', 'Female', 'Choose not to say']);
            $table->string('occupation');
            $table->string('home_address');
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
        Schema::dropIfExists('patient_information');
    }
}
