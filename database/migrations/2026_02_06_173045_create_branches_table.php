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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('institute_id')
                ->constrained()
                ->cascadeOnDelete()
                ->index();

            $table->string('code', 7)->unique();
            $table->char('abbr', 3); // ITC
            $table->string('short_name', 30);
            $table->string('full_name', 50);

            // شعبه اصلی
            $table->boolean('is_main')->default(false)->index();

            $table->foreignId('province_id')->constrained()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();

            $table->string('address', 150)->nullable();
            $table->string('postal_code', 10)->nullable()->index();

            $table->string('phone', 15)->nullable();
            $table->string('mobile', 15)->nullable();

            $table->boolean('is_active')->default(true)->index();

            $table->timestamps();

            // فقط یک شعبهٔ اصلی برای هر موسسه
            $table->unique(['institute_id', 'is_main'], 'one_main_branch_per_institute');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
