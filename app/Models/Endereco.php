<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'logradouro',
        'cep',
        'numero',
        'bairro',
        'cidade',
        'estado'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}
