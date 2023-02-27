<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptStudentsTable extends Migration
{
    /**
     * Run the migrations.  جدول سندات القبض
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipt_students', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade'); // مين دفع
            $table->decimal('Debit',8,2)->nullable();   // الصندوق هو المدين وال الطالب دائن
            $table->string('description');
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
        Schema::dropIfExists('receipt_students');
    }
}
