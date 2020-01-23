<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = [
        'email',
        'telefone',
        'celular'
    ];

    protected $hidden = [
        'updated_at',
        'created_at'
    ];
}
