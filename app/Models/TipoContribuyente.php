<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContribuyente extends Model
{
    use HasFactory;

    protected $table = 'tipo_contribuyente';
    protected $fillable = ['descripcion'];
}
