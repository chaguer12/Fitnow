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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
             // On attend qu’un coiffeur (utilisateur de type Coiffeur) soit affecté à la file
            $table->foreignId('coiffeur_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('salon_id')->constrained()->onDelete('cascade');
            $table->string('status'); // Ex: 'ouverte', 'fermée'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
