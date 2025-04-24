<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('responses', function (Blueprint $table) {
            // لو العمود موجود فعلاً، نعدله
            $table->unsignedTinyInteger('rating')->default(1)->change(); // رقم من 1 إلى 255، نحطه من 1
        });

        DB::statement("ALTER TABLE responses ADD CONSTRAINT rating_range CHECK (rating BETWEEN 1 AND 5)");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE responses DROP CONSTRAINT rating_range");

        Schema::table('responses', function (Blueprint $table) {
            $table->integer('rating')->change();
        });
    }
};
