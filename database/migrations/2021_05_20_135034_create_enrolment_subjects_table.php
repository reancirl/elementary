<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolmentSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('enrolment_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('enrolment_id');
            $table->integer('subject_id');
            $table->float('first_grading_grade')->nullable();
            $table->float('second_grading_grade')->nullable();
            $table->float('third_grading_grade')->nullable();
            $table->float('fourth_grading_grade')->nullable();
            $table->integer('grade_status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrolment_subjects');
    }
}
