<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'cpf',
        'email',
        'contato',
        'rua',
        'numero',
        'cidade',
        'bairro',
        'estado',
        'cep',
        'data_nascimento',
        'complemento'
    ];

    protected $casts = [
        'data_nascimento' => 'date'
    ];
}
