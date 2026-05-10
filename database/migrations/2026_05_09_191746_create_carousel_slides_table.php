<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('carousel_slides', function (Blueprint $table) {
            $table->id();
            $table->string('tag');
            $table->string('headline');
            $table->text('sub_text')->nullable();
            $table->string('btn_primary_label')->default('Reserve a Seat');
            $table->string('btn_secondary_label')->default('Learn More');
            $table->string('date_display')->nullable();
            $table->string('venue_display')->nullable();
            $table->string('price_display')->nullable();
            $table->string('bg_color')->default('#07332c');
            $table->integer('sort_order')->default(0);
            $table->boolean('active')->default(true);
            $table->foreignId('event_id')->nullable()->constrained('events')->nullOnDelete();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('carousel_slides'); }
};
