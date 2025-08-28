@foreach ($users as $user)
  <a href="{{ url($user->username) }}"
    class="relative flex h-[120px] w-full items-end overflow-hidden rounded-lg bg-cover"
    style="background: @if ($user->cover != '') url({{ route('resize', ['path' => 'cover', 'file' => $user->cover, 'size' => 480]) }}) @endif rgb(233, 114, 3) center center;">

    {{-- Free badge --}}
    @if ($user->free_subscription == 'yes')
      <span class="absolute right-0 top-0 z-20 m-2 rounded-md bg-black/50 px-2 py-1 text-sm text-white">
        {{ __('general.free') }}
      </span>
    @endif

    {{-- Backdrop --}}
    <div class="absolute z-10 flex h-full w-full bg-black opacity-20"></div>

    <div class="z-30 flex w-full items-center gap-3 p-3">
      <img class="rounded-full" src="{{ Helper::getFile(config('path.avatar') . $user->avatar) }}" width="48"
        height="48">

      <div class="flex flex-col leading-4">
        <p class="m-0 font-bold text-white">
          {{ $user->name }}
        </p>
        <p class="m-0 text-sm text-white">
          @ {{ $user->username }}
        </p>
      </div>
    </div>
  </a>
@endforeach
