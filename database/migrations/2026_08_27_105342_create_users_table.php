<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
    public function up(): void{
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('password');
            $table->string('phoneNumber', 9)->unique();
            $table->decimal('saldo', 10, 2)->default(0);
            $table->decimal('despesasMensais', 10, 2)->default(0);
            $table->decimal('salarioBruto', 10, 2)->default(0);
            $table->decimal('salarioLiquido', 10, 2)->default(0);
            $table->boolean('saldoDefinido')->default(false);
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }
    public function down(): void{
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
