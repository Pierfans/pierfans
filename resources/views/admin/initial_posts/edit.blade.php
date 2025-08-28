@extends('admin.layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">Editar Initial Post</h1>
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

<form method="POST" action="{{ route('admin.initial-posts.update', $initialPost->id) }}">
    @csrf
    <div class="mb-3">
        <label for="update_id" class="form-label">Update</label>
        <select name="update_id" id="update_id" class="form-select">
            @foreach($updates as $update)
                <option value="{{ $update->id }}" @if($initialPost->update_id == $update->id) selected @endif>
                    #{{ $update->id }} - {{ Str::limit($update->description ?? $update->title ?? '', 40) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="order" class="form-label">Orden</label>
        <input type="number" name="order" id="order" class="form-control" value="{{ old('order', $initialPost->order) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
