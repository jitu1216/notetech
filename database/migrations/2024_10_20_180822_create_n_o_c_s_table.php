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
        Schema::create('n_o_c_s', function (Blueprint $table) {
            $table->id();
            $table->string('academic_session');
            $table->integer('school_id');
            $table->integer('student_id');
            $table->string('exam_type');
            $table->string('receipt_no');
            $table->date('date');
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
        Schema::dropIfExists('n_o_c_s');
    }
};
