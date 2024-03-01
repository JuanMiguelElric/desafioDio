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
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->dropColumn('ativo');
            $table->string('descricao', 255)->nullable();
            $table->string('cliente', 255)->default("PHRSSEC – Segurança da Informação");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('avaliacoes', function (Blueprint $table) {
            $table->addColumn('tinyInteger', 'ativo');
            $table->dropColumn('descricao');
            $table->dropColumn('cliente');
        });
    }
};
