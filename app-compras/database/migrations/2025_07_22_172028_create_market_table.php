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
       Schema::create('markets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Nombre del supermercado');
            $table->string('slug')->unique()->comment('Slug del supermercado');
            $table->string('logo')->nullable()->comment('Logo del supermercado');

            $table->boolean('active')->default(true)->comment('¿Está activo el supermercado?');
            $table->timestamps();
        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market');
    }
};
