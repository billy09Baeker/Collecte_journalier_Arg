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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->string('type de paiement');
            $table->decimal('Montant',10,2)->default(0);
            $table->date('Date de Paiement');
            $table->string('Etat de paiement')->default("Non effectuer");
            $table->string("QR code path")->nullable();
            $table->timestamps();
        });

        Schema::create("transactions", function (Blueprint $table) {
            $table->id();
            $table->decimal('Montant',10,2);
            $table->string("Mode de Paiement");
            $table->date("Date");
            $table->timestamps();

        });
        Schema::create("recus",function(Blueprint $table){
            $table->id(); //Contenu ??
            $table->date("Date");
            $table->string("Path");
            $table->boolean("Etat du recu")->default(false);
            $table->decimal('Montant', 10, 2);
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
