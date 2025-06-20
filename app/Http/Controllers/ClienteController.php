<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clientes = Cliente::select(['id', 'nome', 'cpf', 'email', 'contato', 'cidade']);
            
            return DataTables::of($clientes)
                ->addColumn('acoes', function ($cliente) {
                    $btn = '<div class="btn-group" role="group">';
                    $btn .= '<button type="button" onclick="showCliente('.$cliente->id.')" class="btn btn-secondary btn-sm" title="Ver detalhes">';
                     $btn .= '<i class="fas fa-eye text-white"></i></button> ';
                     $btn .= '<button type="button" onclick="editCliente('.$cliente->id.')" class="btn btn-warning btn-sm" title="Editar">';
                     $btn .= '<i class="fas fa-edit"></i></button> ';
                     $btn .= '<button type="button" onclick="deleteCliente('.$cliente->id.')" class="btn btn-danger btn-sm" title="Excluir">';
                     $btn .= '<i class="fas fa-trash"></i></button>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['acoes'])
                ->make(true);
        }

        return view('clientes.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes',
            'email' => 'required|email|unique:clientes',
            'contato' => 'required|string|max:20',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:9',
            'data_nascimento' => 'required|date',
            'complemento' => 'nullable|string|max:255'
        ]);

        $cliente = Cliente::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cliente cadastrado com sucesso!',
            'cliente' => $cliente
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente): JsonResponse
    {
        return response()->json([
            'success' => true,
            'cliente' => $cliente
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente): JsonResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf,' . $cliente->id,
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'contato' => 'required|string|max:20',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'estado' => 'required|string|max:2',
            'cep' => 'required|string|max:9',
            'data_nascimento' => 'required|date',
            'complemento' => 'nullable|string|max:255'
        ]);

        $cliente->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Cliente atualizado com sucesso!',
            'cliente' => $cliente
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente): JsonResponse
    {
        $cliente->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cliente deletado com sucesso!'
        ]);
    }
}