<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohorts', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('training_location')->nullable();
            $table->longtext('description')->nullable();
            $table->unsignedBigInteger('academy_id')->nullable(); //need relation between cohort(academy_id) with academies (id)
            $table->unsignedBigInteger('fund_id')->nullable();
            $table->foreign('fund_id')->references('id')->on('funds')->nullable();
            $table->string('training_type')->nullable();
            $table->string('technology')->nullable();
            $table->string('donor_type')->nullable();
            $table->string('cohort_Rate')->nullable();

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
        Schema::dropIfExists('cohorts');
    }
}
