<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    protected $fillable = [
        'descricao',
        'status',
        'anunciante_id',
        'endereco_id',
        'contato_id'
    ];

    protected $hidden = [
        'anunciante_id',
        'endereco_id',
        'contato_id'
    ];

    public function anunciante()
    {
        return $this->belongsTo(User::class, 'anunciante_id')->with('role');
    }

    public function contatos()
    {
        return $this->belongsTo(Contato::class, 'contato_id');
    }

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }
}
