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
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tache_id')->constrained()->onDelete('cascade');
            $table->string('filename');           // Nom original du fichier
            $table->string('filepath');           // Chemin de stockage (storage/app/public/...)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Qui a uploadé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};
