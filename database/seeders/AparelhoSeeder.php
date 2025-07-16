<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aparelho;
use App\Models\Cliente;

class AparelhoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = Cliente::all();
        
        if ($clientes->isEmpty()) {
            $this->command->warn('Nenhum cliente encontrado. Execute primeiro o ClienteSeeder.');
            return;
        }

        $aparelhos = [
            [
                'cliente_id' => $clientes->first()->id,
                'marca' => 'Samsung',
                'modelo' => 'Galaxy S21',
                'nserie' => 'SM-G991B123456',
                'tipo' => 'Smartphone',
                'senha' => '1234',
                'detalhes' => 'Tela trincada, bateria viciada'
            ],
            [
                'cliente_id' => $clientes->first()->id,
                'marca' => 'Apple',
                'modelo' => 'MacBook Pro M1',
                'nserie' => 'MBP2021001',
                'tipo' => 'Notebook',
                'senha' => 'admin123',
                'detalhes' => 'Não liga, possível problema na fonte'
            ],
            [
                'cliente_id' => $clientes->skip(1)->first()->id,
                'marca' => 'Apple',
                'modelo' => 'iPhone 12 Pro',
                'nserie' => 'IP12P789012',
                'tipo' => 'Smartphone',
                'senha' => '0000',
                'detalhes' => 'Câmera não funciona'
            ],
            [
                'cliente_id' => $clientes->skip(1)->first()->id,
                'marca' => 'Dell',
                'modelo' => 'Inspiron 15',
                'nserie' => 'DI15345678',
                'tipo' => 'Notebook',
                'senha' => 'dell2023',
                'detalhes' => 'Teclado com teclas soltas'
            ],
            [
                'cliente_id' => $clientes->skip(2)->first()->id,
                'marca' => 'Xiaomi',
                'modelo' => 'Redmi Note 10',
                'nserie' => 'RN10901234',
                'tipo' => 'Smartphone',
                'senha' => '9999',
                'detalhes' => 'Touch screen não responde'
            ],
            [
                'cliente_id' => $clientes->skip(3)->first()->id,
                'marca' => 'HP',
                'modelo' => 'Pavilion Gaming',
                'nserie' => 'HP567890',
                'tipo' => 'Desktop',
                'senha' => 'hp123',
                'detalhes' => 'Não reconhece HD'
            ],
            [
                'cliente_id' => $clientes->skip(4)->first()->id,
                'marca' => 'Motorola',
                'modelo' => 'Moto G9 Plus',
                'nserie' => 'MG9012345',
                'tipo' => 'Smartphone',
                'senha' => '1111',
                'detalhes' => 'Bateria não carrega'
            ],
            [
                'cliente_id' => $clientes->skip(4)->first()->id,
                'marca' => 'Lenovo',
                'modelo' => 'ThinkPad X1 Carbon',
                'nserie' => 'TP678901',
                'tipo' => 'Notebook',
                'senha' => 'think123',
                'detalhes' => 'Ventilador fazendo ruído'
            ]
        ];

        foreach ($aparelhos as $aparelho) {
            Aparelho::create($aparelho);
        }

        $this->command->info('Aparelhos criados com sucesso!');
    }
}