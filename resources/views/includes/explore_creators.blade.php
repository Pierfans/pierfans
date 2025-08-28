<div class="hidden md:flex flex-col gap-6">
  <div class="flex flex-col gap-3 rounded-lg border-slate-50 p-3 shadow-sm">
    <div class="flex items-center gap-3">
      <p class="m-0 flex flex-1 font-bold">{{ __('general.explore_creators') }}</p>

      {{-- Display only free --}}
      <a href="#" class="refresh_creators toggleFindFreeCreators flex h-full items-center p-2">
        <svg xmlns="http://www.w3.org/2000/svg" height="16px" fill="none" viewBox="0 0 16 16">
          <g stroke="#1F2937" stroke-linecap="round" stroke-linejoin="round" clip-path="url(#a)">
            <path
              d="M8.39 1.724a1.33 1.33 0 0 0-.942-.39H2.667a1.333 1.333 0 0 0-1.334 1.333v4.781c0 .354.141.693.391.943l5.803 5.802a1.617 1.617 0 0 0 2.28 0l4.386-4.386a1.617 1.617 0 0 0 0-2.28L8.391 1.724Z" />
            <path d="M5 5.333a.333.333 0 1 0 0-.666.333.333 0 0 0 0 .666Z" />
          </g>
          <defs>
            <clipPath id="a">
              <path fill="#fff" d="M0 0h16v16H0z" />
            </clipPath>
          </defs>
        </svg>
      </a>

      {{-- Refresh creators --}}
      <a href="#" class="refresh_creators flex h-full items-center rounded-lg !bg-gray-300 p-2">
        <svg xmlns="http://www.w3.org/2000/svg" height="16px" fill="none" viewBox="0 0 16 16">
          <path stroke="#1F2937" stroke-linecap="round" stroke-linejoin="round"
            d="M14 8a6 6 0 0 0-6-6 6.5 6.5 0 0 0-4.493 1.827L2 5.333m0 0V2m0 3.333h3.333M2 8a6 6 0 0 0 6 6 6.5 6.5 0 0 0 4.493-1.827L14 10.667m0 0h-3.333m3.333 0V14" />
        </svg>
      </a>
    </div>

    <div class="containerRefreshCreators flex flex-col gap-3">
      @include('includes.listing-explore-creators')
    </div>
  </div>

  <!-- As seções de Programa de Afiliados, Parcerias e Token PYX foram movidas para o menu hamburger mobile -->
</div>
