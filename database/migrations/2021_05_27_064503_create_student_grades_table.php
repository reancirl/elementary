<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGradesTable extends Migration
{
    public function up()
    {
        Schema::create('student_grades', function (Blueprint $table) {
            $table->id();
            $table->integer('enrolment_subject_id');
            $table->integer('grade_id');
            $table->integer('score');
            $table->float('percentage');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('school_info', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('image');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_grades');
    }
}
