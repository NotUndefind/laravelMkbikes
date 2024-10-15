<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();  // Email unique
            $table->boolean('is_subscribed')->default(true);  // Abonnement actif ou non
            $table->timestamp('subscribed_at')->nullable();  // Date d'inscription
            $table->timestamp('unsubscribed_at')->nullable();  // Date de désabonnement
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('subscribers');
    }
};
