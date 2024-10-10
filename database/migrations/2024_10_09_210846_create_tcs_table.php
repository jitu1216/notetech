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
        Schema::create('tcs', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('academic_session');
            $table->integer('school_id');
            $table->integer('class_id');
            $table->text('class_1')->nullable();
            $table->text('date_of_admission_1')->nullable();
            $table->text('date_of_promotion_1')->nullable();
            $table->text('date_of_removal_1')->nullable();
            $table->text('Causes_1')->nullable();
            $table->text('session_1')->nullable();
            $table->text('conduct_1')->nullable();
            $table->text('work_1')->nullable();
            $table->text('class_2')->nullable();
            $table->text('date_of_admission_2')->nullable();
            $table->text('date_of_promotion_2')->nullable();
            $table->text('date_of_removal_2')->nullable();
            $table->text('Causes_2')->nullable();
            $table->text('session_2')->nullable();
            $table->text('conduct_2')->nullable();
            $table->text('work_2')->nullable();
            $table->text('class_3')->nullable();
            $table->text('date_of_admission_3')->nullable();
            $table->text('date_of_promotion_3')->nullable();
            $table->text('date_of_removal_3')->nullable();
            $table->text('Causes_3')->nullable();
            $table->text('session_3')->nullable();
            $table->text('conduct_3')->nullable();
            $table->text('work_3')->nullable();
            $table->text('class_4')->nullable();
            $table->text('date_of_admission_4')->nullable();
            $table->text('date_of_promotion_4')->nullable();
            $table->text('date_of_removal_4')->nullable();
            $table->text('Causes_4')->nullable();
            $table->text('session_4')->nullable();
            $table->text('conduct_4')->nullable();
            $table->text('work_4')->nullable();
            $table->text('class_5')->nullable();
            $table->text('date_of_admission_5')->nullable();
            $table->text('date_of_promotion_5')->nullable();
            $table->text('date_of_removal_5')->nullable();
            $table->text('Causes_5')->nullable();
            $table->text('session_5')->nullable();
            $table->text('conduct_5')->nullable();
            $table->text('work_5')->nullable();
            $table->text('class_6')->nullable();
            $table->text('date_of_admission_6')->nullable();
            $table->text('date_of_promotion_6')->nullable();
            $table->text('date_of_removal_6')->nullable();
            $table->text('Causes_6')->nullable();
            $table->text('session_6')->nullable();
            $table->text('conduct_6')->nullable();
            $table->text('work_6')->nullable();
            $table->text('class_7')->nullable();
            $table->text('date_of_admission_7')->nullable();
            $table->text('date_of_promotion_7')->nullable();
            $table->text('date_of_removal_7')->nullable();
            $table->text('Causes_7')->nullable();
            $table->text('session_7')->nullable();
            $table->text('conduct_7')->nullable();
            $table->text('work_7')->nullable();
            $table->text('class_8')->nullable();
            $table->text('date_of_admission_8')->nullable();
            $table->text('date_of_promotion_8')->nullable();
            $table->text('date_of_removal_8')->nullable();
            $table->text('Causes_8')->nullable();
            $table->text('session_8')->nullable();
            $table->text('conduct_8')->nullable();
            $table->text('work_8')->nullable();
            $table->text('class_9')->nullable();
            $table->text('date_of_admission_9')->nullable();
            $table->text('date_of_promotion_9')->nullable();
            $table->text('date_of_removal_9')->nullable();
            $table->text('Causes_9')->nullable();
            $table->text('session_9')->nullable();
            $table->text('conduct_9')->nullable();
            $table->text('work_9')->nullable();
            $table->text('class_10')->nullable();
            $table->text('date_of_admission_10')->nullable();
             $table->text('date_of_promotion_10')->nullable();
            $table->text('date_of_removal_10')->nullable();
            $table->text('Causes_10')->nullable();
            $table->text('session_10')->nullable();
            $table->text('conduct_10')->nullable();
            $table->text('work_10')->nullable();
            $table->string('transfer_certificate_no');
            $table->string('withdrwal_file_no');
            $table->string('addmission_file_no');
            $table->string('tc_count');
            $table->string('tc_date');



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
        Schema::dropIfExists('tcs');
    }
};
