<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cerdos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lote_id')->constrained()->cascadeOnDelete();
            $table->string('arete')->unique();         // Identificador del cerdo
            $table->string('sexo', 1)->nullable();     // 'M' o 'H'
            $table->decimal('peso_inicial', 8, 2)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('estado', 20)->default('vivo'); // vivo/faenado/baja
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('cerdos');
    }
};
