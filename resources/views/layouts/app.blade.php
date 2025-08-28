<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="robots" content="noindex, nofollow">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description"
    content="@yield('description_custom')@if (!Request::route()->named('seo') && !Request::route()->named('profile')) {{ trans('seo.description') }} @endif">
  <meta name="keywords" content="@yield('keywords_custom'){{ trans('seo.keywords') }}" />
  <meta name="theme-color"
    content="{{ auth()->check() && auth()->user()->dark_mode == 'on' ? '#303030' : $settings->color_default }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
  <style type="text/tailwindcss">
    @layer theme, base, components, utilities;

    @import "tailwindcss/theme.css" layer(theme);
    @import "tailwindcss/utilities.css" layer(utilities);

    @theme {
      --color-branding: #e7000b;
    }

    * {
      font-family: "Geist", sans-serif;
    }

    @layer components {
      .gradient {
        @apply bg-gradient-to-r from-red-600 to-[#F97316] !text-white;
      }

      .font-bold {
        font-weight: 700 !important;
      }

    }
  </style>

  <title>
  {{ auth()->check() && User::notificationsCount() ? '(' . User::notificationsCount() . ') ' : '' }}@section('title')@show
  {{ $settings->title . ' - ' . __('seo.slogan') }}</title>
<!-- Favicon -->
<link href="{{ url('public/img/favicon-1744025819.png') }}" rel="icon">
<link href="{{ url('public/img/favicon-1744025819.png') }}" rel="shortcut icon" type="image/png">
<link href="{{ url('public/img/favicon-1744025819.png') }}" rel="apple-touch-icon">

@if ($settings->google_tag_manager_head != '')
  {!! $settings->google_tag_manager_head !!}
@endif

@include('includes.css_general')

<link href="{{ asset('public/css/responsive.css') }}?v={{$settings->version}}" rel="stylesheet">

@if ($settings->status_pwa)
 
@endif

@yield('css')

@if ($settings->google_analytics != '')
  {!! $settings->google_analytics !!}
@endif
</head>

<body>
@if ($settings->google_tag_manager_body != '')
  {!! $settings->google_tag_manager_body !!}
@endif

@if ($settings->disable_banner_cookies == 'off')
  <div class="btn-block showBanner padding-top-10 display-none pb-3 text-center">
    <i class="fa fa-cookie-bite"></i> {{ trans('general.cookies_text') }}
    @if ($settings->link_cookies != '')
      <a href="{{ $settings->link_cookies }}" class="link-border mr-2 text-white"
        target="_blank">{{ trans('general.cookies_policy') }}</a>
    @endif
    <button class="btn btn-sm btn-primary" id="close-banner">{{ trans('general.go_it') }}
    </button>
  </div>
@endif

<div id="mobileMenuOverlay" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse"
  aria-expanded="false"></div>

@auth
  @if (!request()->is('messages/*') && !request()->is('live/*'))
    @include('includes.menu-mobile')
  @endif
@endauth

@if ($settings->alert_adult == 'on')
  <div class="modal fade" tabindex="-1" id="alertAdult">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body p-4">
          <p>{{ __('general.alert_content_adult') }}</p>
        </div>
        <div class="modal-footer border-0 pt-0">
          <a href="https://google.com" class="btn e-none mr-3 p-0">{{ trans('general.leave') }}</a>
          <button type="button" class="btn btn-primary" id="btnAlertAdult">{{ trans('general.i_am_age') }}</button>
        </div>
      </div>
    </div>
  </div>
@endif


<div class="popout popout-error font-default"></div>

@if (
    !request()->is(['register', 'signup']) &&
    (
        (auth()->guest() && request()->path() == '/' && $settings->home_style == 0) ||
        (auth()->guest() && request()->path() != '/' && $settings->home_style == 0) ||
        (auth()->guest() && request()->path() != '/' && $settings->home_style == 1) ||
        (auth()->guest() && request()->path() == '/' && $settings->home_style == 2) ||
        (auth()->guest() && request()->path() != '/' && $settings->home_style == 2) ||
        auth()->check()
    )
)
  @include('includes.navbar')
@endif

<main class="w-full" @if (request()->is('messages/*') || request()->is('live/*')) class="h-100" @endif role="main">
  @yield('content')

  @if (
    !request()->is(['register', 'signup']) &&
    (
        (auth()->guest() &&
            !request()->route()->named('profile') &&
            !request()->is(['creators', 'category/*', 'creators/*'])) ||
        (auth()->check() &&
            request()->path() != '/' &&
            !request()->route()->named('profile') &&
            !request()->is([
                'my/bookmarks',
                'my/likes',
                'my/purchases',
                'explore',
                'messages',
                'messages/*',
                'creators',
                'category/*',
                'creators/*',
                'live/*',
            ]))
    )
)

    @if (
        (auth()->guest() && request()->path() == '/' && $settings->home_style == 0) ||
            (auth()->guest() && request()->path() != '/' && $settings->home_style == 0) ||
            (auth()->guest() && request()->path() != '/' && $settings->home_style == 1) ||
            (auth()->guest() && request()->path() != '/' && $settings->home_style == 2) ||
            auth()->check())

      @if (auth()->guest() && $settings->who_can_see_content == 'users')
        <div class="px-3 py-3 text-center">
          @include('includes.footer-tiny')
        </div>
      @else
        @include('includes.footer')
      @endif

    @endif

  @endif

  @guest

    @if (Helper::showLoginFormModal())
      @include('includes.modal-login')
    @endif

  @endguest

  @auth

    @if ($settings->disable_tips == 'off')
      @include('includes.modal-tip')
    @endif

    @if ($settings->gifts)
      @include('includes.modal-gifts')
    @endif

    @include('includes.modal-payperview')

    @if ($settings->live_streaming_status == 'on')
      @include('includes.modal-live-stream')
    @endif

    @if ($settings->allow_scheduled_posts)
      @include('includes.modal-scheduled-posts')
    @endif

  @endauth

  @guest
    @include('includes.modal-2fa')
  @endguest
  
  <!-- Modal de Parcerias (incluído globalmente) -->
  @include('includes.parceria-modal')
</main>

@include('includes.javascript_general')

@yield('javascript')

@auth
  <div id="bodyContainer"></div>
@endauth

<!-- Desabilita dir button -->
<script>
  document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
    return false;
  }, true);
