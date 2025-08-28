<script src="{{ asset('public/js/core.min.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/js/jqueryTimeago_'.Lang::locale().'.js') }}"></script>
<script src="{{ asset('public/js/lazysizes.min.js') }}" async=""></script>
<script src="{{ asset('public/js/plyr/plyr.min.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/plyr/plyr.polyfilled.min.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/app-functions.js') }}?v={{$settings->version}}"></script>

@if (! request()->is('live/*'))
<script src="{{ asset('public/js/install-app.js') }}?v={{$settings->version}}"></script>
@endif

@auth
  <script src="{{ asset('public/js/fileuploader/jquery.fileuploader.min.js') }}"></script>
  <script src="{{ asset('public/js/fileuploader/fileuploader-post.js') }}?v={{$settings->version}}"></script>
  <script src="{{ asset('public/js/jquery-ui/jquery-ui.min.js') }}"></script>
  @if (request()->path() == '/' 
  		&& auth()->user()->verified_id == 'yes' 
		|| request()->route()->named('profile') 
		&& request()->path() == auth()->user()->username  
		&& auth()->user()->verified_id == 'yes'
		)
  <script src="{{ asset('public/js/jquery-ui/mentions.js') }}"></script>
@endif

@if ($settings->story_status)
<script src="{{ asset('public/js/story/zuck.min.js') }}?v={{$settings->version}}"></script>
@endif

<script src="https://js.stripe.com/v3/"></script>
<script src='https://checkout.razorpay.com/v1/checkout.js'></script>
<script src='https://js.paystack.co/v1/inline.js'></script>
@if (request()->is('my/wallet'))
<script src="{{ asset('public/js/add-funds.js') }}?v={{$settings->version}}"></script>
@else
<script src="{{ asset('public/js/payment.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/payments-ppv.js') }}?v={{$settings->version}}"></script>
@endif
<script src="{{ asset('public/js/send-gift.js') }}?v={{$settings->version}}"></script>
@endauth

@if ($settings->custom_js)
  <script type="text/javascript">
  {!! $settings->custom_js !!}
  </script>
@endif

<script type="text/javascript">
// Fix for mobile menu buttons that disappear after click
$(document).ready(function() {
  $('.btn-menu-expand').on('click', function(e) {
    e.preventDefault();
    var target = $(this).data('target');
    if ($(target).hasClass('show')) {
      $(target).removeClass('show');
      $(this).find('i').removeClass('fa-chevron-up').addClass('fa-bars');
    } else {
      $(target).addClass('show');
      $(this).find('i').removeClass('fa-bars').addClass('fa-chevron-up');
    }
  });
});

const lightbox = GLightbox({
    touchNavigation: true,
    loop: true,
    closeEffect: 'fade',
    swipeToClose: false,
    preload: true
});

@auth
$('.btnMultipleUpload').on('click', function() {
  $('.fileuploader').toggleClass('d-block');
});

	@if (request()->route()->named('post.edit') && $preloadedFile)
	$(document).ready(function() {
		$('.fileuploader').addClass('d-block');
	});
	@endif

@endauth
</script>

@if (auth()->guest()
    && ! request()->is('password/reset')
    && ! request()->is('password/reset/*')
    && ! request()->is('contact')
    )
<script type="text/javascript">
	//<---------------- Login Register ----------->>>>
	onSubmitformLoginRegister = function() {
		  sendFormLoginRegister();
		}

	if (! captcha) {
	    $(document).on('click','#btnLoginRegister',function(s) {
 		 s.preventDefault();
		 sendFormLoginRegister();
 	 });//<<<-------- * END FUNCTION CLICK * ---->>>>
	}

	function sendFormLoginRegister() {
		var element = $(this);
		$('#btnLoginRegister').attr({'disabled' : 'true'});
		$('#btnLoginRegister').find('i').addClass('spinner-border spinner-border-sm align-middle mr-1');

		(function(){
			 $("#formLoginRegister").ajaxForm({
			 dataType : 'json',
			 success:  function(result) {

         if (result.actionRequired) {
           $('#modal2fa').modal({
    				    backdrop: 'static',
    				    keyboard: false,
    						show: true
    				});

            $('#loginFormModal').modal('hide');
           return false;
         }

				 // Success
				 if (result.success) {

           if (result.isModal && result.isLoginRegister) {
             window.location.reload();
           }

					 if (result.url_return && ! result.isModal) {
					 	window.location.href = result.url_return;
					 }

					 if (result.check_account) {
					 	// Exibir no elemento original
					 	$('#checkAccount').html(result.check_account).fadeIn(500);

						// Criar uma notificação flutuante
						var notification = $('<div class="alert alert-success notification-floating">' + result.check_account + '</div>');
						$('body').append(notification);
						
						// Posicionar e animar a notificação
						notification.css({
							'position': 'fixed',
							'top': '20px',
							'right': '20px',
							'z-index': '9999',
							'max-width': '400px',
							'box-shadow': '0 4px 8px rgba(0,0,0,0.2)',
							'display': 'none'
						}).fadeIn(500);
						
						// Remover a notificação após 3 minutos
						setTimeout(function() {
							notification.fadeOut(500, function() {
								$(this).remove();
							});
						}, 180000);

						$('#btnLoginRegister').removeAttr('disabled');
						$('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
						$('#errorLogin').fadeOut(100);
						$("#formLoginRegister")[0].reset();
					 }

				 }  else {

					 if (result.errors) {
						 var error = '';
						 var $key = '';

					for ($key in result.errors) {
							 error += '<li><i class="far fa-times-circle"></i> ' + result.errors[$key] + '</li>';
						 }

						 $('#showErrorsLogin').html(error);
						 $('#errorLogin').fadeIn(500);
						 $('#btnLoginRegister').removeAttr('disabled');
						 $('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');

						 if (captcha) {
							grecaptcha.reset();
						 }
					 }
				 }
				},

				statusCode: {
						419: function() {
							window.location.reload();
						}
					},
				error: function(responseText, statusText, xhr, $form) {
						// error
						$('#btnLoginRegister').removeAttr('disabled');
						$('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
						swal({
								type: 'error',
								title: error_oops,
								text: error_occurred+' ('+xhr+')',
							});
							
						if (captcha) {
							grecaptcha.reset();
						 }
				}
			}).submit();
		})(); //<--- FUNCTION %
	}
</script>
@endif
