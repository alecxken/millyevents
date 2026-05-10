<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->string('reference')->unique();
            $table->integer('quantity')->default(1);
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('confirmed');
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('bookings'); }
};
