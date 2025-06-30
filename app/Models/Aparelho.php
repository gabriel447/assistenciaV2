<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparelho extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'marca',
        'modelo',
        'nserie',
        'tipo',
        'senha',
        'detalhes'
    ];

    /**
     * Relacionamento com Cliente
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relacionamento com Manutenções
     */
    public function manutencoes()
    {
        return $this->hasMany(Manutencao::class);
    }

    /**
     * Verifica se o aparelho está em manutenção
     */
    public function emManutencao()
    {
        return $this->manutencoes()->whereIn('status', ['aguardando', 'em_andamento', 'aguardando_pecas', 'pronto'])->exists();
    }
}
