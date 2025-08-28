@php
  // $highlights = [
  //     [
  //         'avatar' => 'https://app.pierfans.com.br/files/storage/35/48683606d1678cd1748371153fual9qkhahnqowbjepef.jpeg',
  //         'name' => 'Juju Ferrari',
  //         'username' => '@jujuferrari',
  //         'created_at' => now()->subHour(),
  //         'description' => __('home_highlight.highlight_post_1'),
  //         'image_url' =>
  //             'https://app.pierfans.com.br/files/storage/35/48683606d1678cd1748371153fual9qkhahnqowbjepef.jpeg',
  //     ],
  //     [
  //         'avatar' => url('public/img/highlights/88a01013a3d2374663ae6fef83745395072471b2.jpg'),
  //         'name' => 'Laura Luxx',
  //         'username' => '@TheLauraLuxx',
  //         'created_at' => now()->subHours(9),
  //         'description' => __('home_highlight.highlight_post_2'),
  //         'image_url' => url('public/img/highlights/88a01013a3d2374663ae6fef83745395072471b2.jpg'),
  //     ],
  //     [
  //         'avatar' => url('public/img/highlights/736b50a07715dfbf61df0d4756cb14915ebb9605.jpg'),
  //         'name' => 'Scarlet Desire',
  //         'username' => '@ScarletDesire',
  //         'created_at' => now()->subHours(9),
  //         'description' => __('home_highlight.highlight_post_3'),
  //         'image_url' => url('public/img/highlights/736b50a07715dfbf61df0d4756cb14915ebb9605.jpg'),
  //     ],
  // ];



@endphp

<div class="w-full bg-white py-16">
  <div class="mx-auto flex max-w-4xl flex-col justify-start px-4">
    <p class="mb-8 text-left text-2xl font-bold text-black">{{ __('home_highlight.title') }}</p>

    <div class="space-y-8">
      @foreach ($highlights as $highlight)
        <div class="overflow-hidden !rounded-lg border border-gray-200 bg-white shadow-sm">
          <!-- Header -->
          <div class="flex items-start justify-between p-3">
            <div class="flex items-center space-x-3">
              <img src="{{ $highlight['avatar'] }}" alt="{{ $highlight['name'] }}"
                class="h-12 w-12 rounded-full object-cover">
              <div class="flex flex-col">
                <p class="m-0 font-bold text-black">{{ $highlight['name'] }}</p>
                <p class="m-0 text-sm text-gray-500">{{ $highlight['username'] }}</p>
              </div>
            </div>
            <span class="text-sm text-gray-500">
              {{ \Carbon\Carbon::parse($highlight['last_update']['created_at'])->diffForHumans() }}
            </span>
          </div>

          <!-- Content -->
          <div class="flex flex-col gap-3 px-3 pb-3">
            <p class="m-0 text-gray-800">{{ $highlight['last_update']['description'] }}</p>
            <a href="#" class="!text-branding inline-block hover:underline">
              app.pierfans.com/{{ $highlight['username'] }}
            </a>
          </div>

          <!-- Image -->
          @if(!empty($highlight['last_update']['image_url']))
            <div class="aspect-video w-full">
              <img src="{{ $highlight['last_update']['image_url'] }}" alt="Post image" class="h-full w-full object-cover">
            </div>
          @endif

          <!-- Actions -->
          <div class="flex items-center gap-5 border-t border-gray-100 px-4 py-3">
            <button class="flex items-center space-x-2 bg-transparent text-gray-600 hover:text-red-500">
              <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 16 16">
                <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
                  d="M12.667 9.333c.993-.973 2-2.14 2-3.666A3.667 3.667 0 0 0 11 2c-1.173 0-2 .333-3 1.333C7 2.333 6.173 2 5 2a3.667 3.667 0 0 0-3.667 3.667c0 1.533 1 2.7 2 3.666L8 14l4.667-4.667Z" />
              </svg>
              <span>{{ __('home_highlight.like') }}</span>
            </button>

            <button class="flex items-center space-x-2 bg-transparent text-gray-600 hover:text-blue-500">
              <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 16 16">
                <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
                  d="M5.267 13.333a6 6 0 1 0-2.6-2.6l-1.334 3.934 3.934-1.334Z" />
              </svg>
              <span>{{ __('home_highlight.comment') }}</span>
            </button>

            <button class="flex items-center space-x-2 bg-transparent text-gray-600 hover:text-green-500">
              <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none" viewBox="0 0 16 16">
                <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
                  d="m5.727 9.007 4.553 2.653m-.007-7.32L5.727 6.993M14 3.333a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM6 8a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm8 4.667a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
              </svg>
              <span>{{ __('home_highlight.share') }}</span>
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