</script>

<!-- Desabilita prtscn nb comp -->
<script>
  function triggerOverlay() {
    // Verifica se o overlay já foi criado
    if (!document.getElementById('printscreen-overlay')) {
      var overlay = document.createElement('div');
      overlay.id = 'printscreen-overlay';
      overlay.style.position = 'fixed';
      overlay.style.top = '0';
      overlay.style.left = '0';
      overlay.style.width = '100%';
      overlay.style.height = '100%';
      overlay.style.backgroundColor = 'black';
      overlay.style.opacity = '0.9999'; // 99,99% preto
      overlay.style.zIndex = '99999';

      // Cria o elemento de texto centralizado
      var overlayText = document.createElement('div');
      overlayText.innerText =
        "Captura desabilitada! Os direitos autorais dos criadores não permitem a captura de telas por print-screen.";
      overlayText.style.position = 'absolute';
      overlayText.style.top = '50%';
      overlayText.style.left = '50%';
      overlayText.style.transform = 'translate(-50%, -50%)';
      overlayText.style.color = 'white';
      overlayText.style.fontSize = '24px';
      overlayText.style.textAlign = 'center';
      overlayText.style.fontFamily = 'Arial, sans-serif';
      overlay.appendChild(overlayText);

      document.body.appendChild(overlay);

      // Mantém o overlay por 3 segundos (3000 ms)
      setTimeout(function() {
        if (overlay.parentNode) {
          overlay.parentNode.removeChild(overlay);
        }
      }, 10000);
    }
  }

  function detectPrintScreen(e) {
    // Verifica se a tecla pressionada é PrintScreen (key pode ser "PrintScreen" ou keyCode 44)
    if (e.key === "PrintScreen" || e.keyCode === 44) {
      triggerOverlay();
    }
  }

  // Adiciona o listener para diversos eventos e contextos
  document.addEventListener('keydown', detectPrintScreen);
  document.addEventListener('keyup', detectPrintScreen);
  window.addEventListener('keydown', detectPrintScreen);
  window.addEventListener('keyup', detectPrintScreen);
</script>

<!-- Script para inicialização dos modais -->
<script>
// Função para abrir o modal de parcerias
function openParceriaModal() {
  var modalElement = document.getElementById('parceriaModal');
  if (modalElement) {
    var modal = new bootstrap.Modal(modalElement);
    modal.show();
  }
}
</script>

</body>

</html>
