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
                                        <th class="border-0 fw-bold text-dark">Nome</th>
                                        <th class="border-0 fw-bold text-dark">CPF</th>
                                        <th class="border-0 fw-bold text-dark">Contato</th>
                                        <th class="border-0 fw-bold text-dark">Aparelho</th>
                                        <th class="border-0 fw-bold text-dark">Defeito</th>
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

    <!-- Modal de Detalhes -->
    <div class="modal fade" id="detalhesModal" tabindex="-1" aria-labelledby="detalhesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="detalhesModalLabel">
                        <i class="fas fa-tools me-2"></i>Detalhes da Manutenção
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Informações do Cliente -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-bold"><i class="fas fa-user me-2 text-primary"></i>Cliente</h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-1"><strong>Nome:</strong> <span id="cliente-nome"></span></p>
                                    <p class="mb-1"><strong>CPF:</strong> <span id="cliente-cpf"></span></p>
                                    <p class="mb-1"><strong>Email:</strong> <span id="cliente-email"></span></p>
                                    <p class="mb-0"><strong>Telefone:</strong> <span id="cliente-contato"></span></p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informações do Aparelho -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-bold"><i class="fas fa-mobile-alt me-2 text-primary"></i>Aparelho</h6>
                                </div>
                                <div class="card-body">
                                    <p class="mb-1"><strong>Tipo:</strong> <span id="aparelho-tipo"></span></p>
                                    <p class="mb-1"><strong>Marca/Modelo:</strong> <span id="aparelho-marca-modelo"></span></p>
                                    <p class="mb-1"><strong>Nº Série:</strong> <span id="aparelho-nserie"></span></p>
                                    <p class="mb-0"><strong>Senha:</strong> <span id="aparelho-senha"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Informações da Manutenção -->
                    <div class="card border-0 shadow-sm mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 fw-bold"><i class="fas fa-wrench me-2 text-primary"></i>Manutenção</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Defeito:</strong> <span id="manutencao-defeito"></span></p>
                                    <p class="mb-2"><strong>Serviço:</strong> <span id="manutencao-descricao"></span></p>
                                    <p class="mb-0"><strong>Status:</strong> <span id="manutencao-status"></span></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2"><strong>Data Entrada:</strong> <span id="manutencao-entrada"></span></p>
                                    <p class="mb-0"><strong>Data Saída:</strong> <span id="manutencao-saida"></span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Valores -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-light">
                            <h6 class="mb-0 fw-bold"><i class="fas fa-dollar-sign me-2 text-primary"></i>Valores</h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="border-end">
                                        <h6 class="text-muted mb-1">Mão de Obra</h6>
                                        <h5 id="valor-maodeobra" class="text-info fw-bold mb-0"></h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border-end">
                                        <h6 class="text-muted mb-1">Peças</h6>
                                        <h5 id="valor-pecas" class="text-danger fw-bold mb-0"></h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div>
                                        <h6 class="text-muted mb-1">Total</h6>
                                        <h4 id="valor-total" class="text-success fw-bold mb-0"></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#manutencoesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("manutencoes.index") }}',
                columns: [
                    { data: 'cliente_nome', name: 'cliente_nome' },
                    { data: 'cliente_cpf', name: 'cliente_cpf' },
                    { data: 'cliente_telefone', name: 'cliente_telefone' },
                    { data: 'aparelho_info', name: 'aparelho_info' },
                    { data: 'defeito', name: 'defeito' },
                    { data: 'status_badge', name: 'status_badge', orderable: false },
                    { data: 'valor_formatado', name: 'valor_formatado' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ],
                order: [[4, 'asc']], // Ordenar por defeito
                pageLength: 25,
                responsive: true,
                dom: '<"row"<"col-sm-12 col-md-6 text-left"f><"col-sm-12 col-md-6 text-right"l>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json',
                    emptyTable: '<div class="text-center py-4"><i class="fas fa-tools fa-3x text-muted mb-3"></i><h5 class="text-muted">Nenhuma manutencao encontrada</h5></div>',
                    zeroRecords: '<div class="text-center py-4"><i class="fas fa-search fa-3x text-muted mb-3"></i><h5 class="text-muted">Nenhum resultado encontrado</h5></div>'
                }
            });
        });

        function openCreateModal() {
            // Implementar modal de criacao
            alert('Funcionalidade de criacao sera implementada em breve!');
        }

        function showManutencao(id) {
            // Fazer requisição AJAX para buscar detalhes da manutenção
            $.ajax({
                url: '/manutencoes/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Preencher dados do cliente
                    $('#cliente-nome').text(data.cliente.nome);
                    $('#cliente-cpf').text(data.cliente.cpf);
                    $('#cliente-email').text(data.cliente.email);
                    $('#cliente-contato').text(data.cliente.contato);
                    
                    // Preencher dados do aparelho
                    $('#aparelho-marca-modelo').text(data.aparelho.marca + ' ' + data.aparelho.modelo);
                    $('#aparelho-tipo').text(data.aparelho.tipo);
                    $('#aparelho-nserie').text(data.aparelho.nserie);
                    $('#aparelho-senha').text(data.aparelho.senha);
                    
                    // Preencher dados da manutenção
                    $('#manutencao-defeito').text(data.defeito);
                    $('#manutencao-descricao').text(data.descricao);
                    $('#manutencao-status').text(data.status);
                    $('#manutencao-entrada').text(data.data_entrada);
                    $('#manutencao-saida').text(data.data_saida);
                    
                    // Preencher valores
                    $('#valor-maodeobra').text(data.valor_maodeobra);
                    $('#valor-pecas').text(data.valor_pecas);
                    $('#valor-total').text(data.valor_total);
                    
                    // Mostrar o modal
                    $('#detalhesModal').modal('show');
                },
                error: function(xhr, status, error) {
                    alert('Erro ao carregar detalhes da manutencao: ' + error);
                }
            });
        }

        function editManutencao(id) {
            // Implementar edicao
            alert('Editar manutencao ID: ' + id);
        }

        function deleteManutencao(id) {
            // Implementar exclusao
            if (confirm('Tem certeza que deseja excluir esta manutencao?')) {
                alert('Excluir manutencao ID: ' + id);
            }
        }
    </script>
    @endpush
</x-app-layout>