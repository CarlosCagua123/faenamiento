<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('pesajes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faena_id')->constrained()->cascadeOnDelete();
            $table->string('tipo', 20);   // vivo, canal, desposte
            $table->decimal('peso', 8, 2);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('pesajes');
    }
};
