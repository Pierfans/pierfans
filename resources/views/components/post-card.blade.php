@php
    $user = $update->user;
    $media = $update->media;
@endphp
<div class="card mb-3">
    <div class="card-body">
        <div class="d-flex align-items-center mb-2">
            <img src="{{ $user->avatar ?? '' }}" alt="avatar" class="rounded-circle me-2" style="width:48px;height:48px;object-fit:cover;">
            <div>
                <strong>{{ $user->name ?? '' }}</strong>
                <div class="text-muted small">{{ $user->username ?? '' }}</div>
            </div>
            <div class="ms-auto text-muted small">{{ $update->date ? \Carbon\Carbon::parse($update->date)->diffForHumans() : '' }}</div>
        </div>
        <div class="mb-2">
            <div>{!! nl2br(e($update->description)) !!}</div>
        </div>
        @if($media && $media->image)
            <div class="mb-2">
                <img src="{{ $media->file_url }}" alt="Post image" class="img-fluid rounded">
            </div>
        @endif
        <!-- Aquí puedes añadir más campos si tu post tiene video, links, etc. -->
    </div>
    <div class="card-footer bg-white border-0 d-flex justify-content-between">
        <span class="text-muted"><i class="far fa-heart"></i> Me gusta</span>
        <span class="text-muted"><i class="far fa-comment"></i> Comentar</span>
        <span class="text-muted"><i class="fas fa-share"></i> Compartir</span>
    </div>
</div>
