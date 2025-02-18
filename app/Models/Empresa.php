<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';
    protected $fillable = [
        'logo',
        'firma',
        'ruc',
        'razon_social',
        'obligado_contabilidad',
        'id_tipo_contribuyente',
        'direccion',
        'telefono',
        'correo_administrativo',
        'contribuyente_especial',
        'correo_comprobante_electronico',
        'id_ambiente',
        'clave_firma',
    ];
}

