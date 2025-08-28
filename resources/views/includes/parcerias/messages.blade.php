{{-- resources/views/includes/parcerias/messages.blade.php --}}
@php
    $userId = auth()->id();
@endphp
<div>
    <div class="d-flex flex-column gap-2">
        @forelse($mensajes as $mensaje)
            @php
                $esPropio = $mensaje->sender_id == $userId;
            @endphp
            <div class="row">
                @if($esPropio)
                    <div class="col-3"></div>
                    <div class="col-9">
                        <div class="p-3 rounded shadow-sm" style="background:#e3f2fd;">
                            <div>{{ $mensaje->text }}</div>
                            <div class="text-end small text-muted mt-1">
                                {{ $mensaje->sender->name ?? 'Usuario' }} -- {{ $mensaje->created_at->format('H:i, d-m-Y') }}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-9">
                        <div class="p-3 rounded shadow-sm" style="background:#e8f5e9;">

                            <div>{{ $mensaje->text }}</div>
                            <div class="text-end small text-muted mt-1">
                                {{ $mensaje->sender->name ?? 'Usuario' }} -- {{ $mensaje->created_at->format('H:i, d-m-Y') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                @endif
            </div>
        @empty
            <div class="text-center text-muted py-4">No hay mensajes en esta parceria.</div>
        @endforelse
    </div>

</div>

{{-- Al final del archivo --}}
<div class="mt-4">
    <form action="{{ route('parcerias.mensajes.enviar', $parceria->id) }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="mensaje" class="form-label">Nuevo mensaje</label>
            <textarea id="mensaje" name="mensaje" class="form-control" rows="3" placeholder="Escribe tu mensaje aquí..." required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
</div>
