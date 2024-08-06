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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('school_id');
            $table->string('academic_session');
            $table->string('center_name');
            $table->string('center_code');
            $table->string('staff_name');
            $table->string('staff_code');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('gender');
            $table->string('date_of_birth');
            $table->string('religion');
            $table->string('category');
            $table->string('caste');
            $table->string('locality_type');
            $table->string('village');
            $table->string('post_type');
            $table->string('town');
            $table->string('state');
            $table->string('city');
            $table->string('pincode');
            $table->string('mobile');
            $table->string('email');
            $table->string('nationality');
            $table->string('appointment_date');
            $table->string('appointment_position');
            $table->string('id_type');
            $table->string('qualification');
            $table->string('occupation');
            $table->string('identity_no');
            $table->string('experience_qualification');
            $table->string('experience_year');
            $table->string('image');
            $table->string('experience_certificate');
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('staff');
    }
};
