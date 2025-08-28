<!-- Menu lateral oculto em dispositivos móveis (d-none) e visível em telas médias e maiores (d-md-block) -->
<div class="flex flex-col gap-6 d-none d-md-block">
  <ul class="m-0 h-auto !rounded-lg border !border-slate-50 bg-white p-3 shadow-sm">
    <li>
      <a href="{{ url('/') }}"
        class="@if (request()->is('/')) gradient @endif flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium">
        <svg xmlns="http://www.w3.org/2000/svg" height="20px" fill="none" viewBox="0 0 20 20">
          <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
            d="M12.5 17.5v-6.667a.833.833 0 0 0-.833-.833H8.333a.833.833 0 0 0-.833.833V17.5m-5-9.167a1.667 1.667 0 0 1 .59-1.273l5.834-5a1.667 1.667 0 0 1 2.152 0l5.833 5a1.668 1.668 0 0 1 .591 1.273v7.5a1.666 1.666 0 0 1-1.667 1.667H4.167A1.667 1.667 0 0 1 2.5 15.833v-7.5Z" />
        </svg>
        <span class="ml-2">{{ trans('admin.home') }}</span>
      </a>
    </li>

    @auth
      <li>
        <a class="flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium"
          href="{{ url(auth()->user()->username) }}">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="20px" viewBox="0 0 20 20">
            <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
              d="M10 10.833A4.167 4.167 0 1 0 10 2.5a4.167 4.167 0 0 0 0 8.333Zm0 0a6.667 6.667 0 0 1 6.667 6.667M10 10.833A6.667 6.667 0 0 0 3.333 17.5" />
          </svg>
          <span
            class="ml-2">{{ auth()->user()->verified_id == 'yes' ? trans('general.my_page') : trans('users.my_profile') }}</span>
        </a>
      </li>
      @if (auth()->user()->verified_id == 'yes')
        <li>
          <a class="flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium" href="{{ url('dashboard') }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="20px" viewBox="0 0 32 32">
              <path stroke="#1F2937" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9.333 14.667V9.333a6.666 6.666 0 1 1 13.334 0v5.334m-16 0h18.666A2.667 2.667 0 0 1 28 17.333v9.334a2.667 2.667 0 0 1-2.667 2.666H6.667A2.667 2.667 0 0 1 4 26.667v-9.334a2.667 2.667 0 0 1 2.667-2.666Z" />
            </svg>
            <span class="ml-2">{{ trans('admin.dashboard') }}</span>
          </a>
        </li>
      @endif
      <li>
        <a href="{{ url('my/purchases') }}"
          class="@if (request()->is('my/purchases')) active @endif flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium">
          <svg height="20px" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M13.3333 8.33334C13.3333 9.21739 12.9821 10.0652 12.357 10.6904C11.7319 11.3155 10.8841 11.6667 10 11.6667C9.11594 11.6667 8.2681 11.3155 7.64298 10.6904C7.01786 10.0652 6.66667 9.21739 6.66667 8.33334M2.58583 5.02834H17.4142M2.83333 4.55584C2.61696 4.84433 2.5 5.19522 2.5 5.55584V16.6667C2.5 17.1087 2.67559 17.5326 2.98816 17.8452C3.30072 18.1577 3.72464 18.3333 4.16667 18.3333H15.8333C16.2754 18.3333 16.6993 18.1577 17.0118 17.8452C17.3244 17.5326 17.5 17.1087 17.5 16.6667V5.55584C17.5 5.19522 17.383 4.84433 17.1667 4.55584L15.5 2.33334C15.3448 2.12634 15.1434 1.95834 14.912 1.84263C14.6806 1.72691 14.4254 1.66667 14.1667 1.66667H5.83333C5.57459 1.66667 5.3194 1.72691 5.08798 1.84263C4.85655 1.95834 4.65525 2.12634 4.5 2.33334L2.83333 4.55584Z"
              stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round" />
          </svg>

          <span class="ml-2">{{ trans('general.purchased') }}</span>
        </a>
      </li>
      <li>
        <a class="flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium" href="{{ url('messages') }}">
          <svg xmlns="http://www.w3.org/2000/svg" height="20px" fill="none" viewBox="0 0 20 20">
            <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
              d="M6.583 16.667a7.5 7.5 0 1 0-3.25-3.25l-1.666 4.916 4.916-1.666Z" />
          </svg>
          <span class="ml-2">{{ trans('general.messages') }}</span>
        </a>
      </li>
      @if (!$settings->disable_explore_section)
        <li>
          <a href="{{ url('explore') }}"
            class="@if (request()->is('explore')) active @endif flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="20px" viewBox="0 0 20 20">
              <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
                d="M1.667 17.5a6.667 6.667 0 0 1 8.695-6.35m7.971 7.183L16.75 16.75M12.5 6.667a4.167 4.167 0 1 1-8.333 0 4.167 4.167 0 0 1 8.333 0Zm5 8.333a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
            </svg>
            <span class="ml-2">{{ trans('general.explore') }}</span>
          </a>
        </li>
      @endif

      @if (!$settings->disable_parceria_section)
          <li>
              <a href="{{ url('parceria') }}"
                 class="@if (request()->is('parceria')) active @endif flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="20px" viewBox="0 0 20 20">
                      <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
                            d="M1.667 17.5a6.667 6.667 0 0 1 8.695-6.35m7.971 7.183L16.75 16.75M12.5 6.667a4.167 4.167 0 1 1-8.333 0 4.167 4.167 0 0 1 8.333 0Zm5 8.333a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                  </svg>
                  <span class="ml-2">{{ trans('Parceria') }}</span>
              </a>
          </li>
      @endif

      <li>
        <a href="{{ url('my/subscriptions') }}" class="flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="20px" viewBox="0 0 20 20">
            <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
              d="M1.667 17.5a6.667 6.667 0 0 1 11.076-5m3.09.833v5m2.5-2.5h-5M12.5 6.667a4.167 4.167 0 1 1-8.333 0 4.167 4.167 0 0 1 8.333 0Z" />
          </svg>
          <span class="ml-2">{{ trans('admin.subscriptions') }}</span>
        </a>
      </li>
      <li>
        <a href="{{ url('my/bookmarks') }}"
          class="@if (request()->is('my/bookmarks')) active @endif flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium">
          <svg height="20px" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M9.60416 1.91249C9.64068 1.83871 9.6971 1.7766 9.76704 1.73318C9.83698 1.68976 9.91767 1.66675 9.99999 1.66675C10.0823 1.66675 10.163 1.68976 10.233 1.73318C10.3029 1.7766 10.3593 1.83871 10.3958 1.91249L12.3208 5.81166C12.4476 6.0683 12.6348 6.29033 12.8663 6.4587C13.0979 6.62707 13.3668 6.73675 13.65 6.77833L17.955 7.40833C18.0366 7.42014 18.1132 7.45455 18.1762 7.50766C18.2393 7.56076 18.2862 7.63045 18.3117 7.70883C18.3372 7.78721 18.3402 7.87117 18.3205 7.95119C18.3007 8.03121 18.259 8.10412 18.2 8.16166L15.0867 11.1933C14.8813 11.3934 14.7277 11.6404 14.639 11.913C14.5503 12.1856 14.5292 12.4757 14.5775 12.7583L15.3125 17.0417C15.3269 17.1232 15.3181 17.2071 15.2871 17.2839C15.2561 17.3607 15.2041 17.4272 15.1371 17.4758C15.0701 17.5245 14.9908 17.5533 14.9082 17.5591C14.8256 17.5648 14.7431 17.5472 14.67 17.5083L10.8217 15.485C10.5681 15.3518 10.286 15.2823 9.99958 15.2823C9.71318 15.2823 9.43106 15.3518 9.17749 15.485L5.32999 17.5083C5.25694 17.547 5.17449 17.5644 5.09204 17.5585C5.00958 17.5527 4.93043 17.5238 4.86357 17.4752C4.79672 17.4266 4.74485 17.3601 4.71387 17.2835C4.68289 17.2069 4.67404 17.1231 4.68833 17.0417L5.42249 12.7592C5.47099 12.4764 5.44998 12.1862 5.36128 11.9134C5.27257 11.6406 5.11883 11.3935 4.91333 11.1933L1.79999 8.16249C1.74049 8.10502 1.69832 8.03199 1.6783 7.95172C1.65827 7.87145 1.66119 7.78717 1.68673 7.70849C1.71226 7.6298 1.75938 7.55986 1.82272 7.50665C1.88607 7.45343 1.96308 7.41908 2.04499 7.40749L6.34916 6.77833C6.63271 6.73708 6.90199 6.62754 7.13381 6.45915C7.36564 6.29076 7.55308 6.06855 7.67999 5.81166L9.60416 1.91249Z"
              stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round" />
          </svg>

          <span class="ml-2">{{ trans('general.bookmarks') }}</span>
        </a>
      </li>
    @else
      <li>
        <a class="flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium" href="{{ url('creators') }}">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" height="20px" viewBox="0 0 20 20">
            <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
              d="M1.667 17.5a6.667 6.667 0 0 1 8.695-6.35m7.971 7.183L16.75 16.75M12.5 6.667a4.167 4.167 0 1 1-8.333 0 4.167 4.167 0 0 1 8.333 0Zm5 8.333a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
          </svg>
          <span class="ml-2">{{ trans('general.explore') }}</span>
        </a>
      </li>

      @if ($settings->shop)
        <li>
          <a class="flex w-full items-center gap-2 rounded-xl px-4 py-2 font-medium" href="{{ url('shop') }}">
            <svg height="20px" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M13.3333 8.33334C13.3333 9.21739 12.9821 10.0652 12.357 10.6904C11.7319 11.3155 10.8841 11.6667 10 11.6667C9.11594 11.6667 8.2681 11.3155 7.64298 10.6904C7.01786 10.0652 6.66667 9.21739 6.66667 8.33334M2.58583 5.02834H17.4142M2.83333 4.55584C2.61696 4.84433 2.5 5.19522 2.5 5.55584V16.6667C2.5 17.1087 2.67559 17.5326 2.98816 17.8452C3.30072 18.1577 3.72464 18.3333 4.16667 18.3333H15.8333C16.2754 18.3333 16.6993 18.1577 17.0118 17.8452C17.3244 17.5326 17.5 17.1087 17.5 16.6667V5.55584C17.5 5.19522 17.383 4.84433 17.1667 4.55584L15.5 2.33334C15.3448 2.12634 15.1434 1.95834 14.912 1.84263C14.6806 1.72691 14.4254 1.66667 14.1667 1.66667H5.83333C5.57459 1.66667 5.3194 1.72691 5.08798 1.84263C4.85655 1.95834 4.65525 2.12634 4.5 2.33334L2.83333 4.55584Z"
                stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <span class="ml-2">{{ trans('general.shop') }}</span>
          </a>
        </li>
      @endif

    @endauth
  </ul>

  <!-- Seção do Programa de Afiliados -->
  <div class="flex h-auto flex-col items-center gap-3 !rounded-lg border !border-green-300 bg-green-50 p-3 shadow-sm mb-6">
    <div class="gradient flex justify-center self-center rounded-full p-3">
      <i class="feather icon-users text-white" style="font-size: 20px;"></i>
    </div>

    <p class="m-0 font-bold">Programa de Afiliados</p>
    <p class="m-0 text-center">Seja um afiliado com seu link de referência e ganhe 5% de comissão!</p>

    <button id="copyAffiliateLinkDesktop" type="button" class="gradient h-[48px] w-full !rounded-md font-bold text-white flex items-center justify-center">
      <span>Copiar link de afiliado</span>
      <i class="feather icon-copy ml-2"></i>
    </button>
  </div>

  <!-- Seção de Parcerias -->
  <div class="flex h-auto flex-col items-center gap-3 !rounded-lg border !border-red-300 bg-red-100 p-3 shadow-sm mb-6">
    <div class="gradient flex justify-center self-center rounded-full p-3">
      <svg height="20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
          d="M10 4.167c1.25-1.25 2.283-1.667 3.75-1.667a4.583 4.583 0 0 1 4.583 4.583c0 1.909-1.258 3.367-2.5 4.584L10 17.5l-5.833-5.833c-1.25-1.209-2.5-2.667-2.5-4.584A4.583 4.583 0 0 1 6.25 2.5c1.467 0 2.5.417 3.75 1.667Zm0 0L7.533 6.633a1.809 1.809 0 0 0 0 2.567 1.813 1.813 0 0 0 2.5.058l1.725-1.583a2.35 2.35 0 0 1 3.159 0l2.466 2.217M15 12.5l-1.667-1.667M12.5 15l-1.667-1.667" />
      </svg>
    </div>

    <p class="m-0 font-bold">Parcerias</p>
    <p class="m-0 text-center">Troque Divulgação com Outros Criadores</p>

    <button type="button" class="gradient h-[48px] w-full !rounded-md font-bold text-white flex items-center justify-center" onclick="openParceriaModal()" title="Fazer Parceria">
      Fazer Parceria
    </button>
  </div>

  <div
    class="flex h-auto flex-col items-center gap-3 !rounded-lg border !border-yellow-400 bg-yellow-50 p-3 shadow-sm">
    <div class="flex justify-center self-center rounded-full bg-orange-300 p-3">
      <svg height="20px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
        <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
          d="M15.075 8.642a4.999 4.999 0 0 1-.385 9.496A5 5 0 0 1 8.617 15M5.833 5h.834v3.333m7.258 3.234.583.591-2.35 2.35m-.491-7.841a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z" />
      </svg>
    </div>

    <p class="m-0 font-bold">Token PYX</p>
    <p class="m-0 text-center">Compre nosso token PYX e desbloqueie horas extras de conteúdo ou fotos exclusivas!</p>

    <button class="h-[48px] w-full !rounded-md bg-orange-300 font-bold text-white" onclick="window.open('https://paylix.co/', '_blank')">Comprar Token PYX</button>
  </div>

</div>
