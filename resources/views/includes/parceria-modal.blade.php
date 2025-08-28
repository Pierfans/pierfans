
<!-- Modal de Parcerias Responsivo -->
<div class="modal fade" id="parceriaModal" tabindex="-1" aria-labelledby="parceriaModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            @php
                $creators = \App\Models\User::where('role', 'normal')->get();
            @endphp

            @if($creators->isEmpty())
                <div class="modal-header">
                    <h5 class="modal-title" id="parceriaModalLabel">Enviar Parceria</h5>
                    <button type="button" class="btn-close" onclick="fecharModal()" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        Não há criadores disponíveis.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="fecharModal()">Cancelar</button>
                </div>
            @else
                <form method="POST" action="{{ url('parcerias/enviar') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="parceriaModalLabel">Enviar Parceria</h5>
                        <button type="button" class="btn-close" onclick="fecharModal()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="creator_id" class="form-label">Selecione um criador</label>
                            <select class="form-select select2-parceria" id="creator_id" name="creator_id" style="width: 100%;" required>
                                @foreach($creators as $creator)
                                    <option value="{{ $creator->id }}">{{ $creator->username }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

<!-- CSS para Responsividade -->
<style>
    /* Garante que o container do Select2 ocupe 100% da largura do seu pai */
    .select2-container {
        width: 100% !important;
    }

    /* Ajustes para o modal em telas pequenas para garantir a centralização */
    @media (max-width: 576px) {
        #parceriaModal .modal-dialog {
            max-width: 95%;
            margin: 1.75rem auto; /* Garante margens automáticas para centralização */
        }
    }
</style>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
// Função para fechar o modal
function fecharModal() {
    var modal = document.getElementById('parceriaModal');
    var modalInstance = bootstrap.Modal.getInstance(modal);
    if (modalInstance) {
        modalInstance.hide();
    } else {
        var bsModal = new bootstrap.Modal(modal);
        bsModal.hide();
    }
}

// Inicialização quando o documento estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    // Inicializa o Select2
    $('.select2-parceria').select2({
        dropdownParent: $('#parceriaModal'),
        placeholder: 'Busque um criador...',
        language: {
            noResults: function() {
                return "Nenhum resultado encontrado";
            }
        }
    });

    // Fecha o modal ao pressionar ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            fecharModal();
        }
    });
});
</script>
