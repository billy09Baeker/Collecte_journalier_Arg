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
        Schema::create('collecteurs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("email")->unique();
            $table->timestamp("email_verified_at")->nullable();
            $table->string("password");
            $table->rememberToken(); 
            $table->float("performance")->default(0);

            $table->timestamps(); #created_at: A TIMESTAMP column that stores the date and time when the record was created. and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collecteurs');
    
    }
};

