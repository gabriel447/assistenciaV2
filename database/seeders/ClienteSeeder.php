<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dados baseados nos exemplos fornecidos
        $clientes = [
            [
                'nome' => 'João Silva',
                'cpf' => '123.456.789-00',
                'email' => 'joao.silva@example.com',
                'contato' => '(41) 99999-1111',
                'rua' => 'Rua das Amoras',
                'numero' => '1212',
                'cidade' => 'Curitiba',
                'bairro' => 'Centro',
                'estado' => 'PR',
                'cep' => '80000-000',
                'data_nascimento' => '1985-05-10',
                'complemento' => 'Apto 101'
            ],
            [
                'nome' => 'Maria Oliveira',
                'cpf' => '987.654.321-00',
                'email' => 'maria.oliveira@example.com',
                'contato' => '(41) 98888-2222',
                'rua' => 'Av. Brasil',
                'numero' => '456',
                'cidade' => 'Ponta Grossa',
                'bairro' => 'Oficinas',
                'estado' => 'PR',
                'cep' => '84000-000',
                'data_nascimento' => '1990-08-22',
                'complemento' => 'Casa'
            ],
            [
                'nome' => 'Carlos Souza',
                'cpf' => '321.654.987-00',
                'email' => 'carlos.souza@example.com',
                'contato' => '(41) 97777-3333',
                'rua' => 'Rua XV de Novembro',
                'numero' => '789',
                'cidade' => 'Londrina',
                'bairro' => 'Centro',
                'estado' => 'PR',
                'cep' => '86000-000',
                'data_nascimento' => '1978-12-15',
                'complemento' => 'Sala 5'
            ],
            [
                'nome' => 'Ana Santos',
                'cpf' => '456.789.123-00',
                'email' => 'ana.santos@example.com',
                'contato' => '(41) 96666-4444',
                'rua' => 'Rua das Flores',
                'numero' => '321',
                'cidade' => 'Maringá',
                'bairro' => 'Zona 7',
                'estado' => 'PR',
                'cep' => '87000-000',
                'data_nascimento' => '1992-03-18',
                'complemento' => null
            ],
            [
                'nome' => 'Pedro Lima',
                'cpf' => '789.123.456-00',
                'email' => 'pedro.lima@example.com',
                'contato' => '(41) 95555-5555',
                'rua' => 'Av. Paraná',
                'numero' => '654',
                'cidade' => 'Cascavel',
                'bairro' => 'Centro',
                'estado' => 'PR',
                'cep' => '85000-000',
                'data_nascimento' => '1987-11-25',
                'complemento' => 'Bloco B'
            ]
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}
