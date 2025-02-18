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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->text('razon_social');
            $table->boolean('obligado_contabilidad');
            $table->text('ruc');
            $table->integer('id_tipo_contribuyente');
            $table->text('direccion');
            $table->text('telefono');
            $table->text('correo_administrativo');
            $table->integer('contribuyente_especial');
            $table->text('correo_comprobante_electronico');
            $table->integer('id_ambiente');
            $table->text('firma');
            $table->text('clave_firma');
            $table->text('logo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
