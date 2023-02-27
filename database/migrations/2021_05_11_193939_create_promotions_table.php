<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('student_id');             // مين هو الطالب
            $table->unsignedBigInteger('from_grade');           // جاي من اي مرحلة
            $table->unsignedBigInteger('from_Classroom');   // من أي صف
            $table->unsignedBigInteger('from_section');        // من أي قسم

            $table->unsignedBigInteger('to_grade');            // وين بدو يروح
            $table->unsignedBigInteger('to_Classroom');
            $table->unsignedBigInteger('to_section');

            $table->string('academic_year');
            $table->string('academic_year_new');

            $table->timestamps();
        });

        Schema::table('promotions', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('from_grade')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreign('from_Classroom')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreign('from_section')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('to_grade')->references('id')->on('Grades')->onDelete('cascade');
            $table->foreign('to_Classroom')->references('id')->on('Classrooms')->onDelete('cascade');
            $table->foreign('to_section')->references('id')->on('sections')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
