<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Manutencao;
use App\Models\Aparelho;
use Carbon\Carbon;

class ManutencaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aparelhos = Aparelho::all();
        
        if ($aparelhos->isEmpty()) {
            $this->command->warn('Nenhum aparelho encontrado. Execute primeiro o AparelhoSeeder.');
            return;
        }

        $status_opcoes = ['aguardando', 'em_andamento', 'aguardando_pecas', 'pronto', 'entregue', 'cancelado'];
        
        $manutencoes = [
            [
                'ordem_servico' => 'OS-001',
                'aparelho_id' => $aparelhos->get(0)->id,
                'defeito_relatado' => 'Tela trincada',
                'data_entrada' => Carbon::now()->subDays(15),
                'data_saida' => Carbon::now()->subDays(10),
                'status' => 'entregue',
                'descricao' => 'Substituição da tela e película protetora',
                'valor_total' => 250.00,
                'valor_pecas' => 180.00,
                'valor_maodeobra' => 70.00
            ],
            [
                'ordem_servico' => 'OS-002',
                'aparelho_id' => $aparelhos->get(1)->id,
                'defeito_relatado' => 'Não liga',
                'data_entrada' => Carbon::now()->subDays(8),
                'data_saida' => null,
                'status' => 'em_andamento',
                'descricao' => 'Diagnóstico: problema na fonte de alimentação',
                'valor_total' => 450.00,
                'valor_pecas' => 320.00,
                'valor_maodeobra' => 130.00
            ],
            [
                'ordem_servico' => 'OS-003',
                'aparelho_id' => $aparelhos->get(2)->id,
                'defeito_relatado' => 'Câmera não funciona',
                'data_entrada' => Carbon::now()->subDays(5),
                'data_saida' => null,
                'status' => 'aguardando_pecas',
                'descricao' => 'Aguardando chegada do módulo da câmera',
                'valor_total' => 180.00,
                'valor_pecas' => 120.00,
                'valor_maodeobra' => 60.00
            ],
            [
                'ordem_servico' => 'OS-004',
                'aparelho_id' => $aparelhos->get(3)->id,
                'defeito_relatado' => 'Teclas soltas',
                'data_entrada' => Carbon::now()->subDays(3),
                'data_saida' => Carbon::now()->subDay(),
                'status' => 'pronto',
                'descricao' => 'Substituição do teclado completo',
                'valor_total' => 150.00,
                'valor_pecas' => 90.00,
                'valor_maodeobra' => 60.00
            ],
            [
                'ordem_servico' => 'OS-005',
                'aparelho_id' => $aparelhos->get(4)->id,
                'defeito_relatado' => 'Touch screen não responde',
                'data_entrada' => Carbon::now()->subDays(12),
                'data_saida' => Carbon::now()->subDays(7),
                'status' => 'entregue',
                'descricao' => 'Calibração do touch e limpeza interna',
                'valor_total' => 80.00,
                'valor_pecas' => 0.00,
                'valor_maodeobra' => 80.00
            ],
            [
                'ordem_servico' => 'OS-006',
                'aparelho_id' => $aparelhos->get(5)->id,
                'defeito_relatado' => 'Não reconhece HD',
                'data_entrada' => Carbon::now()->subDays(6),
                'data_saida' => null,
                'status' => 'aguardando',
                'descricao' => 'Aguardando aprovação do orçamento',
                'valor_total' => 300.00,
                'valor_pecas' => 220.00,
                'valor_maodeobra' => 80.00
            ],
            [
                'ordem_servico' => 'OS-007',
                'aparelho_id' => $aparelhos->get(6)->id,
                'defeito_relatado' => 'Bateria não carrega',
                'data_entrada' => Carbon::now()->subDays(2),
                'data_saida' => null,
                'status' => 'em_andamento',
                'descricao' => 'Teste da bateria e conector de carga',
                'valor_total' => 120.00,
                'valor_pecas' => 80.00,
                'valor_maodeobra' => 40.00
            ],
            [
                'ordem_servico' => 'OS-008',
                'aparelho_id' => $aparelhos->get(7)->id,
                'defeito_relatado' => 'Ventilador fazendo ruído',
                'data_entrada' => Carbon::now()->subDays(20),
                'data_saida' => Carbon::now()->subDays(18),
                'status' => 'cancelado',
                'descricao' => 'Cliente desistiu do reparo',
                'valor_total' => 0.00,
                'valor_pecas' => 0.00,
                'valor_maodeobra' => 0.00
            ],
            [
                'ordem_servico' => 'OS-009',
                'aparelho_id' => $aparelhos->get(0)->id,
                'defeito_relatado' => 'Bateria viciada',
                'data_entrada' => Carbon::now()->subDay(),
                'data_saida' => null,
                'status' => 'aguardando',
                'descricao' => 'Segundo reparo - troca da bateria',
                'valor_total' => 90.00,
                'valor_pecas' => 60.00,
                'valor_maodeobra' => 30.00
            ],
            [
                'ordem_servico' => 'OS-010',
                'aparelho_id' => $aparelhos->get(2)->id,
                'defeito_relatado' => 'Atualização de software',
                'data_entrada' => Carbon::now()->subDays(25),
                'data_saida' => Carbon::now()->subDays(24),
                'status' => 'entregue',
                'descricao' => 'Atualização do iOS e backup dos dados',
                'valor_total' => 50.00,
                'valor_pecas' => 0.00,
                'valor_maodeobra' => 50.00
            ]
        ];

        foreach ($manutencoes as $manutencao) {
            Manutencao::create($manutencao);
        }

        $this->command->info('Manutenções criadas com sucesso!');
    }
}