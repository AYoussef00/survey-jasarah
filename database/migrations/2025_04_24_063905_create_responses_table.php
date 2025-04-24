<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // اسم المشارك
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('rating'); // عدد النجوم من 1 إلى 5
            $table->text('answers')->nullable(); // عمود لتخزين إجابات إضافية
            $table->text('notes')->nullable();   // عمود لتخزين ملاحظات إضافية
            $table->timestamps();
        });;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
