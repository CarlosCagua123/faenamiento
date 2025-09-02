<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inspecciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faena_id')->constrained()->cascadeOnDelete();
            $table->string('inspector')->nullable();
            $table->string('resultado', 20); // aprobado/rechazado/condicionado
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('inspecciones');
    }
};
