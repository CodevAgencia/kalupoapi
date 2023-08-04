<?php

use App\Models\Chip;
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
        Schema::create('notification_chips', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('address');
            $table->foreignIdFor(Chip::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification_chips');
    }
};
