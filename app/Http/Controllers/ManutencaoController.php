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
                    return '
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="viewManutencao(' . $manutencao->id . ')" title="Visualizar">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-warning" onclick="editManutencao(' . $manutencao->id . ')" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteManutencao(' . $manutencao->id . ')" title="Excluir">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    ';
                })
                ->rawColumns(['status_badge', 'actions'])
                ->make(true);
        }

        return view('manutencoes.index');
    }
}
