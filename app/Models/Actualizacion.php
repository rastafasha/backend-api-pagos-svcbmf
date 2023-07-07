<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actualizacion extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'surname',
        'especialidad',
        'universidad',
        'ano',
        'org',
        'website',
        'email',
        'direccion',
        'direccion1',
        'estado',
        'ciudad',
        'telefonos',
        'tel1',
        'telhome',
        'telmovil',
        'telprincipal',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
    ];
}
