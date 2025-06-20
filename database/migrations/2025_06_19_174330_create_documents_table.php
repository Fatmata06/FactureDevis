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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_client_id')->constrained()->onDelete('cascade');
            $table->foreignId('client_final_id')->constrained()->onDelete('cascade');
            $table->string('type'); // 'devis' ou 'facture'
            $table->string('reference')->unique();
            $table->date('date');
            $table->decimal('montant', 10, 2)->default(0);
            $table->string('statut')->default('en attente'); // ou "payé", "envoyé", etc.
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
