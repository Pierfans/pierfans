@extends('layouts.app')

@section('content')
  <div class="grid w-full grid-cols-1 md:min-h-[1024px] md:grid-cols-2">
    <div class="gradient flex flex-col items-center justify-center">
      <div class="flex w-full flex-col items-start gap-4 p-4 md:w-[486px]">
        <img src="{{ url('public/img/logo.svg') }}" height="56px" />
        <p class="font-bold text-white md:text-4xl">
          {{ __('auth.auth_cta') }}
        </p>
      </div>
    </div>


    <div class="flex items-center justify-center bg-[#F5F5F5]">
      <form class="white flex w-[444px] flex-col gap-3 rounded-lg bg-white p-8" method="POST" action="{{ route('login') }}"
        data-url-login="{{ route('login') }}" data-url-register="{{ route('register') }}" id="formLoginRegister"
        enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="return" value="{{ count($errors) > 0 ? old('return') : url()->previous() }}">

        <p class="m-0 text-xl font-bold text-black">{{ __('auth.do_login') }}</p>
        <input type="text" class="focus:!border-branding h-[48px] w-full rounded-md border bg-[#F5F5F5] px-3 py-2"
          value="{{ old('email') }}" placeholder="{{ __('auth.email') }}" name="username_email">
        <input type="password" class="focus:!border-branding h-[48px] w-full rounded-md border bg-[#F5F5F5] px-3 py-2"
          name="password" placeholder="{{ __('auth.password') }}">

        @if ($settings->captcha == 'on')
          {!! NoCaptcha::displaySubmit('formLoginRegister', __('auth.login'), [
              'data-size' => 'invisible',
              'id' => 'btnLoginRegister',
              'class' => 'gradient h-[48px] w-full !rounded-md font-bold text-white',
          ]) !!}

          {!! NoCaptcha::renderJs() !!}
        @else
          <button type="submit" id="btnLoginRegister"
            class="gradient h-[48px] w-full !rounded-md font-bold text-white">{{ __('auth.login') }}</button>
        @endif



        @if ($settings->captcha == 'on')
          <small class="btn-block mt-3 text-center">{{ __('auth.protected_recaptcha') }} <a
              href="https://policies.google.com/privacy" target="_blank">{{ __('general.privacy') }}</a> - <a
              href="https://policies.google.com/terms" target="_blank">{{ __('general.terms') }}</a></small>
        @endif

        <p class="text-center text-sm">
          {{ __('auth.auth_terms_1') }}
          <a class="!text-branding" target="__blank" href="{{ $settings->link_terms }}">
            {{ __('auth.terms_of_service') }}
          </a>
          {{ __('auth.e') }}
          <a class="!text-branding" target="__blank" href="{{ $settings->link_privacy }}">
            {{ __('auth.privacy_policy') }}
          </a>
          {{ __('auth.auth_terms_2') }}
        </p>

        <div class="flex justify-center gap-3">
          <a href="{{ url('password/reset') }}" class="!text-branding">
            {{ __('auth.forgot_password') }}
          </a>
          <a href="{{ url('register') }}" class="!text-branding">{{ __('auth.not_have_account') }}</a>
        </div>

        @if ($settings->twitter_login == 'on')
          <div class="mt-3 flex border-t border-gray-100 pt-4">
            <a href="{{ url('oauth/x') }}"
              class="flex h-[48px] w-full items-center justify-center gap-3 !rounded-md bg-black font-bold text-white">
              <i class="bi-twitter-x"></i> {{ __('auth.login_with') }} Twitter
            </a>
          </div>
        @endif
      </form>
    </div>
  </div>
  @include('index.home-highlights')
  @include('index.home-footer')
@endsection
