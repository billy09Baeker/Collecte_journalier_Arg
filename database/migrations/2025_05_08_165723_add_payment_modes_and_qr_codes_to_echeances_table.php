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
        Schema::table('echeances', function (Blueprint $table) {
            $table->string('mode_paiement_1')->nullable()->after('date_echeance');
            $table->string('qr_code_1')->nullable()->after('mode_paiement_1'); // Chemin de l'image
            $table->string('mode_paiement_2')->nullable()->after('qr_code_1');
            $table->string('qr_code_2')->nullable()->after('mode_paiement_2'); // Chemin de l'image
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('echeances', function (Blueprint $table) {
            $table->dropColumn(['mode_paiement_1', 'qr_code_1', 'mode_paiement_2', 'qr_code_2']);
        });
    }
};
