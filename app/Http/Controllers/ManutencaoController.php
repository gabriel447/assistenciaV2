<?php

namespace App\Http\Controllers;

use App\Models\Manutencao;
use App\Models\Aparelho;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ManutencaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $manutencoes = Manutencao::with(['aparelho.cliente'])
                ->select([
                    'manutencoes.id',
                    'manutencoes.defeito',
                    'manutencoes.entrada',
                    'manutencoes.saida',
                    'manutencoes.status',
                    'manutencoes.valor_total',
                    'manutencoes.aparelho_id'
                ]);

            return DataTables::of($manutencoes)
                ->addColumn('cliente_nome', function ($manutencao) {
                    return $manutencao->aparelho->cliente->nome ?? 'N/A';
                })
                ->addColumn('cliente_cpf', function ($manutencao) {
                    return $manutencao->aparelho->cliente->cpf ?? 'N/A';
                })
                ->addColumn('cliente_telefone', function ($manutencao) {
                    return $manutencao->aparelho->cliente->contato ?? 'N/A';
                })
                ->addColumn('aparelho_info', function ($manutencao) {
                    $aparelho = $manutencao->aparelho;
                    return $aparelho ? "{$aparelho->marca} {$aparelho->modelo}" : 'N/A';
                })
                ->addColumn('status_badge', function ($manutencao) {
                    $statusColors = [
                        'aguardando' => 'warning',
                        'em_andamento' => 'info',
                        'aguardando_pecas' => 'secondary',
                        'pronto' => 'success',
                        'entregue' => 'primary',
                        'cancelado' => 'danger'
                    ];
                    
                    $color = $statusColors[$manutencao->status] ?? 'secondary';
                    $statusText = ucfirst(str_replace('_', ' ', $manutencao->status));
                    
                    return "<span class='badge bg-{$color}'>{$statusText}</span>";
                })
                ->addColumn('valor_formatado', function ($manutencao) {
                    return 'R$ ' . number_format($manutencao->valor_total, 2, ',', '.');
                })
                ->addColumn('data_entrada', function ($manutencao) {
                    return $manutencao->entrada->format('d/m/Y');
                })
                ->addColumn('actions', function ($manutencao) {
                    $btn = '<div class="btn-group" role="group">';
                    $btn .= '<button type="button" onclick="showManutencao('.$manutencao->id.')" class="btn btn-secondary btn-sm" title="Ver detalhes">';
                    $btn .= '<i class="fas fa-eye text-white"></i></button> ';
                    $btn .= '<button type="button" onclick="editManutencao('.$manutencao->id.')" class="btn btn-warning btn-sm" title="Editar">';
                    $btn .= '<i class="fas fa-edit"></i></button> ';
                    $btn .= '<button type="button" onclick="deleteManutencao('.$manutencao->id.')" class="btn btn-danger btn-sm" title="Excluir">';
                    $btn .= '<i class="fas fa-trash"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['status_badge', 'actions'])
                ->make(true);
        }

        return view('manutencoes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $manutencao = Manutencao::with(['aparelho.cliente'])
            ->findOrFail($id);

        $aparelho = $manutencao->aparelho;
        $cliente = $aparelho->cliente;

        // Calcular data de saída ou previsão
        $dataSaida = $manutencao->saida ? $manutencao->saida->format('d/m/Y') : 'Não definida';
        
        return response()->json([
            'id' => $manutencao->id,
            'cliente' => [
                'nome' => $cliente->nome,
                'cpf' => $cliente->cpf,
                'email' => $cliente->email,
                'contato' => $cliente->contato
            ],
            'aparelho' => [
                'marca' => $aparelho->marca,
                'modelo' => $aparelho->modelo,
                'nserie' => $aparelho->nserie,
                'tipo' => $aparelho->tipo,
                'senha' => $aparelho->senha ?? 'Não informada'
            ],
            'defeito' => $manutencao->defeito,
            'descricao' => $manutencao->descricao ?? 'Não informada',
            'data_entrada' => $manutencao->entrada->format('d/m/Y'),
            'data_saida' => $dataSaida,
            'status' => ucfirst(str_replace('_', ' ', $manutencao->status)),
            'valor_maodeobra' => 'R$ ' . number_format($manutencao->valor_maodeobra, 2, ',', '.'),
            'valor_pecas' => 'R$ ' . number_format($manutencao->valor_pecas, 2, ',', '.'),
            'valor_total' => 'R$ ' . number_format($manutencao->valor_total, 2, ',', '.')
        ]);
    }
}
