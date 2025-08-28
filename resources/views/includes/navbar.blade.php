<header>
  <navbar class="flex h-[65px] w-full bg-white py-3 shadow-md">
    <div class="container flex gap-4">
      <a href="{{ url('/') }}" class="flex"><img src="{{ url('public/img/logo_gradient.svg') }}" /></a>

      {{-- A barra de pesquisa foi removida daqui --}}
      
      
      <div class="flex-1"></div> {{-- Adicionado para empurrar os ícones para a direita --}}

      <div class="flex items-center">
        <a href="{{ url('creators') }}" class="flex h-full items-center p-2">
          <svg xmlns="http://www.w3.org/2000/svg" height="20px" fill="none" viewBox="0 0 20 21">
            <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
              d="M1.667 17.623a6.667 6.667 0 0 1 8.695-6.35m7.971 7.184-1.583-1.584M12.5 6.79a4.167 4.167 0 1 1-8.333 0 4.167 4.167 0 0 1 8.333 0Zm5 8.334a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
          </svg>
        </a>
        <a href="{{ url('notifications') }}" class="flex h-full items-center p-2">
          <svg xmlns="http://www.w3.org/2000/svg" height="20px" fill="none" viewBox="0 0 20 21">
            <path stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round"
              d="M8 17.123c.5.5 1 1 2 1s1.5-.5 2-1m-7-3h10c-.833-1-1.667-3-1.667-6 0-2.5-1.5-4.167-3.333-4.167s-3.333 1.667-3.333 4.167c0 3-.834 5-1.667 6Z" />
          </svg>
        </a>
        <a href="{{ url('messages') }}" class="flex h-full items-center p-2">
          <svg height="20px" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M18.2117 1.91262L9.09504 11.0285M12.1134 18.1951C12.145 18.274 12.2001 18.3414 12.2711 18.3881C12.3421 18.4348 12.4258 18.4587 12.5107 18.4565C12.5957 18.4543 12.678 18.4262 12.7466 18.3759C12.8151 18.3256 12.8666 18.2555 12.8942 18.1751L18.3109 2.34179C18.3375 2.26795 18.3426 2.18804 18.3255 2.11142C18.3085 2.03479 18.2699 1.96462 18.2144 1.9091C18.1589 1.85359 18.0887 1.81504 18.0121 1.79795C17.9355 1.78086 17.8555 1.78595 17.7817 1.81262L1.94837 7.22929C1.86795 7.25687 1.7979 7.30839 1.7476 7.37693C1.69731 7.44548 1.66918 7.52777 1.66701 7.61276C1.66483 7.69775 1.6887 7.78137 1.73542 7.8524C1.78214 7.92343 1.84947 7.97846 1.92837 8.01012L8.53671 10.6601C8.74561 10.7438 8.93542 10.8688 9.09468 11.0278C9.25394 11.1868 9.37936 11.3764 9.46338 11.5851L12.1134 18.1951Z"
              stroke="#6B7280" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>
      </div>

      <div class="relative">
        <a href="#" id="nav-inner-success_dropdown_1" role="button" data-toggle="dropdown"
          class="flex items-center gap-2 avatar-menu-link">
          @if(auth()->check())
            <img src="{{ Helper::getFile(config('path.avatar') . auth()->user()->avatar) }}" alt="User"
              class="rounded-circle avatarUser mr-1" width="32" height="32">
            <p class="m-0 text-sm font-bold avatar-username">{{ auth()->user()->first_name }}</p>
            <i class="feather icon-chevron-down m-0 align-middle avatar-dropdown-icon"></i>
          @endif
        </a>

        <div class="dropdown-menu dropdown-menu-right dd-menu-user mb-1" aria-labelledby="nav-inner-success_dropdown_1">
          @if(auth()->check())
            @if (auth()->user()->role == 'admin')
              <a class="dropdown-item dropdown-navbar" href="{{ url('panel/admin') }}"><i
                  class="bi bi-speedometer2 mr-2"></i> {{ __('admin.admin') }}</a>
              <div class="dropdown-divider"></div>
            @endif

            @if (auth()->user()->verified_id == 'yes')
              <span class="dropdown-item dropdown-navbar balance">
                <i class="iconmoon icon-Dollar mr-2"></i> {{ __('general.balance') }}:
                {{ Helper::amountFormatDecimal(auth()->user()->balance) }}
              </span>
            @endif

            @if (($settings->disable_wallet == 'on' && auth()->user()->wallet != 0.0) || $settings->disable_wallet == 'off')
              @if ($settings->disable_wallet == 'off')
                <a class="dropdown-item dropdown-navbar" href="{{ url('my/wallet') }}">
                  <i class="iconmoon icon-Wallet mr-2"></i> {{ __('general.wallet') }}:
                  <span class="balanceWallet">{{ Helper::userWallet() }}</span>
                </a>
              @else
                <span class="dropdown-item dropdown-navbar balance">
                  <i class="iconmoon icon-Wallet mr-2"></i> {{ __('general.wallet') }}:
                  <span class="balanceWallet">{{ Helper::userWallet() }}</span>
                </span>
              @endif

              <div class="dropdown-divider"></div>
            @endif

            @if ($settings->disable_wallet == 'on' && auth()->user()->verified_id == 'yes')
              <div class="dropdown-divider"></div>
            @endif

            <a class="dropdown-item dropdown-navbar url-user" href="{{ url(auth()->User()->username) }}"><i
                class="feather icon-user mr-2"></i>
              {{ auth()->user()->verified_id == 'yes' ? __('general.my_page') : __('users.my_profile') }}</a>
            @if (auth()->user()->verified_id == 'yes')
              <a class="dropdown-item dropdown-navbar" href="{{ url('dashboard') }}"><i
                  class="bi bi-speedometer2 mr-2"></i> {{ __('admin.dashboard') }}</a>
              <a class="dropdown-item dropdown-navbar" href="{{ url('my/posts') }}"><i
                  class="feather icon-feather mr-2"></i> {{ __('general.my_posts') }}</a>
            @endif

            <div class="dropdown-divider"></div>
            @if (auth()->user()->verified_id == 'yes')
              <a class="dropdown-item dropdown-navbar" href="{{ url('my/subscribers') }}"><i
                  class="feather icon-users mr-2"></i> {{ __('users.my_subscribers') }}</a>
            @endif
            <a class="dropdown-item dropdown-navbar" href="{{ url('my/subscriptions') }}"><i
                class="feather icon-user-check mr-2"></i> {{ __('users.my_subscriptions') }}</a>
            <a class="dropdown-item dropdown-navbar" href="{{ url('my/bookmarks') }}"><i
                class="feather icon-bookmark mr-2"></i> {{ __('general.bookmarks') }}</a>
            <a class="dropdown-item dropdown-navbar" href="{{ url('my/likes') }}"><i class="feather icon-heart mr-2"></i>
              {{ __('general.likes') }}</a>

            @if (auth()->user()->verified_id == 'no' &&
                    auth()->user()->verified_id != 'reject' &&
                    $settings->requests_verify_account == 'on')
              <div class="dropdown-divider"></div>
              <a class="dropdown-item dropdown-navbar" href="{{ url('settings/verify/account') }}"><i
                  class="bi bi-star mr-2"></i> {{ __('general.become_creator') }}</a>
            @endif

            <div class="dropdown-divider dropdown-navbar"></div>
            <a class="dropdown-item dropdown-navbar" href="{{ url('logout') }}"><i
                class="feather icon-log-out mr-2"></i> {{ __('auth.logout') }}</a>
          @endif
        </div>
      </div>
    </div>
  </navbar>
</header>
