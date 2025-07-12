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
        Schema::create('sintia_room_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_type_id')->constrained('sintia_room_types')->onDelete('cascade');
            $table->foreignId('facility_id')->constrained('sintia_facilities')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sintia_room_facilities');
    }
};
