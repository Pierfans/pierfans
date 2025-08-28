<div class="menuMobile w-100 bg-white shadow-lg p-3 border-top">
	<ul class="list-inline d-flex bd-highlight m-0 text-center justify-content-around">
		<!-- Notifications icon -->
		<!-- Hamburger menu toggle -->
		<li class="flex-fill bd-highlight">
			<a class="p-3 btn-mobile" href="javascript:void(0)" id="hamburger-menu-toggle" title="Menu">
				<i class="fas fa-bars icon-navbar"></i>
			</a>
		</li>
	</ul>

	<!-- Hamburger menu content -->
	<div id="hamburger-menu-content" class="hamburger-menu-content" style="display: none;">
		<div class="hamburger-menu-header p-3 border-bottom">
			<div class="d-flex justify-content-between align-items-center">
				<h5 class="m-0">Menu</h5>
				<a href="javascript:void(0)" id="hamburger-menu-close" class="text-dark">
					<i class="fas fa-times"></i>
				</a>
			</div>
		</div>
		<div class="hamburger-menu-body p-0">
			<ul class="list-group list-group-flush">
				<!-- Inicio -->
				<li class="list-group-item">
					<a href="{{url('/')}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="fas fa-home mr-3"></i>
						<span>Início</span>
					</a>
				</li>
				
				<!-- Minha pagina -->
				<li class="list-group-item">
					<a href="{{url(auth()->user()->username)}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="fas fa-user mr-3"></i>
						<span>Minha página</span>
					</a>
				</li>
				
				<!-- Dashboard -->
				<li class="list-group-item">
					<a href="{{url('dashboard')}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="fas fa-chart-bar mr-3"></i>
						<span>Dashboard</span>
					</a>
				</li>
				
				<!-- Comprado -->
				<li class="list-group-item">
					<a href="{{url('my/purchases')}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="fas fa-shopping-cart mr-3"></i>
						<span>Comprado</span>
					</a>
				</li>
				
				<!-- Mensagens -->
				<li class="list-group-item">
					<a href="{{url('messages')}}" class="d-flex align-items-center text-decoration-none text-dark position-relative">
						<i class="fas fa-envelope mr-3"></i>
						<span>Mensagens</span>
						<span class="badge badge-danger ml-2 @if (auth()->user()->messagesInbox() == 0) d-none @endif">
							{{ auth()->user()->messagesInbox() }}
						</span>
					</a>
				</li>
				
				<!-- Explorar -->
				@if (!$settings->disable_creators_section)
				<li class="list-group-item">
					<a href="{{url('creators')}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="fas fa-compass mr-3"></i>
						<span>Explorar</span>
					</a>
				</li>
				@endif
				
				<!-- Parceria -->
				<li class="list-group-item">
					<a href="{{url('parceria')}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="fas fa-handshake mr-3"></i>
						<span>Parceria</span>
					</a>
				</li>
				
				<!-- Assinaturas -->
				<li class="list-group-item">
					<a href="{{url('my/subscriptions')}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="fas fa-star mr-3"></i>
						<span>Assinaturas</span>
					</a>
				</li>
				
				<!-- Favoritos -->
				<li class="list-group-item">
					<a href="{{url('my/bookmarks')}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="fas fa-heart mr-3"></i>
						<span>Favoritos</span>
					</a>
				</li>
				
				<!-- Shop (if enabled) -->
				@if ($settings->shop)
				<li class="list-group-item">
					<a href="{{url('shop')}}" class="d-flex align-items-center text-decoration-none text-dark">
						<i class="feather icon-shopping-bag mr-3"></i>
						<span>{{trans('general.shop')}}</span>
					</a>
				</li>
				@endif

				<!-- Divisor para seções especiais -->
				<li class="list-group-item p-0">
					<div class="bg-gradient-primary text-white py-2 px-3 d-flex align-items-center justify-content-center">
						<i class="fas fa-star mr-2"></i>
						<span class="font-weight-bold">PROGRAMAS E RECURSOS ESPECIAIS</span>
						<i class="fas fa-star ml-2"></i>
					</div>
				</li>

				<!-- Programa de Afiliados -->
				<li class="list-group-item border-left border-success border-3">
					<div class="p-3">
						<div class="d-flex align-items-center mb-2">
							<i class="feather feather icon-dollar-sign text-success mr-2" style="font-size: 1.2rem;"></i>
							<h6 class="font-weight-bold m-0">Programa de Afiliados</h6>
						</div>
						<p class="small mb-3">Seja um afiliado com seu link de referência e ganhe 5% de comissão!</p>
						<button id="copyAffiliateLinkMobile" type="button" class="btn btn-sm btn-success btn-block d-flex align-items-center justify-content-center shadow-sm">
							<span>Copiar link de afiliado</span>
							<i class="feather icon-copy ml-2"></i>
						</button>
					</div>
				</li>

				<!-- Parcerias -->
				<li class="list-group-item border-left border-primary border-3">
					<div class="p-3">
						<div class="d-flex align-items-center mb-2">
							<i class="feather icon-shuffle text-primary mr-2" style="font-size: 1.2rem;"></i>
							<h6 class="font-weight-bold m-0">Parcerias</h6>
						</div>
						<p class="small mb-3">Troque Divulgação com Outros Criadores</p>
						<button type="button" class="btn btn-sm btn-primary btn-block shadow-sm" onclick="openParceriaModal()">
							Fazer Parceria
						</button>
					</div>
				</li>

				<!-- Token PYX -->
				<li class="list-group-item border-left border-warning border-3">
					<div class="p-3">
						<div class="d-flex align-items-center mb-2">
							<i class="fas fa-coins text-warning mr-2" style="font-size: 1.2rem;"></i>
							<h6 class="font-weight-bold m-0">Token PYX</h6>
						</div>
						<p class="small mb-3">Compre nosso token PYX e desbloqueie horas extras de conteúdo ou fotos exclusivas!</p>
						<button class="btn btn-sm btn-warning btn-block text-white shadow-sm" onclick="window.open('https://paylix.co/', '_blank')">
							Comprar Token PYX
						</button>
					</div>
				</li>
			</ul>
		</div>
	</div>
