<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoDocumento extends Model
{
    use HasFactory;
    protected $table = 'archivo_documento'; 
    protected $fillable = [
        'id_firma', 
        'id_tipo_archivo', 
        'ruta'
    ]; 
}
