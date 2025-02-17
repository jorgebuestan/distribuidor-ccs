<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Firma extends Model
{
    use HasFactory;
    protected $table = 'firmas'; 
    protected $fillable = [
        'id_tipo_solicitud', 
        'id_tipo_documento', 
        'numero_documento', 
        'codigo_dactilar', 
        'nombres', 
        'apellido_paterno', 
        'apellido_materno', 
        'fecha_nacimiento', 
        'id_pais', 
        'id_sexo', 
        'celular', 
        'email', 
        'con_ruc', 
        'ruc', 
        'ruc_empresa', 
        'razon_social_empresa', 
        'cargo_representante', 
        'area_empresa', 
        'motivo_empresa', 
        'cargo_solicitante', 
        'id_tipo_documento_representante', 
        'numero_documento_representante', 
        'nombres_representante', 
        'apellido_paterno_representante', 
        'apellido_materno_representante', 
        'id_provincia', 
        'id_canton', 
        'direccion', 
        'id_tipo_vigencia'
    ]; 
}
