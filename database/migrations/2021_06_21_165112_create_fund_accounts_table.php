<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundAccountsTable extends Migration
{
    /**
     * Run the migrations.   جدول الصندوق
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_students')->onDelete('cascade');  // مشان رقم السند
            $table->foreignId('payment_id')->nullable()->references('id')->on('payment_students')->onDelete('cascade');
            $table->decimal('Debit',8,2)->nullable();    // مدين وقت الطالب بيدفع
            $table->decimal('credit',8,2)->nullable();   // دائن اذا رجع للطالب
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
        Schema::dropIfExists('fund_accounts');
    }
}
