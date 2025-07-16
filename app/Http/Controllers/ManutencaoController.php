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
                    'manutencoes.ordem_servico',
                    'manutencoes.defeito_relatado',
                    'manutencoes.data_entrada',
                    'manutencoes.data_saida',
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
                    
                    $statusTexts = [
                        'aguardando' => 'Aguardando Cliente',
                        'aguardando_pecas' => 'Aguardando Peças',
                        'em_andamento' => 'Em Andamento',
                        'pronto' => 'Pronto',
                        'entregue' => 'Entregue',
                        'cancelado' => 'Cancelado'
                    ];
                    
                    $color = $statusColors[$manutencao->status] ?? 'secondary';
                    $statusText = $statusTexts[$manutencao->status] ?? ucfirst(str_replace('_', ' ', $manutencao->status));
                    
                    return "<span class='badge bg-{$color}'>{$statusText}</span>";
                })
                ->addColumn('valor_formatado', function ($manutencao) {
                    return 'R$ ' . number_format($manutencao->valor_total, 2, ',', '.');
                })
                ->addColumn('data_entrada_formatada', function ($manutencao) {
                    return $manutencao->data_entrada->format('d/m/Y');
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'aparelho.tipo' => 'required|string|max:50',
            'aparelho.marca' => 'required|string|max:100',
            'aparelho.modelo' => 'required|string|max:100',
            'aparelho.nserie' => 'nullable|string|max:100',
            'aparelho.senha' => 'nullable|string|max:50',
            'aparelho.detalhes' => 'nullable|string|max:500',
            'manutencao.defeito_relatado' => 'required|string',
            'manutencao.data_entrada' => 'required|date',
            'manutencao.status' => 'required|in:aguardando,em_andamento,aguardando_pecas,pronto,entregue',
            'manutencao.valor_maodeobra' => 'nullable|numeric|min:0',
            'manutencao.valor_pecas' => 'nullable|numeric|min:0',
            'manutencao.descricao' => 'nullable|string',
            'manutencao.ordem_servico' => 'nullable|string|max:50'
        ]);

        try {
            // Criar o aparelho
            $aparelho = Aparelho::create([
                'cliente_id' => $request->cliente_id,
                'tipo' => $request->aparelho['tipo'],
                'marca' => $request->aparelho['marca'],
                'modelo' => $request->aparelho['modelo'],
                'nserie' => $request->aparelho['nserie'],
                'senha' => $request->aparelho['senha'],
                'detalhes' => $request->aparelho['detalhes']
            ]);

            // Gerar ordem de serviço se não fornecida
            $ordemServico = $request->manutencao['ordem_servico'] ?? 'OS' . date('Ymd') . str_pad($aparelho->id, 4, '0', STR_PAD_LEFT);

            // Calcular valor total
            $valorMaoDeObra = (float) ($request->manutencao['valor_maodeobra'] ?? 0);
            $valorPecas = (float) ($request->manutencao['valor_pecas'] ?? 0);
            $valorTotal = $valorMaoDeObra + $valorPecas;

            // Criar a manutenção
            $manutencao = Manutencao::create([
                'aparelho_id' => $aparelho->id,
                'ordem_servico' => $ordemServico,
                'defeito_relatado' => $request->manutencao['defeito_relatado'],
                'data_entrada' => $request->manutencao['data_entrada'],
                'status' => $request->manutencao['status'],
                'valor_maodeobra' => $valorMaoDeObra,
                'valor_pecas' => $valorPecas,
                'valor_total' => $valorTotal,
                'descricao' => $request->manutencao['descricao']
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Manutenção cadastrada com sucesso!',
                'manutencao' => $manutencao,
                'aparelho' => $aparelho
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao cadastrar manutenção: ' . $e->getMessage()
            ], 500);
        }
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
        $dataSaida = $manutencao->data_saida ? $manutencao->data_saida->format('d/m/Y') : 'Não definida';
        
        // Mapeamento de status
        $statusTexts = [
            'aguardando' => 'Aguardando Cliente',
            'aguardando_pecas' => 'Aguardando Peças',
            'em_andamento' => 'Em Andamento',
            'pronto' => 'Pronto',
            'entregue' => 'Entregue',
            'cancelado' => 'Cancelado'
        ];
        
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
            'defeito' => $manutencao->defeito_relatado,
            'descricao' => $manutencao->descricao ?? 'Não informada',
            'data_entrada' => $manutencao->data_entrada->format('d/m/Y'),
            'data_saida' => $dataSaida,
            'status' => $statusTexts[$manutencao->status] ?? ucfirst(str_replace('_', ' ', $manutencao->status)),
            'valor_maodeobra' => 'R$ ' . number_format($manutencao->valor_maodeobra, 2, ',', '.'),
            'valor_pecas' => 'R$ ' . number_format($manutencao->valor_pecas, 2, ',', '.'),
            'valor_total' => 'R$ ' . number_format($manutencao->valor_total, 2, ',', '.')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $manutencao = Manutencao::with(['aparelho.cliente'])
            ->findOrFail($id);

        $aparelho = $manutencao->aparelho;
        $cliente = $aparelho->cliente;

        return response()->json([
            'success' => true,
            'manutencao' => [
                'id' => $manutencao->id,
                'cliente_id' => $cliente->id,
                'aparelho_tipo' => $aparelho->tipo,
                'aparelho_marca' => $aparelho->marca,
                'aparelho_modelo' => $aparelho->modelo,
                'aparelho_nserie' => $aparelho->nserie,
                'aparelho_senha' => $aparelho->senha,
                'aparelho_detalhes' => $aparelho->detalhes,
                'data_saida' => $manutencao->data_saida ? $manutencao->data_saida->format('Y-m-d') : null,
                'status' => $manutencao->status,
                'defeito_relatado' => $manutencao->defeito_relatado,
                'valor_maodeobra' => $manutencao->valor_maodeobra,
                'valor_pecas' => $manutencao->valor_pecas,
                'descricao' => $manutencao->descricao
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'aparelho_tipo' => 'required|string|max:50',
            'aparelho_marca' => 'required|string|max:100',
            'aparelho_modelo' => 'required|string|max:100',
            'aparelho_nserie' => 'nullable|string|max:100',
            'aparelho_senha' => 'nullable|string|max:50',
            'aparelho_detalhes' => 'nullable|string|max:500',
            'defeito_relatado' => 'required|string',
            'data_saida' => 'nullable|date',
            'status' => 'required|in:aguardando,em_andamento,aguardando_pecas,pronto,entregue',
            'valor_maodeobra' => 'nullable|numeric|min:0',
            'valor_pecas' => 'nullable|numeric|min:0',
            'descricao' => 'nullable|string'
        ]);

        try {
            $manutencao = Manutencao::with('aparelho')->findOrFail($id);
            $aparelho = $manutencao->aparelho;

            // Atualizar o aparelho
            $aparelho->update([
                'cliente_id' => $request->cliente_id,
                'tipo' => $request->aparelho_tipo,
                'marca' => $request->aparelho_marca,
                'modelo' => $request->aparelho_modelo,
                'nserie' => $request->aparelho_nserie,
                'senha' => $request->aparelho_senha,
                'detalhes' => $request->aparelho_detalhes
            ]);

            // Calcular valor total
            $valorMaoDeObra = (float) ($request->valor_maodeobra ?? 0);
            $valorPecas = (float) ($request->valor_pecas ?? 0);
            $valorTotal = $valorMaoDeObra + $valorPecas;

            // Atualizar a manutenção
            $manutencao->update([
                'defeito_relatado' => $request->defeito_relatado,
                'data_saida' => $request->data_saida,
                'status' => $request->status,
                'valor_maodeobra' => $valorMaoDeObra,
                'valor_pecas' => $valorPecas,
                'valor_total' => $valorTotal,
                'descricao' => $request->descricao
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Manutenção atualizada com sucesso!',
                'manutencao' => $manutencao,
                'aparelho' => $aparelho
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar manutenção: ' . $e->getMessage()
            ], 500);
        }
    }
}
