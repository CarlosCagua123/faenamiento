<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('faenas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cerdo_id')->constrained()->cascadeOnDelete();
            $table->date('fecha');
            $table->string('categoria', 20)->nullable(); // normal/urgente
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('faenas');
    }
};
