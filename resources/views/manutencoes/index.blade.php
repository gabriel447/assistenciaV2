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
                <div class="modal-header bg-secondary text-white">
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

    <!-- Modal de Cadastro de Manutenção -->
    <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="cadastroModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="cadastroModalLabel">
                        <i class="fas fa-plus me-2"></i>Nova Manutenção
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="cadastroForm">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <!-- Coluna Esquerda: Cliente e Aparelho -->
                            <div class="col-md-6">
                                <!-- Seção Cliente -->
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 fw-bold"><i class="fas fa-user me-2 text-primary"></i>Cliente</h6>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="mb-0">
                                            <label for="cliente_id" class="form-label fw-semibold text-dark">Selecionar Cliente *</label>
                                            <select class="form-select form-select-lg" id="cliente_id" name="cliente_id" required>
                                                <option value="">Selecione um cliente...</option>
                                            </select>
                                            <div class="invalid-feedback" id="cliente-error">
                                                Por favor, selecione um cliente.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Seção Aparelho -->
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 fw-bold"><i class="fas fa-mobile-alt me-2 text-primary"></i>Aparelho</h6>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="aparelho_tipo" class="form-label fw-semibold text-dark">Tipo *</label>
                                                    <select class="form-select" id="aparelho_tipo" name="aparelho_tipo" required>
                                                        <option value="">Selecione o tipo...</option>
                                                        <option value="Smartphone">Smartphone</option>
                                                        <option value="Tablet">Tablet</option>
                                                        <option value="Notebook">Notebook</option>
                                                        <option value="Desktop">Desktop</option>
                                                        <option value="Smartwatch">Smartwatch</option>
                                                        <option value="Outro">Outro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="aparelho_marca" class="form-label fw-semibold text-dark">Marca *</label>
                                                    <select class="form-select" id="aparelho_marca" name="aparelho_marca" required>
                                                        <option value="">Selecione a marca...</option>
                                                        <option value="Apple">Apple</option>
                                                        <option value="Dell">Dell</option>
                                                        <option value="Samsung">Samsung</option>
                                                        <option value="Motorola">Motorola</option>
                                                        <option value="HP">HP</option>
                                                        <option value="Lenovo">Lenovo</option>
                                                        <option value="Xiaomi">Xiaomi</option>
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Asus">Asus</option>
                                                        <option value="LG">LG</option>
                                                        <option value="Huawei">Huawei</option>
                                                        <option value="Acer">Acer</option>
                                                        <option value="Outro">Outro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="aparelho_modelo" class="form-label fw-semibold text-dark">Modelo *</label>
                                                    <input type="text" class="form-control" id="aparelho_modelo" name="aparelho_modelo" placeholder="Ex: iPhone 13, Galaxy S21, Dell Inspiron..." required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="aparelho_nserie" class="form-label fw-semibold text-dark">Nº Série</label>
                                                    <input type="text" class="form-control" id="aparelho_nserie" name="aparelho_nserie" placeholder="Número de série do aparelho">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="aparelho_senha" class="form-label fw-semibold text-dark">Senha/PIN</label>
                                                    <input type="text" class="form-control" id="aparelho_senha" name="aparelho_senha" placeholder="Senha ou PIN do aparelho">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-0">
                                                    <label for="aparelho_detalhes" class="form-label fw-semibold text-dark">Detalhes Adicionais</label>
                                                    <textarea class="form-control" id="aparelho_detalhes" name="aparelho_detalhes" rows="2" placeholder="Informações adicionais sobre o aparelho (cor, estado, acessórios, etc.)"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Coluna Direita: Manutenção -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-3" style="height: calc(100% - 1rem);">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 fw-bold"><i class="fas fa-wrench me-2 text-primary"></i>Manutenção</h6>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="data_entrada" class="form-label fw-semibold text-dark">Data de Entrada *</label>
                                                    <input type="date" class="form-control" id="data_entrada" name="data_entrada" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label fw-semibold text-dark">Status *</label>
                                                    <select class="form-select" id="status" name="status" required>
                                                        <option value="aguardando">Aguardando</option>
                                                        <option value="em_andamento">Em Andamento</option>
                                                        <option value="aguardando_pecas">Aguardando Peças</option>
                                                        <option value="pronto">Pronto</option>
                                                        <option value="entregue">Entregue</option>
                                                        <option value="cancelado">Cancelado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="defeito_relatado" class="form-label fw-semibold text-dark">Defeito Relatado *</label>
                                            <textarea class="form-control" id="defeito_relatado" name="defeito_relatado" rows="3" required placeholder="Descreva detalhadamente o problema relatado pelo cliente..."></textarea>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="valor_maodeobra" class="form-label fw-semibold text-dark">Valor Mão de Obra</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-success text-white">R$</span>
                                                        <input type="number" class="form-control" id="valor_maodeobra" name="valor_maodeobra" step="0.01" min="0" placeholder="0,00">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="valor_pecas" class="form-label fw-semibold text-dark">Valor Peças</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-success text-white">R$</span>
                                                        <input type="number" class="form-control" id="valor_pecas" name="valor_pecas" step="0.01" min="0" placeholder="0,00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-0">
                                            <label for="descricao" class="form-label fw-semibold text-dark">Descrição do Serviço</label>
                                            <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Descreva detalhadamente o serviço realizado, peças trocadas, testes realizados..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i>Salvar Manutenção
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal de Edição de Manutenção -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title" id="editModalLabel">
                        <i class="fas fa-edit me-2"></i>Editar Manutenção
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_manutencao_id" name="manutencao_id">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Coluna Esquerda: Cliente e Aparelho -->
                            <div class="col-md-6">
                                <!-- Seção Cliente -->
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 fw-bold"><i class="fas fa-user me-2 text-primary"></i>Cliente</h6>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="mb-0">
                                            <label for="edit_cliente_id" class="form-label fw-semibold text-dark">Selecionar Cliente *</label>
                                            <select class="form-select form-select-lg" id="edit_cliente_id" name="cliente_id" required>
                                                <option value="">Selecione um cliente...</option>
                                            </select>
                                            <div class="invalid-feedback" id="edit-cliente-error">
                                                Por favor, selecione um cliente.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Seção Aparelho -->
                                <div class="card border-0 shadow-sm mb-3">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 fw-bold"><i class="fas fa-mobile-alt me-2 text-primary"></i>Aparelho</h6>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_aparelho_tipo" class="form-label fw-semibold text-dark">Tipo *</label>
                                                    <select class="form-select" id="edit_aparelho_tipo" name="aparelho_tipo" required>
                                                        <option value="">Selecione o tipo...</option>
                                                        <option value="Smartphone">Smartphone</option>
                                                        <option value="Tablet">Tablet</option>
                                                        <option value="Notebook">Notebook</option>
                                                        <option value="Desktop">Desktop</option>
                                                        <option value="Smartwatch">Smartwatch</option>
                                                        <option value="Outro">Outro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_aparelho_marca" class="form-label fw-semibold text-dark">Marca *</label>
                                                    <select class="form-select" id="edit_aparelho_marca" name="aparelho_marca" required>
                                                        <option value="">Selecione a marca...</option>
                                                        <option value="Apple">Apple</option>
                                                        <option value="Dell">Dell</option>
                                                        <option value="Samsung">Samsung</option>
                                                        <option value="Motorola">Motorola</option>
                                                        <option value="HP">HP</option>
                                                        <option value="Lenovo">Lenovo</option>
                                                        <option value="Xiaomi">Xiaomi</option>
                                                        <option value="Positivo">Positivo</option>
                                                        <option value="Asus">Asus</option>
                                                        <option value="LG">LG</option>
                                                        <option value="Huawei">Huawei</option>
                                                        <option value="Acer">Acer</option>
                                                        <option value="Outro">Outro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="edit_aparelho_modelo" class="form-label fw-semibold text-dark">Modelo *</label>
                                                    <input type="text" class="form-control" id="edit_aparelho_modelo" name="aparelho_modelo" placeholder="Ex: iPhone 13, Galaxy S21, Dell Inspiron..." required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_aparelho_nserie" class="form-label fw-semibold text-dark">Nº Série</label>
                                                    <input type="text" class="form-control" id="edit_aparelho_nserie" name="aparelho_nserie" placeholder="Número de série do aparelho">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_aparelho_senha" class="form-label fw-semibold text-dark">Senha/PIN</label>
                                                    <input type="text" class="form-control" id="edit_aparelho_senha" name="aparelho_senha" placeholder="Senha ou PIN do aparelho">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-0">
                                                    <label for="edit_aparelho_detalhes" class="form-label fw-semibold text-dark">Detalhes Adicionais</label>
                                                    <textarea class="form-control" id="edit_aparelho_detalhes" name="aparelho_detalhes" rows="2" placeholder="Informações adicionais sobre o aparelho (cor, estado, acessórios, etc.)"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Coluna Direita: Manutenção -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-3" style="height: calc(100% - 1rem);">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0 fw-bold"><i class="fas fa-wrench me-2 text-primary"></i>Manutenção</h6>
                                    </div>
                                    <div class="card-body py-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_data_saida" class="form-label fw-semibold text-dark">Data de Saída</label>
                                                    <input type="date" class="form-control" id="edit_data_saida" name="data_saida">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_status" class="form-label fw-semibold text-dark">Status *</label>
                                                    <select class="form-select" id="edit_status" name="status" required>
                                                        <option value="aguardando">Aguardando</option>
                                                        <option value="em_andamento">Em Andamento</option>
                                                        <option value="aguardando_pecas">Aguardando Peças</option>
                                                        <option value="pronto">Pronto</option>
                                                        <option value="entregue">Entregue</option>
                                                        <option value="cancelado">Cancelado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="edit_defeito_relatado" class="form-label fw-semibold text-dark">Defeito Relatado *</label>
                                            <textarea class="form-control" id="edit_defeito_relatado" name="defeito_relatado" rows="3" required placeholder="Descreva detalhadamente o problema relatado pelo cliente..."></textarea>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_valor_maodeobra" class="form-label fw-semibold text-dark">Valor Mão de Obra</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-success text-white">R$</span>
                                                        <input type="number" class="form-control" id="edit_valor_maodeobra" name="valor_maodeobra" step="0.01" min="0" placeholder="0,00">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="edit_valor_pecas" class="form-label fw-semibold text-dark">Valor Peças</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-success text-white">R$</span>
                                                        <input type="number" class="form-control" id="edit_valor_pecas" name="valor_pecas" step="0.01" min="0" placeholder="0,00">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-0">
                                            <label for="edit_descricao" class="form-label fw-semibold text-dark">Descrição do Serviço</label>
                                            <textarea class="form-control" id="edit_descricao" name="descricao" rows="4" placeholder="Descreva detalhadamente o serviço realizado, peças trocadas, testes realizados..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Cancelar
                        </button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i>Atualizar Manutenção
                        </button>
                    </div>
                </form>
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
                    { data: 'defeito_relatado', name: 'defeito_relatado' },
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
            // Limpar formulário
            $('#cadastroForm')[0].reset();
            
            // Definir data de entrada como hoje
            $('#data_entrada').val(new Date().toISOString().split('T')[0]);
            
            // Carregar clientes
            carregarClientes();
            
            // Mostrar modal
            $('#cadastroModal').modal('show');
        }
        
        function carregarClientes() {
            $.ajax({
                url: '/api/clientes',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var select = $('#cliente_id');
                    select.empty();
                    select.append('<option value="">Selecione um cliente...</option>');
                    
                    $.each(data, function(index, cliente) {
                        select.append('<option value="' + cliente.id + '">' + cliente.nome + ' - ' + cliente.cpf + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao carregar clientes:', error);
                    alert('Erro ao carregar lista de clientes');
                }
            });
        }
        

        
        // Validação do cliente antes do envio
        function validarCliente() {
            var clienteId = $('#cliente_id').val();
            var clienteSelect = $('#cliente_id');
            var errorDiv = $('#cliente-error');
            
            if (!clienteId || clienteId === '') {
                clienteSelect.addClass('is-invalid');
                errorDiv.show();
                return false;
            } else {
                clienteSelect.removeClass('is-invalid');
                errorDiv.hide();
                return true;
            }
        }
        
        // Remover validação quando cliente for selecionado
        $('#cliente_id').on('change', function() {
            if ($(this).val()) {
                $(this).removeClass('is-invalid');
                $('#cliente-error').hide();
            }
        });
        
        // Submissão do formulário de cadastro
        $(document).on('submit', '#cadastroForm', function(e) {
            e.preventDefault();
            
            // Validar se cliente foi selecionado
            if (!validarCliente()) {
                // Scroll para o campo cliente
                $('html, body').animate({
                    scrollTop: $('#cliente_id').offset().top - 100
                }, 500);
                
                // Focar no campo cliente
                $('#cliente_id').focus();
                
                // Mostrar alerta
                alert('Por favor, selecione um cliente antes de continuar.');
                return false;
            }
            
            var formData = {
                cliente_id: $('#cliente_id').val(),
                aparelho: {
                    tipo: $('#aparelho_tipo').val(),
                    marca: $('#aparelho_marca').val(),
                    modelo: $('#aparelho_modelo').val(),
                    nserie: $('#aparelho_nserie').val(),
                    senha: $('#aparelho_senha').val(),
                    detalhes: $('#aparelho_detalhes').val()
                },
                manutencao: {
                    defeito_relatado: $('#defeito_relatado').val(),
                    data_entrada: $('#data_entrada').val(),
                    status: $('#status').val(),
                    valor_maodeobra: $('#valor_maodeobra').val(),
                    valor_pecas: $('#valor_pecas').val(),
                    descricao: $('#descricao').val()
                },
                _token: $('meta[name="csrf-token"]').attr('content')
            };
            
            // Desabilitar botão de envio para evitar duplo clique
            var submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Salvando...');
            
            $.ajax({
                url: '{{ route("manutencoes.store") }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    $('#cadastroModal').modal('hide');
                    $('#manutencoesTable').DataTable().ajax.reload();
                    
                    // Mostrar mensagem de sucesso
                    alert('Manutenção cadastrada com sucesso!');
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao cadastrar manutenção:', xhr.responseText);
                    
                    if (xhr.status === 422) {
                        // Erros de validação
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = 'Erros de validação:\n';
                        
                        $.each(errors, function(field, messages) {
                            errorMessage += '- ' + messages.join(', ') + '\n';
                        });
                        
                        alert(errorMessage);
                    } else {
                        alert('Erro ao cadastrar manutenção: ' + error);
                    }
                },
                complete: function() {
                    // Reabilitar botão de envio
                    submitBtn.prop('disabled', false).html('<i class="fas fa-save me-1"></i>Salvar Manutenção');
                }
            });
        });

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
            // Primeiro carregar clientes, depois buscar dados da manutenção
            carregarClientesEdit().then(() => {
                // Buscar dados da manutenção após clientes carregados
                fetch(`/manutencoes/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const manutencao = data.manutencao;
                            
                            // Preencher campos do formulário
                            document.getElementById('edit_manutencao_id').value = manutencao.id;
                            document.getElementById('edit_cliente_id').value = manutencao.cliente_id;
                            document.getElementById('edit_aparelho_tipo').value = manutencao.aparelho_tipo;
                            document.getElementById('edit_aparelho_marca').value = manutencao.aparelho_marca;
                            document.getElementById('edit_aparelho_modelo').value = manutencao.aparelho_modelo;
                            document.getElementById('edit_aparelho_nserie').value = manutencao.aparelho_nserie || '';
                            document.getElementById('edit_aparelho_senha').value = manutencao.aparelho_senha || '';
                            document.getElementById('edit_aparelho_detalhes').value = manutencao.aparelho_detalhes || '';
                            document.getElementById('edit_data_saida').value = manutencao.data_saida || '';
                            document.getElementById('edit_status').value = manutencao.status;
                            document.getElementById('edit_defeito_relatado').value = manutencao.defeito_relatado;
                            document.getElementById('edit_valor_maodeobra').value = manutencao.valor_maodeobra || '';
                            document.getElementById('edit_valor_pecas').value = manutencao.valor_pecas || '';
                            document.getElementById('edit_descricao').value = manutencao.descricao || '';
                            
                            // Controlar habilitação do campo data_saida baseado no status
                            toggleDataSaidaField();
                            
                            // Abrir modal
                            const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                            editModal.show();
                        } else {
                            alert('Erro ao carregar dados da manutenção');
                        }
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro ao carregar dados da manutenção');
                    });
            });
        }
        
        function carregarClientesEdit() {
            return fetch('/api/clientes')
                .then(response => response.json())
                .then(data => {
                    const select = document.getElementById('edit_cliente_id');
                    select.innerHTML = '<option value="">Selecione um cliente...</option>';
                    
                    data.forEach(cliente => {
                        const option = document.createElement('option');
                        option.value = cliente.id;
                        option.textContent = cliente.nome;
                        select.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Erro ao carregar clientes:', error);
                });
        }
        
        function validarClienteEdit() {
            const clienteSelect = document.getElementById('edit_cliente_id');
            const errorDiv = document.getElementById('edit-cliente-error');
            
            if (!clienteSelect.value) {
                clienteSelect.classList.add('is-invalid');
                errorDiv.style.display = 'block';
                clienteSelect.focus();
                clienteSelect.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return false;
            } else {
                clienteSelect.classList.remove('is-invalid');
                errorDiv.style.display = 'none';
                return true;
            }
        }
        
        // Submissão do formulário de edição
        document.getElementById('editForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validarClienteEdit()) {
                return;
            }
            
            const formData = new FormData(this);
            const manutencaoId = document.getElementById('edit_manutencao_id').value;
            
            fetch(`/manutencoes/${manutencaoId}`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Fechar modal
                    const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                    editModal.hide();
                    
                    // Recarregar a página ou atualizar a tabela
                    location.reload();
                } else {
                    alert('Erro ao atualizar manutenção: ' + (data.message || 'Erro desconhecido'));
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao atualizar manutenção');
            });
        });

        function deleteManutencao(id) {
            // Implementar exclusao
            if (confirm('Tem certeza que deseja excluir esta manutencao?')) {
                alert('Excluir manutencao ID: ' + id);
            }
        }
        
        // Função para controlar habilitação do campo data_saida
          function toggleDataSaidaField() {
              const statusSelect = document.getElementById('edit_status');
              const dataSaidaInput = document.getElementById('edit_data_saida');
              
              if (statusSelect.value === 'entregue') {
                  // Só preencher com data atual se o campo estiver vazio
                  if (!dataSaidaInput.value) {
                      dataSaidaInput.value = new Date().toISOString().split('T')[0];
                  }
                  dataSaidaInput.disabled = false;
                  dataSaidaInput.readOnly = true;
                  dataSaidaInput.required = true;
              } else {
                  dataSaidaInput.disabled = true;
                  dataSaidaInput.readOnly = false;
                  dataSaidaInput.required = false;
                  dataSaidaInput.value = ''; // Limpar o campo quando desabilitado
              }
          }
        
        // Event listener para mudança no status
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('edit_status');
            if (statusSelect) {
                statusSelect.addEventListener('change', toggleDataSaidaField);
            }
        });
    </script>
    @endpush
</x-app-layout>