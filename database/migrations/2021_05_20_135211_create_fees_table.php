<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{

    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->integer('enrolment_id');
            $table->integer('student_id');
            $table->decimal('total_amount', 8, 2);
            $table->decimal('paid_amount', 8, 2)->default(0);
            $table->decimal('remaining_balance', 8, 2);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
