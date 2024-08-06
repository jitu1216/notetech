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
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('UserCode');
            $table->string('Username');
            $table->string('Name');
            $table->string('Address');
            $table->string('Email');
            $table->string('Mobile');
            $table->string('Package');
            $table->date('Start_Date');
            $table->date('Expiry_Date');
            $table->integer('Source');
            $table->string('Logo');
            $table->string('Password');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schools');
    }
};
