<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    use HasFactory;

    protected $table = 'manutencoes';

    protected $fillable = [
        'aparelho_id',
        'defeito',
        'entrada',
        'saida',
        'status',
        'descricao',
        'valor_total',
        'valor_pecas',
        'valor_maodeobra'
    ];

    protected $casts = [
        'entrada' => 'date',
        'saida' => 'date',
        'valor_total' => 'decimal:2',
        'valor_pecas' => 'decimal:2',
        'valor_maodeobra' => 'decimal:2'
    ];

    /**
     * Relacionamento com Aparelho
     */
    public function aparelho()
    {
        return $this->belongsTo(Aparelho::class);
    }

    /**
     * Relacionamento com Cliente através do Aparelho
     */
    public function cliente()
    {
        return $this->hasOneThrough(Cliente::class, Aparelho::class, 'id', 'id', 'aparelho_id', 'cliente_id');
    }

    /**
     * Scope para manutenções em andamento
     */
    public function scopeEmAndamento($query)
    {
        return $query->whereIn('status', ['aguardando', 'em_andamento', 'aguardando_pecas', 'pronto']);
    }

    /**
     * Scope para manutenções finalizadas
     */
    public function scopeFinalizadas($query)
    {
        return $query->whereIn('status', ['entregue', 'cancelado']);
    }
}
