<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();

            $table->integer('student_id');
            $table->string('mothers_maiden_name')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('parents_contact_number')->nullable();

            $table->string('emergency_contact_person')->nullable();
            $table->string('emergency_contact_number')->nullable();
            $table->string('emergency_contact_person_relationship')->nullable();
            $table->string('emergency_contact_address')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('parents');
    }
}
