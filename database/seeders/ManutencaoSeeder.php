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
                'aparelho_id' => $aparelhos->get(0)->id,
                'defeito' => 'Tela trincada',
                'entrada' => Carbon::now()->subDays(15),
                'saida' => Carbon::now()->subDays(10),
                'status' => 'entregue',
                'descricao' => 'Substituição da tela e película protetora',
                'valor_total' => 250.00,
                'valor_pecas' => 180.00,
                'valor_maodeobra' => 70.00
            ],
            [
                'aparelho_id' => $aparelhos->get(1)->id,
                'defeito' => 'Não liga',
                'entrada' => Carbon::now()->subDays(8),
                'saida' => null,
                'status' => 'em_andamento',
                'descricao' => 'Diagnóstico: problema na fonte de alimentação',
                'valor_total' => 450.00,
                'valor_pecas' => 320.00,
                'valor_maodeobra' => 130.00
            ],
            [
                'aparelho_id' => $aparelhos->get(2)->id,
                'defeito' => 'Câmera não funciona',
                'entrada' => Carbon::now()->subDays(5),
                'saida' => null,
                'status' => 'aguardando_pecas',
                'descricao' => 'Aguardando chegada do módulo da câmera',
                'valor_total' => 180.00,
                'valor_pecas' => 120.00,
                'valor_maodeobra' => 60.00
            ],
            [
                'aparelho_id' => $aparelhos->get(3)->id,
                'defeito' => 'Teclas soltas',
                'entrada' => Carbon::now()->subDays(3),
                'saida' => Carbon::now()->subDay(),
                'status' => 'pronto',
                'descricao' => 'Substituição do teclado completo',
                'valor_total' => 150.00,
                'valor_pecas' => 90.00,
                'valor_maodeobra' => 60.00
            ],
            [
                'aparelho_id' => $aparelhos->get(4)->id,
                'defeito' => 'Touch screen não responde',
                'entrada' => Carbon::now()->subDays(12),
                'saida' => Carbon::now()->subDays(7),
                'status' => 'entregue',
                'descricao' => 'Calibração do touch e limpeza interna',
                'valor_total' => 80.00,
                'valor_pecas' => 0.00,
                'valor_maodeobra' => 80.00
            ],
            [
                'aparelho_id' => $aparelhos->get(5)->id,
                'defeito' => 'Não reconhece HD',
                'entrada' => Carbon::now()->subDays(6),
                'saida' => null,
                'status' => 'aguardando',
                'descricao' => 'Aguardando aprovação do orçamento',
                'valor_total' => 300.00,
                'valor_pecas' => 220.00,
                'valor_maodeobra' => 80.00
            ],
            [
                'aparelho_id' => $aparelhos->get(6)->id,
                'defeito' => 'Bateria não carrega',
                'entrada' => Carbon::now()->subDays(2),
                'saida' => null,
                'status' => 'em_andamento',
                'descricao' => 'Teste da bateria e conector de carga',
                'valor_total' => 120.00,
                'valor_pecas' => 80.00,
                'valor_maodeobra' => 40.00
            ],
            [
                'aparelho_id' => $aparelhos->get(7)->id,
                'defeito' => 'Ventilador fazendo ruído',
                'entrada' => Carbon::now()->subDays(20),
                'saida' => Carbon::now()->subDays(18),
                'status' => 'cancelado',
                'descricao' => 'Cliente desistiu do reparo',
                'valor_total' => 0.00,
                'valor_pecas' => 0.00,
                'valor_maodeobra' => 0.00
            ],
            [
                'aparelho_id' => $aparelhos->get(0)->id,
                'defeito' => 'Bateria viciada',
                'entrada' => Carbon::now()->subDay(),
                'saida' => null,
                'status' => 'aguardando',
                'descricao' => 'Segundo reparo - troca da bateria',
                'valor_total' => 90.00,
                'valor_pecas' => 60.00,
                'valor_maodeobra' => 30.00
            ],
            [
                'aparelho_id' => $aparelhos->get(2)->id,
                'defeito' => 'Atualização de software',
                'entrada' => Carbon::now()->subDays(25),
                'saida' => Carbon::now()->subDays(24),
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