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
        Schema::create('topperstudents', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->string('academic_session');
            $table->integer('school_id');
            $table->integer('class_id');
            $table->string('total_mark_obtain');
            $table->string('subject_total');
            $table->string('rank');
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
        Schema::dropIfExists('topperstudents');
    }
};
