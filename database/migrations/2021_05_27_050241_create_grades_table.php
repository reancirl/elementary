<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradesTable extends Migration
{
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('section_id');
            $table->integer('subject_id');
            $table->string('type');
            $table->integer('number_of_items')->default(10);
            $table->integer('passing_score')->nullable();
            $table->date('date')->nullable();
            $table->date('deadline')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
