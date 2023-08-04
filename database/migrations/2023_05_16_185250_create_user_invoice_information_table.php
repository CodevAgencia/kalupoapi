<?php

use App\Models\Type;
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
        Schema::create('user_invoice_information', function (Blueprint $table) {
            $table->id();
            $table->string('document_number');
            $table->string('name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('address');
            $table->string('email');
            $table->boolean('iva');
            $table->boolean('rent');
            $table->string('dv')->nullable();
            $table->foreignIdFor(Type::class, 'type_person');
            $table->foreignIdFor(Type::class, 'type_document');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_invoice_information');
    }
};
