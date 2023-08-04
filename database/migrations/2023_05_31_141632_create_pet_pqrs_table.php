<?php

use App\Models\Pet;
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
        Schema::create('pet_pqrs', function (Blueprint $table) {
            $table->id();
            $table->string('liable');
            $table->string('code');
            $table->foreignIdFor(Pet::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_pqrs');
    }
};
