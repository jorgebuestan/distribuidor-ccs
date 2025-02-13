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
        Schema::create('firmas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tipo_solicitud');
            $table->integer('id_tipo_documento');
            $table->text('numero_documento');
            $table->text('codigo_dactilar')->nullable();
            $table->text('nombres');
            $table->text('apellido_paterno');
            $table->text('apellido_materno');
            $table->date('fecha_nacimiento');
            $table->integer('id_pais');
            $table->integer('id_sexo');
            $table->text('celular');
            $table->text('email');
            $table->integer('con_ruc');
            $table->text('ruc')->nullable();
            $table->integer('id_provincia');
            $table->integer('id_canton');
            $table->text('direccion');
            $table->integer('id_tipo_vigencia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firmas');
    }
};
