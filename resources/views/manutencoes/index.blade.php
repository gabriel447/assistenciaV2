<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestão de Manutenções') }}
            </h2>
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- DataTable Section -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-header bg-white border-bottom" style="padding: 1.5rem;">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="fas fa-tools me-2 text-primary"></i>Lista de Manutenções
                            </h5>
                            <div class="d-flex gap-2">
                                <button onclick="openCreateModal()" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>Nova Manutenção
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1.5rem;">
                        <div class="table-responsive">
                            <table id="manutencoesTable" class="table table-hover mb-0" style="font-size: 0.9rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-bold text-dark">Cliente</th>
                                        <th class="border-0 fw-bold text-dark">CPF</th>
                                        <th class="border-0 fw-bold text-dark">Aparelho</th>
                                        <th class="border-0 fw-bold text-dark">Defeito</th>
                                        <th class="border-0 fw-bold text-dark">Data Entrada</th>
                                        <th class="border-0 fw-bold text-dark">Status</th>
                                        <th class="border-0 fw-bold text-dark">Valor Total</th>
                                        <th class="border-0 fw-bold text-dark text-center">Ações</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            $('#manutencoesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('manutencoes.index') }}',
                    type: 'GET'
                },
                columns: [
                    { data: 'cliente_nome', name: 'cliente_nome' },
                    { data: 'cliente_cpf', name: 'cliente_cpf' },
                    { data: 'aparelho_info', name: 'aparelho_info' },
                    { data: 'defeito', name: 'defeito' },
                    { data: 'data_entrada', name: 'data_entrada' },
                    { data: 'status_badge', name: 'status_badge', orderable: false },
                    { data: 'valor_formatado', name: 'valor_formatado' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[4, 'desc']], // Ordenar por data de entrada (mais recentes primeiro)
                pageLength: 25,
                responsive: true,
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>rtip',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
                    emptyTable: '<div class="text-center py-4"><i class="fas fa-tools fa-3x text-muted mb-3"></i><h5 class="text-muted">Nenhuma manutenção encontrada</h5><p class="text-muted mb-0">Não há manutenções cadastradas no sistema ainda.</p></div>',
                    zeroRecords: '<div class="text-center py-4"><i class="fas fa-search fa-3x text-muted mb-3"></i><h5 class="text-muted">Nenhum resultado encontrado</h5><p class="text-muted mb-0">Tente ajustar os filtros de busca.</p></div>'
                }
            });
        });

        function openCreateModal() {
            // Implementar modal de criação
            alert('Funcionalidade de criação será implementada em breve!');
        }

        function viewManutencao(id) {
            // Implementar visualização
            alert('Visualizar manutenção ID: ' + id);
        }

        function editManutencao(id) {
            // Implementar edição
            alert('Editar manutenção ID: ' + id);
        }

        function deleteManutencao(id) {
            // Implementar exclusão
            if (confirm('Tem certeza que deseja excluir esta manutenção?')) {
                alert('Excluir manutenção ID: ' + id);
            }
        }
    </script>
</x-app-layout>