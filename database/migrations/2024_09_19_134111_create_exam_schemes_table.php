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
        Schema::create('exam_schemes', function (Blueprint $table) {
            $table->id();
            $table->string('academic_session');
            $table->integer('school_id');
            $table->string('exam_type');
            $table->string('exam_class');
            $table->string('exam_subject');
            $table->date('exam_date');
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
        Schema::dropIfExists('exam_schemes');
    }
};