</div>

<!-- JavaScript for hamburger menu toggle and affiliate link -->
<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', function() {
		// Toggle hamburger menu
		document.getElementById('hamburger-menu-toggle').addEventListener('click', function() {
			document.getElementById('hamburger-menu-content').style.display = 'block';
			document.body.style.overflow = 'hidden';
		});

		document.getElementById('hamburger-menu-close').addEventListener('click', function() {
			document.getElementById('hamburger-menu-content').style.display = 'none';
			document.body.style.overflow = 'auto';
		});

		// Close menu when clicking outside
		document.addEventListener('click', function(event) {
			const menuContent = document.getElementById('hamburger-menu-content');
			const menuToggle = document.getElementById('hamburger-menu-toggle');
			
			if (!menuContent.contains(event.target) && event.target !== menuToggle && !menuToggle.contains(event.target)) {
				menuContent.style.display = 'none';
				document.body.style.overflow = 'auto';
			}
		});

		// Function to handle copy affiliate link
		function setupAffiliateLinkCopy(buttonId) {
			const copyButton = document.getElementById(buttonId);
			if (copyButton) {
				copyButton.addEventListener('click', function() {
					// Get the current URL and add the referral parameter if it doesn't exist
					const currentUrl = window.location.href;
					const url = new URL(currentUrl);
					url.searchParams.set('ref', '{{ auth()->user()->id }}');

					// Create a temporary input element to copy the text
					const tempInput = document.createElement('input');
					document.body.appendChild(tempInput);
					tempInput.value = url.toString();
					tempInput.select();
					document.execCommand('copy');
					document.body.removeChild(tempInput);

					// Change button text to confirm copy
					const originalText = copyButton.innerHTML;
					copyButton.innerHTML = '<span>Copiado!</span>';
					setTimeout(() => { 
						copyButton.innerHTML = originalText; 
					}, 1500);
				});
			}
		}

		// Setup affiliate link copy for both mobile and desktop
		setupAffiliateLinkCopy('copyAffiliateLinkMobile');
		setupAffiliateLinkCopy('copyAffiliateLinkDesktop');
	});
</script>

<!-- CSS for hamburger menu -->
<style>
	.hamburger-menu-content {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: white;
		z-index: 1000;
		overflow-y: auto;
	}
	
	.hamburger-menu-body {
		max-height: calc(100vh - 60px);
		overflow-y: auto;
	}
	
	.list-group-item {
		border-left: none;
		border-right: none;
		padding: 15px;
	}
</style>
