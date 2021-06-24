<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolYearsTable extends Migration
{
    public function up()
    {
        Schema::create('school_years', function (Blueprint $table) {
            $table->id();
            $table->year('year_start');
            $table->year('year_end');
            $table->smallInteger('status')->default(0);
            $table->date('enrolment_start_date');
            $table->date('enrolment_end_date');
            $table->date('enrolment_modify_date_limit');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('school_years');
    }
}
