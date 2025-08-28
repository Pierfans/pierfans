@extends('admin.layout')

@section('content')
    <h5 class="mb-4 fw-light">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a class="text-reset" href="{{ url('panel/admin') }}">{{ __('admin.dashboard') }}</a>
                <i class="bi-chevron-right me-1 fs-6"></i>
                <span class="text-muted">{{ __('Top Criadores') }} ({{ $highlights->count() }})</span>
            </div>
            <button type="button" class="btn btn-success rounded-circle" data-bs-toggle="modal" data-bs-target="#createHighlightModal" title="Nuevo Highlight" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-plus"></i>
            </button>
        </div>
    </h5>

    <div class="content">
        <div class="row">
            <div class="col-lg-12">

                @if (session('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check2 me-1"></i> {{ session('success_message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif

                <div class="card shadow-custom border-0">
                    <div class="card-body p-lg-4">

                        <div class="table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                <tr>
                                    <th class="active">ID</th>
                                    <th class="active">Order</th>
                                    <th class="active">{{ __('auth.full_name') }}</th>
                                    <th class="active">{{ __('username') }}</th>
                                    <th class="active">{{ __('admin.actions') }}</th>
                                </tr>

                                @forelse ($highlights as $highlight)
                                    <tr>
                                        <td>{{ $highlight['user_id'] }}</td>
                                        <td>{{ $highlight['order'] }}</td>
                                        <td>
                                            <a href="{{ url($highlight['username']) }}" target="_blank">
                                                <img src="{{ $highlight['avatar'] }}" width="40" height="40" class="rounded-circle me-1" />
                                                {{ \Illuminate\Support\Str::limit($highlight['name'], 20, '...') }} <i class="bi-box-arrow-up-right"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $highlight['username'] }}</span>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ url('panel/admin/top-creadores/remove/'.$highlight['user_id']) }}" class="d-inline-block align-top">
                                                @csrf
                                                <button type="submit" class="btn btn-danger rounded-pill btn-sm" title="Quitar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">{{ __('general.no_results_found') }}</td>
                                    </tr>
                                @endforelse

                                </tbody>
                            </table>
                        </div><!-- /.table-responsive -->

                    </div><!-- /.card-body -->
                </div><!-- /.card -->

            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
        <!-- Modal de crear highlight -->
        <div class="modal fade" id="createHighlightModal" tabindex="-1" aria-labelledby="createHighlightModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                @if($users->isEmpty())
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createHighlightModalLabel">Crear Highlight</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="alert alert-info m-3">
                                {{ __('No hay creadores disponibles') }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>

                @else
                    <form method="POST" action="{{ url('panel/admin/top-creadores/add') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createHighlightModalLabel">Crear Highlight</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="user_id" class="form-label">Usuario</label>
                                    <select class="form-select" id="user_id" name="user_id" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->username }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="order" class="form-label">Orden</label>
                                    <input type="number" class="form-control" id="order" name="order" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Crear</button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>

    </div><!-- /.content -->
@endsection
