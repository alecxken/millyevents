<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('test_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('features_to_test')->nullable();
            $table->text('features_not_to_test')->nullable();
            $table->text('pass_criteria')->nullable();
            $table->text('fail_criteria')->nullable();
            $table->text('approach')->nullable();
            $table->text('testing_materials')->nullable();
            $table->text('conclusion')->nullable();
            $table->text('recommendation')->nullable();
            $table->string('status')->default('draft'); // draft, active, completed
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('test_plans'); }
};
