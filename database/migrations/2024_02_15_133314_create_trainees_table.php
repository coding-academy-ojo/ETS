<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTraineesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trainees', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('mobile')->nullable();
            $table->string('graduated');
            $table->string('certificat_type');
            $table->string('nationality');
            $table->string('country'); // Change from text to string
            $table->string('passport_number')->nullable();
            $table->bigInteger('national_id')->nullable();
            $table->date('birthdate');
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('third_name')->nullable();
            $table->string('last_name');
            $table->string('ar_first_name')->nullable();
            $table->string('ar_second_name')->nullable();
            $table->string('ar_third_name')->nullable();
            $table->string('ar_last_name')->nullable();
            $table->string('gender');
            $table->string('martial_status');
            $table->string('education');
            $table->string('educational_status');
            $table->string('field');
            $table->string('educational_background');
            $table->string('city');
            $table->string('address');
            $table->string('id_img');
            $table->unsignedBigInteger('academy_id');
            $table->unsignedBigInteger('cohort_id');
            $table->string('personal_img');
            $table->string('vaccination_img');
            $table->string('git_hub');
            $table->string('linkedin');
            $table->enum('employment_status', ['employed',  'unemployed'])->default('unemployed');
            $table->enum('internship_status', ['interned', 'not_interned'])->default('not_interned');
            $table->string('stack');
            $table->string('trainee_cv',1000)->nullable();
            $table->foreign('academy_id')->references('id')->on('academies');
            $table->foreign('cohort_id')->references('id')->on('cohorts');
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
        Schema::dropIfExists('trainees');
    }
}
