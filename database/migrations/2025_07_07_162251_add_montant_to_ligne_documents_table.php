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
Schema::table('ligne_documents', function (Blueprint $table) {
    $table->decimal('montant', 10, 2)->default(0)->after('quantite');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligne_documents', function (Blueprint $table) {
            //
        });
    }
};
