<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('category')->default('General');
            $table->string('venue');
            $table->string('location');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('capacity')->default(100);
            $table->integer('slots_taken')->default(0);
            $table->string('status')->default('upcoming');
            $table->string('image_url')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('published')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('events'); }
};
