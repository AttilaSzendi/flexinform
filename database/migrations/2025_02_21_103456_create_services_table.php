<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('car_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->integer('log_number')->default(0);
            $table->string('event');
            $table->dateTime('event_time')->nullable();
            $table->string('document_id');
            $table->timestamps();
            $table->unique(['client_id', 'car_id', 'log_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
