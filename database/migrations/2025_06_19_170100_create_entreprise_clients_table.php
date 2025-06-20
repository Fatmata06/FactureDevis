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
        Schema::create('entreprise_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agence_id')->constrained()->onDelete('cascade');
            $table->string('nom');
            $table->string('domaine');
            $table->string('adresse');
            $table->string('email')->unique();
            $table->string('logo')->nullable();
            $table->string('telephone');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entreprise_clients');
    }
};
