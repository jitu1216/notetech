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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('application_no');
            $table->string('application_date');
            $table->string('admission_date')->nullable();
            $table->string('sr_no')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('student_name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->integer('class_id');
            $table->string('gender');
            $table->string('dob');
            $table->string('religion');
            $table->string('category');
            $table->string('caste')->nullable();
            $table->string('village');
            $table->string('town')->nullable();
            $table->string('district');
            $table->string('state');
            $table->integer('pincode');
            $table->string('mobile');
            $table->string('email');
            $table->string('nationality');
            $table->string('transport');
            $table->string('father_occupation');
            $table->string('aadhar_no');
            $table->string('last_institute')->nullable();
            $table->string('subject_id');
            $table->string('academic_session');
            $table->string('school_id');
            $table->string('image');
            $table->string('status');
            $table->string('reject_reason');
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
        Schema::dropIfExists('students');
    }
};
