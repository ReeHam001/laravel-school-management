<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAccountsTable extends Migration
{
    /**
     * Run the migrations. جدول حسابات الطلاب
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type');
            $table->foreignId('fee_invoice_id')->nullable()->references('id')->on('fee_invoices')->onDelete('cascade');   // فاتورة
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_students')->onDelete('cascade');   // مشان سند القبض
            $table->foreignId('processing_id')->nullable()->references('id')->on('processing_fees')->onDelete('cascade'); // سند قيد(معالجة)
            $table->foreignId('payment_id')->nullable()->references('id')->on('payment_students')->onDelete('cascade');   // سند صرف
            $table->foreignId('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->decimal('Debit',8,2)->nullable();   // كم عليه دين
            $table->decimal('credit',8,2)->nullable();  // كم دفع
            $table->string('description')->nullable();
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
        Schema::dropIfExists('student_accounts');
    }
}
