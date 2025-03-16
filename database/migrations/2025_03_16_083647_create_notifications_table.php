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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->date("Date");
            $table->string("Message");
            $table->enum('type', ['fraud_alert', 'transaction_processing', 'payment_completed', 'payment_cancelled']);
            $table->timestamps();
        });
        Schema::create("rapports",function(Blueprint $table){
            $table->id();
            $table->date('Date');
            $table->string('Rapport path');
            $table->timestamps();
        });
        Schema::create('tableau_de_bords',function(Blueprint $table){
            $table->id();
            $table->timestamps();
            $table->decimal('Collecte Total');
            $table->integer("Nombre Transaction");
            $table->integer("Nombre de Clients");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
