<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('irs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->enum('residencia', ['Continente', 'Açores', 'Madeira']);
            $table->boolean('emAtividade')->default(false);
            $table->boolean('incapacidade')->default(false);
            $table->boolean('casado')->default(false);
            $table->boolean('conjugeEmAtividade')->default(false);
            $table->unsignedInteger('dependentes')->default(0);
            $table->boolean('deficientesArmadas')->default(false);
            $table->decimal('salarioBruto', 10, 2)->default(0);
            $table->decimal('salarioLiquido', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void{
        Schema::dropIfExists('irs');
    }
};
