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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('departure_point');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('booking_cancel_deadline');
            $table->integer('total_seats');
            $table->integer('available_seats');
            $table->decimal('price',10,2);
            $table->enum('status', ['scheduled', 'in-progress', 'completed'])->default('scheduled');
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
