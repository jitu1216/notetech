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
        Schema::create('student_fees', function (Blueprint $table) {
            $table->id();
            $table->string('school_id');
            $table->string('academic_session');
            $table->integer('fees_type_id');
            $table->string('student_id');
            $table->string('class_id');
            $table->string('fees_amount');
            $table->string('fees_paid');
            $table->string('total_installment');
            $table->string('paid_installment');
            $table->integer('status');
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
        Schema::dropIfExists('student_fees');
    }
};
