<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class
CreateEmploymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employment_logs', function (Blueprint $table) {
            $table->id();
            $table->string('status')->nullable();
            $table->string('company');
            $table->string('position');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('Sourse Of Information')->nullable();
            $table->unsignedBigInteger('academy_id')->nullable();
            $table->foreign('academy_id')->references('id')->on('academies')->onDelete('cascade');
            $table->unsignedBigInteger('cohort_id')->nullable();
            $table->foreign('cohort_id')->references('id')->on('cohorts')->onDelete('cascade');
            $table->unsignedBigInteger('trainee_id')->nullable();
            $table->foreign('trainee_id')->references('id')->on('trainees')->onDelete('cascade');
            $table->string('created_by')->nullable();
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
        Schema::dropIfExists('employment_logs');
    }
}
