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

    /**
     * Relacionamento com Aparelhos
     */
    public function aparelhos()
    {
        return $this->hasMany(Aparelho::class);
    }

    /**
     * Relacionamento com Manutenções através dos Aparelhos
     */
    public function manutencoes()
    {
        return $this->hasManyThrough(Manutencao::class, Aparelho::class);
    }

    /**
     * Aparelhos em manutenção
     */
    public function aparelhosEmManutencao()
    {
        return $this->aparelhos()->whereHas('manutencoes', function($query) {
            $query->whereIn('status', ['aguardando', 'em_andamento', 'aguardando_pecas', 'pronto']);
        });
    }

    /**
     * Conta total de aparelhos do cliente
     */
    public function totalAparelhos()
    {
        return $this->aparelhos()->count();
    }

    /**
     * Conta aparelhos em manutenção
     */
    public function totalAparelhosEmManutencao()
    {
        return $this->aparelhosEmManutencao()->count();
    }
}
