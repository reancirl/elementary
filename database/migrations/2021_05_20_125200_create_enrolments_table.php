<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrolmentsTable extends Migration
{
    public function up()
    {
        Schema::create('enrolments', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('school_year_id');
            $table->integer('section_id');
            $table->date('date_enroled')->useCurrent();
            $table->integer('enroled_by');
            $table->integer('withdrawn')->default(0);
            $table->integer('withdrawn_by')->nullable();
            $table->date('date_withdrawn')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enrolments');
    }
}
