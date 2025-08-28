
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
      <form class="white flex w-[444px] flex-col gap-3 rounded-lg bg-white p-8" method="POST" action="{{ route('register') }}" id="formLoginRegister">
        <div class="alert alert-danger" id="errorRegister" style="display:none;">
          <ul id="showErrorsRegister"></ul>
        </div>
        @csrf

        <p class="m-0 text-xl font-bold text-black">{{ __('auth.sign_up') }}</p>

        <input type="text" class="focus:!border-branding h-[48px] w-full rounded-md border bg-[#F5F5F5] px-3 py-2" value="{{ old('name')}}" placeholder="{{__('auth.full_name')}}" name="name" required>
        <input type="text" class="focus:!border-branding h-[48px] w-full rounded-md border bg-[#F5F5F5] px-3 py-2" value="{{ old('email')}}" placeholder="{{__('auth.email')}}" name="email" required>
        <input type="password" class="focus:!border-branding h-[48px] w-full rounded-md border bg-[#F5F5F5] px-3 py-2" name="password" placeholder="{{__('auth.password')}}" required>

        <div class="flex items-center gap-2" style="margin-left: 10%;width: 90%;">
          <input class="custom-control-input" id="customCheckRegister" type="checkbox" name="agree_gdpr" required>
          <label class="custom-control-label text-xs" for="customCheckRegister">
            {{__('admin.i_agree_gdpr')}}
            <a class="!text-branding" href="{{$settings->link_terms}}" target="_blank">{{__('admin.terms_conditions')}}</a>
            {{ __('general.and') }}
            <a class="!text-branding" href="{{$settings->link_privacy}}" target="_blank">{{__('admin.privacy_policy')}}</a>
          </label>
        </div>

        @if ($settings->captcha == 'on')
          {!! NoCaptcha::displaySubmit('formLoginRegister', __('auth.sign_up'), [
              'data-size' => 'invisible',
              'id' => 'btnLoginRegister',
              'class' => 'gradient h-[48px] w-full !rounded-md font-bold text-white',
          ]) !!}

          {!! NoCaptcha::renderJs() !!}
        @else
          <button type="submit" id="btnLoginRegister" class="gradient h-[48px] w-full !rounded-md font-bold text-white">{{ __('auth.sign_up') }}</button>
        @endif

        @if ($settings->captcha == 'on')
          <small class="btn-block mt-3 text-center">{{ __('auth.protected_recaptcha') }} <a href="https://policies.google.com/privacy" target="_blank">{{ __('general.privacy') }}</a> - <a href="https://policies.google.com/terms" target="_blank">{{ __('general.terms') }}</a></small>
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
          <a href="{{ url('login') }}" class="!text-branding">{{ __('auth.already_have_an_account') }}</a>
        </div>

        @if ($settings->facebook_login == 'on' || $settings->google_login == 'on' || $settings->twitter_login == 'on')
          <div class="mt-3 flex border-t border-gray-100 pt-4 flex-col gap-2">
            @if ($settings->facebook_login == 'on')
              <a href="{{url('oauth/facebook')}}" class="flex h-[48px] w-full items-center justify-center gap-3 !rounded-md bg-[#1877f2] font-bold text-white">
                <i class="fab fa-facebook"></i> {{ __('auth.sign_up_with') }} Facebook
              </a>
            @endif
            @if ($settings->twitter_login == 'on')
              <a href="{{ url('oauth/twitter') }}" class="flex h-[48px] w-full items-center justify-center gap-3 !rounded-md bg-black font-bold text-white">
                <i class="bi-twitter-x"></i> {{ __('auth.sign_up_with') }} X
              </a>
            @endif
            @if ($settings->google_login == 'on')
              <a href="{{url('oauth/google')}}" class="flex h-[48px] w-full items-center justify-center gap-3 !rounded-md bg-white font-bold text-black border border-gray-200">
                <img src="{{ url('public/img/google.svg') }}" class="mr-2" width="18" height="18"> {{ __('auth.sign_up_with') }} Google
              </a>
            @endif
          </div>
        @endif

      </form>
    </div>
  </div>
  @include('index.home-footer')
@endsection

@section('javascript')
<script type="text/javascript">
$(document).ready(function() {
    $('#formLoginRegister').on('submit', function(e) {
        e.preventDefault();
        
        var btnSubmit = $('#btnLoginRegister');
        
        $('#errorRegister').hide();
        $('#showErrorsRegister').html('');
        
        btnSubmit.attr('disabled', true);
        btnSubmit.find('i').addClass('spinner-border spinner-border-sm align-middle mr-1');
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(response) {
                if (response.success) {
                    if (response.isLoginRegister) {
                        window.location.href = response.url_return;
                    } else {
                        swal({
                            title: "{{ trans('general.success') }}",
                            text: response.check_account,
                            type: "success",
                            confirmButtonText: "{{ trans('users.ok') }}"
                        });
                    }
                } else {
                    btnSubmit.removeAttr('disabled');
                    btnSubmit.find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
                    
                    $('#errorRegister').show();
                    
                    var errors = '';
                    
                    if (response.errors) {
                        for (var key in response.errors) {
                            errors += '<li><i class="fa fa-times-circle"></i> ' + response.errors[key] + '</li>';
                        }
                    } else {
                        errors = '<li><i class="fa fa-times-circle"></i> ' + '{{ __("auth.failed") }}' + '</li>';
                    }
                    
                    $('#showErrorsRegister').html(errors);
                }
            },
            error: function() {
                btnSubmit.removeAttr('disabled');
                btnSubmit.find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
                
                $('#errorRegister').show();
                $('#showErrorsRegister').html('<li><i class="fa fa-times-circle"></i> ' + '{{ __("auth.failed") }}' + '</li>');
            }
        });
    });
});
</script>
@endsection
