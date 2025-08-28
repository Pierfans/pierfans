@extends('layouts.app')



@section('content')
    <section class="container" style="min-height: 75vh">
        <div class="row justify-content-center text-center mb-sm">
            <div class="col-lg-8 py-5">
                <h2 class="mb-0 font-montserrat"> <?php echo e(__('Parcerias'), false); ?></h2>
            </div>
        </div>

        <div class="second wrap-post w-full p-0">
            <table class="table-auto w-full mt-6">
                <thead>
                <tr>
                    <th class="px-4 py-2">Remetente</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2">Data</th>
                    <th>&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                @forelse($parcerias as $parceria)
                    <tr>
                        <td class="border px-4 py-2">{{ $parceria->userOrigin->username ?? 'N/A' }}</td>
                        <td class="border px-4 py-2">{{ $parceria->active ? 'Ativa' : 'Inativa' }}</td>
                        <td class="border px-4 py-2">{{ $parceria->created_at->format('H:i, d-m-Y') }}</td>
                        <td class="border px-4 py-2">
                            <button
                                class="btn btn-primary ver-mensajes"
                                data-parceria-id="{{ $parceria->id }}"
                                data-toggle="modal"
                                data-target="#modalMensajes"
                                title="Ver mensagens"
                            >
                                <i class="fas fa-eye"></i>
                            </button>
                            @php
                                $ultimoMensaje = $parceria->mensajes()->latest()->first();
                            @endphp
                            @if($ultimoMensaje && $ultimoMensaje->sender_id !== auth()->id())
                                <span title="Nova mensagem recebida" style="color: #ffc107; font-size: 1.5em; vertical-align: middle;">&#9888;</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4">Você não tem parcerias recebidas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <!-- Modal -->
            <div class="modal fade" id="modalMensajes" tabindex="-1" role="dialog" aria-labelledby="modalMensajesLabel" aria-hidden="true" style="max-width: 100vw;">
                <div class="modal-dialog" role="document" style="min-width: 85%;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalMensajesLabel">Mensagens da Parceria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="mensajesContenido">
                            <!-- Aqui serão carregadas as mensagens via AJAX -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('javascript')
    @if (session('noty_error'))
        <script type="text/javascript">
            swal({
                title: "{{ __('general.error_oops') }}",
                text: "{{ __('general.already_sent_report') }}",
                type: "error",
                confirmButtonText: "{{ __('users.ok') }}"
            });
        </script>
    @endif

    @if (session('noty_success'))
        <script type="text/javascript">
            swal({
                title: "{{ __('general.thanks') }}",
                text: "{{ __('general.reported_success') }}",
                type: "success",
                confirmButtonText: "{{ __('users.ok') }}"
            });
        </script>
    @endif

    @if (session('success_verify'))
        <script type="text/javascript">
            swal({
                title: "{{ __('general.welcome') }}",
                text: "{{ __('users.account_validated') }}",
                type: "success",
                confirmButtonText: "{{ __('users.ok') }}"
            });
        </script>
    @endif

    @if (session('error_verify'))
        <script type="text/javascript">
            swal({
                title: "{{ __('general.error_oops') }}",
                text: "{{ __('users.code_not_valid') }}",
                type: "error",
                confirmButtonText: "{{ __('users.ok') }}"
            });
        </script>
    @endif

    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.ver-mensajes').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var parceriaId = this.getAttribute('data-parceria-id');
                    document.getElementById('mensajesContenido').innerHTML = '<div class="text-center py-4">Carregando...</div>';
                    fetch('/parceria/' + parceriaId + '/mensajes')
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('mensajesContenido').innerHTML = html;
                        });
                });
            });
        });
    </script>

@endsection
