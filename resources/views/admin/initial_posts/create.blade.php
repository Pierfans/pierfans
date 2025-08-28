@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Añadir Initial Poszt</h1>
    <a href="{{ route('admin.initial-posts.index') }}" class="btn btn-secondary">Volver</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.initial-posts.store') }}" class="card shadow p-4">
    @csrf
    <div class="row mb-4">
        <div class="col-md-6">
            <label for="update_id" class="form-label fw-bold">Selecciona un Update</label>
            <select name="update_id" id="update_id" class="form-select">
                @foreach($updates as $update)
                    <option value="{{ $update->id }}"
                        data-title="{{ $update->title ?? '' }}"
                        data-description="{{ $update->description ?? '' }}"
                        data-image="{{ isset($update->media) && count($update->media) ? asset('public/img/' . $update->media[0]->file) : '' }}">
                        #{{ $update->id }} - {{ Str::limit($update->description ?? $update->title ?? '', 40) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label fw-bold">Preview</label>
            <div id="update-preview" class="border rounded p-3 bg-light" style="min-height:320px">
                <div class="text-muted">Selecciona un update para ver el preview.</div>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label for="order" class="form-label fw-bold">Orden</label>
        <input type="number" name="order" id="order" class="form-control" value="{{ old('order') }}" required>
    </div>
    <button type="submit" class="btn btn-primary w-100 py-2">Añadir</button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const select = document.getElementById('update_id');
        const preview = document.getElementById('update-preview');

        function renderPreview() {
            const option = select.options[select.selectedIndex];
            const title = option.getAttribute('data-title') || '';
            const desc = option.getAttribute('data-description') || '';
            const image = option.getAttribute('data-image') || '';
            // Puedes agregar más atributos data-* si tienes más info (avatar, username, etc)
            // Para este ejemplo, solo usamos los disponibles
            let html = `<div class='overflow-hidden rounded border bg-white shadow-sm'>
                <div class='d-flex align-items-center justify-content-between p-2'>
                    <div class='d-flex align-items-center gap-2'>
                        <img src='/public/img/default-avatar.jpg' alt='Avatar' class='rounded-circle' style='width:40px;height:40px;object-fit:cover;'>
                        <div class='d-flex flex-column'>
                            <span class='fw-bold text-dark'>Usuario</span>
                            <span class='text-muted small'>@username</span>
                        </div>
                    </div>
                    <span class='text-muted small'>Ahora</span>
                </div>
                <div class='px-3 pb-2'>
                    <p class='mb-1 text-dark fw-bold'>${title}</p>
                    <p class='mb-2 text-secondary'>${desc}</p>
                </div>`;
            if (image) {
                html += `<div class='w-100 mb-2' style='aspect-ratio:16/9;overflow:hidden;'>
                    <img src='${image}' alt='Preview' class='img-fluid w-100 h-100 object-fit-cover'>
                </div>`;
            }
            html += `<div class='d-flex align-items-center gap-3 border-top px-3 py-2'>
                <button type='button' class='btn btn-link p-0 text-muted'><i class='bi bi-heart'></i> Like</button>
                <button type='button' class='btn btn-link p-0 text-muted'><i class='bi bi-chat'></i> Comment</button>
                <button type='button' class='btn btn-link p-0 text-muted'><i class='bi bi-share'></i> Share</button>
            </div></div>`;
            if (!title && !desc && !image) html = '<div class="text-muted">Sin información para este update.</div>';
            preview.innerHTML = html;
        }

        select.addEventListener('change', renderPreview);
        if (select.options.length) renderPreview();
    });
</script>
@endsection
