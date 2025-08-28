<div class="border-t-1 flex w-full flex-col gap-14 border-gray-100 p-14">
  <div class="flex flex-col gap-8 sm:flex-row">
    <div class="flex flex-1 flex-col gap-2">
      <p class="mb-1 text-xl font-bold text-black">{{ __('general.about') }}</p>

      <a target="_blank" href="{{ url('p/sobre') }}" class="!text-gray-600">{{ __('general.about_us') }}</a>
      {{-- <a target="_blank" href="#" class="!text-gray-600">{{ __('general.brand') }}</a> --}}
      <a target="_blank" href="{{ $settings->link_terms }}" class="!text-gray-600">{{ __('general.terms_of_service') }}</a>
    </div>

    <div class="flex flex-1 flex-col gap-2">
      <p class="mb-1 text-xl font-bold text-black">{{ __('general.legal') }}</p>

      <a target="_blank" href="{{ $settings->link_privacy }}"
        class="!text-gray-600">{{ __('general.privacy_policy') }}</a>
      <a target="_blank" href="{{ $settings->link_cookies }}"
        class="!text-gray-600">{{ __('general.cookie_notice') }}</a>
      {{-- <a target="_blank" href="#" class="!text-gray-600">{{ __('general.dmca') }}</a> --}}
    </div>

    <div class="flex flex-1 flex-col gap-2">
      <p class="mb-1 text-xl font-bold text-black">{{ __('general.support') }}</p>

      {{-- <a target="_blank" href="#" class="!text-gray-600">{{ __('general.help_center') }}</a> --}}
      <a target="_blank" href="{{ url('contact') }}" class="!text-gray-600">{{ __('general.contact') }}</a>
    </div>

    <div class="flex flex-1 flex-col gap-2">
      <p class="mb-1 text-xl font-bold text-black">{{ __('general.community') }}</p>

      <a target="_blank" href="{{ $settings->instagram }}" class="!text-gray-600">Instagram</a>
      <a target="_blank" href="{{ $settings->twitter }}" class="!text-gray-600">Twitter (X)</a>
      <a target="_blank" href="{{ $settings->tiktok }}" class="!text-gray-600">TikTok</a>
    </div>
  </div>

  <div class="flex justify-between gap-8">
    <p class="w-full !text-gray-600">
      ©{{ date('Y') }} Pier Fans. {{ __('general.all_rights_reserved') }}.
    </p>
    @if ($languages->count() > 1)
      <div class="btn-group dropup d-inline">
        <li class="list-inline-item">
          <a class="link-footer dropdown-toggle text-decoration-none footer-tiny" href="javascript:;"
            data-toggle="dropdown">
            <i class="feather icon-globe"></i>
            @foreach ($languages as $language)
              @if ($language->abbreviation == config('app.locale'))
                {{ $language->name }}
              @endif
            @endforeach
          </a>

          <div class="dropdown-menu">
            @foreach ($languages as $language)
              <a @if ($language->abbreviation != config('app.locale')) href="{{ url('change/lang', $language->abbreviation) }}" @endif
                class="dropdown-item @if ($language->abbreviation == config('app.locale')) active text-white @endif mb-1">
                @if ($language->abbreviation == config('app.locale'))
                  <i class="fa fa-check mr-1"></i>
                @endif {{ $language->name }}
              </a>
            @endforeach
          </div>
        </li>
      </div><!-- dropup -->
    @endif
  </div>
</div>
