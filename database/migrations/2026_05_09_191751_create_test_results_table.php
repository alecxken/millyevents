<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_case_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->text('actual_result')->nullable();
            $table->text('notes')->nullable();
            $table->timestamp('tested_at');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('test_results'); }
};
