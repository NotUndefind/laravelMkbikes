<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->string('backgroundImg');
            $table->string('altBgImg')->nullable();
            $table->string('logoImg');
            $table->string('altLogoImg')->nullable();
            $table->string('actionImg');
            $table->string('altActionImg')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('brands');
    }
};
