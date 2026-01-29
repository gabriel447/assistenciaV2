<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gestão de Clientes') }}
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
                                <i class="fas fa-table me-2 text-primary"></i>Lista de Clientes
                            </h5>
                            <div class="d-flex gap-2">
                                <button onclick="openCreateModal()" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>Novo Cliente
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 1.5rem;">
                        <div class="table-responsive">
                            <table id="clientesTable" class="table table-hover mb-0" style="font-size: 0.9rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-bold text-dark">Nome</th>
                                        <th class="border-0 fw-bold text-dark">CPF</th>
                                        <th class="border-0 fw-bold text-dark">Email</th>
                                        <th class="border-0 fw-bold text-dark">Contato</th>
                                        <th class="border-0 fw-bold text-dark">Cidade</th>
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

    <!-- Modal Criar/Editar Cliente -->
    <div class="modal fade" id="clienteModal" tabindex="-1" aria-labelledby="clienteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="clienteModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Cadastrar Cliente
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="clienteForm">
                        <input type="hidden" id="clienteId">
                        
                        <!-- Dados Pessoais -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-user me-2"></i>Dados Pessoais
                                </h6>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="nome" class="form-label fw-semibold">Nome Completo *</label>
                                <input type="text" class="form-control form-control-lg" id="nome" required placeholder="Digite o nome completo">
                            </div>
                            <div class="col-md-4">
                                <label for="cpf" class="form-label fw-semibold">CPF *</label>
                                <input type="text" class="form-control form-control-lg" id="cpf" required placeholder="000.000.000-00">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold">Email *</label>
                                <input type="email" class="form-control form-control-lg" id="email" required placeholder="email@exemplo.com">
                            </div>
                            <div class="col-md-6">
                                <label for="contato" class="form-label fw-semibold">Telefone/WhatsApp *</label>
                                <input type="text" class="form-control form-control-lg" id="contato" required placeholder="(00) 00000-0000">
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="data_nascimento" class="form-label fw-semibold">Data de Nascimento</label>
                                <input type="date" class="form-control form-control-lg" id="data_nascimento">
                            </div>
                        </div>
                        
                        <!-- Endereço -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <h6 class="text-primary fw-bold mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>Endereço
                                </h6>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="rua" class="form-label fw-semibold">Rua/Avenida</label>
                                <input type="text" class="form-control" id="rua" placeholder="Nome da rua">
                            </div>
                            <div class="col-md-4">
                                <label for="numero" class="form-label fw-semibold">Número</label>
                                <input type="text" class="form-control" id="numero" placeholder="123">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="cidade" class="form-label fw-semibold">Cidade</label>
                                <input type="text" class="form-control" id="cidade" placeholder="Cidade">
                            </div>
                            <div class="col-md-4">
                                <label for="bairro" class="form-label fw-semibold">Bairro</label>
                                <input type="text" class="form-control" id="bairro" placeholder="Bairro">
                            </div>
                            <div class="col-md-4">
                                <label for="estado" class="form-label fw-semibold">Estado</label>
                                <input type="text" class="form-control" id="estado" placeholder="UF">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cep" class="form-label fw-semibold">CEP</label>
                                <input type="text" class="form-control" id="cep" placeholder="00000-000">
                            </div>
                            <div class="col-md-6">
                                <label for="complemento" class="form-label fw-semibold">Complemento</label>
                                <input type="text" class="form-control" id="complemento" placeholder="Apto, casa, etc.">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" form="clienteForm" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Salvar Cliente
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detalhes Cliente -->
    <div class="modal fade" id="detalhesModal" tabindex="-1" aria-labelledby="detalhesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title fw-bold" id="detalhesModalLabel">
                        <i class="fas fa-user me-2"></i>Detalhes do Cliente
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="detalhesContent">
                        <!-- Conteúdo será preenchido via JavaScript -->
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Fechar
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
        // Configurar CSRF token para requisições AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Inicializar DataTable com Bootstrap 5
        var table = $('#clientesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('clientes.index') }}",
            columns: [
                {data: 'nome', name: 'nome'},
                {data: 'cpf', name: 'cpf'},
                {data: 'email', name: 'email'},
                {data: 'contato', name: 'contato'},
                {data: 'cidade', name: 'cidade'},
                {data: 'acoes', name: 'acoes', orderable: false, searchable: false, className: 'text-center'}
            ],
            language: {
                processing: "Processando...",
                search: "Pesquisar:",
                lengthMenu: "Exibir _MENU_ resultados por página",
                info: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                infoEmpty: "Mostrando 0 até 0 de 0 registros",
                infoFiltered: "(filtrado de _MAX_ registros no total)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum registro encontrado",
                emptyTable: "Nenhum registro encontrado",
                paginate: {
                    first: "Primeira",
                    previous: "Anterior",
                    next: "Próxima",
                    last: "Última"
                },
                aria: {
                    sortAscending: ": Ordenar colunas de forma ascendente",
                    sortDescending: ": Ordenar colunas de forma descendente"
                }
            },
            responsive: true,
            pageLength: 10,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            dom: '<"row"<"col-sm-12 col-md-6 text-left"f><"col-sm-12 col-md-6 text-right"l>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            drawCallback: function() {
                // Atualizar contador total de clientes
                var info = this.api().page.info();
                $('#totalClientes').text(info.recordsTotal);
            }
        });

        // Submissão do formulário
        $('#clienteForm').on('submit', function(e) {
            e.preventDefault();
            
            // Mostrar loading no botão
            var submitBtn = $(this).find('button[type="submit"]');
            var originalText = submitBtn.html();
            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Salvando...');
            submitBtn.prop('disabled', true);
            
            var formData = {
                nome: $('#nome').val(),
                cpf: $('#cpf').val(),
                email: $('#email').val(),
                contato: $('#contato').val(),
                rua: $('#rua').val(),
                numero: $('#numero').val(),
                cidade: $('#cidade').val(),
                bairro: $('#bairro').val(),
                estado: $('#estado').val(),
                cep: $('#cep').val(),
                data_nascimento: $('#data_nascimento').val(),
                complemento: $('#complemento').val()
            };
            
            var clienteId = $('#clienteId').val();
            var url = clienteId ? '/clientes/' + clienteId : "{{ route('clientes.store') }}";
            var method = clienteId ? 'PUT' : 'POST';
            
            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function(response) {
                    // Fechar modal
                    var modal = bootstrap.Modal.getInstance(document.getElementById('clienteModal'));
                    modal.hide();
                    
                    // Recarregar tabela
                    table.ajax.reload();
                    
                    // Mostrar toast de sucesso
                    showToast('success', 'Cliente salvo com sucesso!');
                },
                error: function(xhr) {
                    showToast('error', 'Erro ao salvar cliente!');
                },
                complete: function() {
                    // Restaurar botão
                    submitBtn.html(originalText);
                    submitBtn.prop('disabled', false);
                }
            });
        });

        // Limpar formulário quando modal for fechado
        $('#clienteModal').on('hidden.bs.modal', function() {
            $('#clienteForm')[0].reset();
            $('#clienteId').val('');
            // Restaurar cor original (primary) e título para cadastro
            $('#clienteModal .modal-header').removeClass('bg-warning').addClass('bg-primary');
            $('#clienteModalLabel').html('<i class="fas fa-user-plus me-2"></i>Cadastrar Cliente');
        });
    });

    // Funções globais
    function openCreateModal() {
        // Garantir que o modal está com a cor correta para criação (primary)
        $('#clienteModal .modal-header').removeClass('bg-warning').addClass('bg-primary');
        var modal = new bootstrap.Modal(document.getElementById('clienteModal'));
        modal.show();
    }

    function editCliente(id) {
        $.get('/clientes/' + id, function(response) {
            var data = response.cliente;
            
            // Mudar cor do header para warning (amarelo) e título para edição
            $('#clienteModal .modal-header').removeClass('bg-primary').addClass('bg-warning');
            $('#clienteModalLabel').html('<i class="fas fa-user-edit me-2"></i>Editar Cliente');
            $('#clienteId').val(data.id);
            $('#nome').val(data.nome);
            $('#cpf').val(data.cpf);
            $('#email').val(data.email);
            $('#contato').val(data.contato);
            $('#rua').val(data.rua);
            $('#numero').val(data.numero);
            $('#cidade').val(data.cidade);
            $('#bairro').val(data.bairro);
            $('#estado').val(data.estado);
            $('#cep').val(data.cep);
            $('#data_nascimento').val(data.data_nascimento);
            $('#complemento').val(data.complemento);
            
            var modal = new bootstrap.Modal(document.getElementById('clienteModal'));
            modal.show();
        }).fail(function() {
            showToast('error', 'Erro ao carregar dados do cliente!');
        });
    }

    function showCliente(id) {
        $.get('/clientes/' + id, function(response) {
            var data = response.cliente;
            
            // Formatar data de nascimento se existir
            var dataNascimento = 'N/A';
            if (data.data_nascimento) {
                var date = new Date(data.data_nascimento);
                dataNascimento = date.toLocaleDateString('pt-BR');
            }
            
            var content = `
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-0 bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-primary fw-bold mb-3">
                                    <i class="fas fa-user me-2"></i>Dados Pessoais
                                </h6>
                                <p class="mb-2"><strong>Nome:</strong> ${data.nome || 'N/A'}</p>
                                <p class="mb-2"><strong>CPF:</strong> ${data.cpf || 'N/A'}</p>
                                <p class="mb-2"><strong>Email:</strong> ${data.email || 'N/A'}</p>
                                <p class="mb-2"><strong>Contato:</strong> ${data.contato || 'N/A'}</p>
                                <p class="mb-0"><strong>Data de Nascimento:</strong> ${dataNascimento}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 bg-light mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-primary fw-bold mb-3">
                                    <i class="fas fa-map-marker-alt me-2"></i>Endereço
                                </h6>
                                <p class="mb-2"><strong>Endereço:</strong> ${data.rua || 'N/A'}, ${data.numero || 'S/N'}</p>
                                <p class="mb-2"><strong>Bairro:</strong> ${data.bairro || 'N/A'}</p>
                                <p class="mb-2"><strong>Cidade/Estado:</strong> ${data.cidade || 'N/A'} - ${data.estado || 'N/A'}</p>
                                <p class="mb-2"><strong>CEP:</strong> ${data.cep || 'N/A'}</p>
                                <p class="mb-0"><strong>Complemento:</strong> ${data.complemento || 'N/A'}</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            $('#detalhesContent').html(content);
            
            var modal = new bootstrap.Modal(document.getElementById('detalhesModal'));
            modal.show();
        }).fail(function() {
            showToast('error', 'Erro ao carregar detalhes do cliente!');
        });
    }

    function deleteCliente(id) {
        // Usar SweetAlert2 ou modal de confirmacao Bootstrap
        if (confirm('Tem certeza que deseja excluir este cliente?\n\nEsta acao nao pode ser desfeita.')) {
            $.ajax({
                url: '/clientes/' + id,
                method: 'DELETE',
                success: function(response) {
                    $('#clientesTable').DataTable().ajax.reload();
                    showToast('success', 'Cliente excluido com sucesso!');
                },
                error: function(xhr) {
                    showToast('error', 'Erro ao excluir cliente!');
                }
            });
        }
    }

    // Função para mostrar toasts
    function showToast(type, message) {
        var toastClass = type === 'success' ? 'bg-success' : 'bg-danger';
        var iconClass = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        
        var toastHtml = `
            <div class="toast align-items-center text-white ${toastClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas ${iconClass} me-2"></i>${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        
        // Criar container de toasts se não existir
        if (!$('#toast-container').length) {
            $('body').append('<div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3"></div>');
        }
        
        var $toast = $(toastHtml);
        $('#toast-container').append($toast);
        
        var toast = new bootstrap.Toast($toast[0]);
        toast.show();
        
        // Remover toast após ser escondido
        $toast.on('hidden.bs.toast', function() {
            $(this).remove();
        });
    }
    </script>
    @endpush
</x-app-layout>