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
        Schema::create('fees_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('school_id');
            $table->string('academic_session');
            $table->integer('fees_type_id');
            $table->string('student_id');
            $table->string('class_id');
            $table->string('reciept_no');
            $table->string('fees_pending');
            $table->string('fees_paid');
            $table->string('deposor_name');
            $table->string('paid_installment');
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
        Schema::dropIfExists('fees_transactions');
    }
};
