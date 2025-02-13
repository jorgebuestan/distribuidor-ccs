<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    use HasFactory;
    protected $table = 'cantones'; 
    protected $fillable = ['id_pais', 'id_provincia', 'nombre', 'estado'];
}
