<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('test_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_plan_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('preconditions')->nullable();
            $table->text('steps');
            $table->text('expected_result');
            $table->string('priority')->default('medium');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('test_cases'); }
};
