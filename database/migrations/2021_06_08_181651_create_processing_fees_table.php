<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessingFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processing_fees', function (Blueprint $table) {
            $table->id();
            $table->date('date');  // تاريخ الحركة
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->decimal('amount',8,2)->nullable();  // مبلغ الاستبعاد
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
        Schema::dropIfExists('processing_fees');
    }
}


// الطالب عليه 12 الف   2 رسوم باص
// دفع 6 الاف منها الف للباص
// معد بدو يركب باص
// منعمل استبعاد رسوم الباص  2


// بدنا نرجعلو الالف تبع الباص
// منعملو سند صرف بالالف
// الصندوق بينقص الف


// الطالب كنسل من كل المدرسة
