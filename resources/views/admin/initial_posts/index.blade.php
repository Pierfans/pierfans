@extends('admin.layout')


@section('content')
    <h5 class="mb-4 fw-light">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a class="text-reset" href="{{ url('panel/admin') }}">{{ __('admin.dashboard') }}</a>
                <i class="bi-chevron-right me-1 fs-6"></i>
                <span class="text-muted">{{ __('Post inicial') }} ({{ $initialPosts->count() }})</span>
            </div>
            <button type="button" class="btn btn-success rounded-circle" data-bs-toggle="modal" data-bs-target="#addInitialPostModal" title="Nuevo Post inicial" style="width: 25px; height: 25px; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-plus"></i>
            </button>
        </div>
    </h5>
    <div class="card shadow-custom border-0 mt-4">
  <div class="card-body p-lg-4">
    <div class="table-responsive p-0">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th class="active">ID</th>
            <th class="active">Update ID</th>
            <th class="active">Order</th>
            <th class="active">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse($initialPosts as $post)
            <tr>
              <td>{{ $post->id }}</td>
              <td>{{ $post->update_id }}</td>
              <td>{{ $post->order }}</td>
              <td>               

                 <form method="POST" action="{{ route('admin.initial-posts.destroy', $post->id) }}" class="d-inline-block align-top">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill btn-sm" title="Quitar">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted py-5">No hay registros</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addInitialPostModal" tabindex="-1" aria-labelledby="addInitialPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addInitialPostModalLabel">Añadir Initial Post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('admin.initial-posts.store') }}">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="user_filter" class="form-label">Filtrar por usuario</label>
            <input type="text" class="form-control" id="user_filter" placeholder="Buscar usuario por nombre o email">
          </div>
          <div class="mb-3">
            <label for="update_id" class="form-label">Update</label>
            <select class="form-select" id="update_id" name="update_id" required
onchange="
  var select = document.getElementById('update_id');
  var previews = document.querySelectorAll('.update-preview');
  previews.forEach(function(div) { div.style.display = 'none'; });
  var selected = select.value;
  if (selected) {
    var previewDiv = document.getElementById('preview-' + selected);
    if (previewDiv) previewDiv.style.display = '';
  }
">
              <option value="">Selecciona un update</option>
              @foreach($updates as $update)
                <option value="{{ $update->id }}" data-user="{{ $update->user->name ?? '' }} {{ $update->user->email ?? '' }}">
                  {{ $update->id }} - {{ Str::limit($update->description, 40) }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="order" class="form-label">Orden</label>
            <input type="number" class="form-control" id="order" name="order" required>
          </div>
          <!-- Previews de updates -->
          <div id="previews-container">
            @foreach($updates as $update)
              <div id="preview-{{ $update->id }}" class="update-preview border rounded p-2 mb-2" style="display:none;">
                <strong>#{{ $update->id }}</strong><br>
                <span>{{ $update->description ?? $update->title ?? '' }}</span>
                @php
                  $media = $update->media;
                  $hasMedia = false;
                  if (is_array($media) || $media instanceof \Countable) {
                    $hasMedia = count($media) > 0;
                  } elseif ($media) {
                    $hasMedia = true;
                  }
                @endphp
                @if($hasMedia)
                  <div class="mt-2">
                    <img src="{{ asset('public/img/' . (is_array($media) ? $media[0]->file : $media->file)) }}" alt="Media" style="max-width:100px;max-height:100px;">
                  </div>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
function showPreviewDiv() {
  var select = document.getElementById('update_id');
  var previews = document.querySelectorAll('.update-preview');
  previews.forEach(function(div) { div.style.display = 'none'; });
  var selected = select.value;
  if (selected) {
    var previewDiv = document.getElementById('preview-' + selected);
    if (previewDiv) previewDiv.style.display = '';
  }
}
</script>
@endpush
<!-- Preview y JS de preview eliminados temporalmente -->
    </div>
  </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif


@endsection
