<?php

use App\Models\Chip;
use App\Models\Race;
use App\Models\User;
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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('gender');
            $table->string('size');
            $table->decimal('weight');
            $table->string('vaccination_card')->nullable();
            $table->string('last_vaccination')->nullable();
            $table->string('last_external_parasites')->nullable();
            $table->string('last_deworming')->nullable();
            $table->string('medical_hisotry')->nullable();
            $table->foreignIdFor(Race::class);
            $table->foreignIdFor(Chip::class)->nullable();
            $table->foreignIdFor(User::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
