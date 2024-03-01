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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_do_contrato');
            $table->string('ano_do_fechamento_do_contrato', 4);
            $table->string('objeto_do_contrato');
            $table->tinyInteger('status')->default(true);
            $table->string('tipo_do_servico_prestado');
            $table->string('importancia');
            $table->string('responsavel_interno_do_contrato');
            $table->string('due_diligence');
            $table->string('nivel_de_risco');
            $table->foreignId('terceiro_id')->constrained('terceiros')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
