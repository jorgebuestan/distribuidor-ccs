<!doctype html>
<html class="fixed sidebar-light">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Distribuidor CCS</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!--  -->
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/bootstrap/css/bootstrap.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/animate/animate.compat.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/font-awesome/css/all.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/boxicons/css/boxicons.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/magnific-popup/magnific-popup.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/jquery-ui/jquery-ui.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/jquery-ui/jquery-ui.theme.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/morris/morris.css') }}" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="{{ URL::asset('porto/css/theme.css') }}" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="{{ URL::asset('porto/css/skins/default.css') }}" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="{{ URL::asset('porto/css/custom.css') }}">

		<!-- Head Libs -->
		<script src="{{ URL::asset('porto/vendor/modernizr/modernizr.js') }}"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="/dashboard" class="logo">
						<h4>Distribuidor CCS</h4>
					</a>

					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
					</div>

				</div>

				<!-- start: search & user box -->
				<div class="header-right">  

					<div id="userbox" class="userbox">
						<a href="#" data-bs-toggle="dropdown"> 
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name">{{ Auth::user()->name }}</span>
								<span class="role"> 
									@if (Auth::user()->hasRole('admin'))
										Administrador
									@elseif(Auth::user()->hasRole('camara'))
										Cámara
									@else
										Colaborador
									@endif
								</span>
							</div> 
							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="{{ route('profile.edit') }}"><i class="bx bx-user-circle"></i> Perfil</a>
								</li> 
								<li>
									<form method="POST" action="{{ route('logout') }}">
										@csrf
										<a role="menuitem" tabindex="-1"
											onclick="event.preventDefault(); this.closest('form').submit();">
											<i class="bx bx-power-off"></i> {{ __('Cerrar sesión') }}
										</a>
									</form> 
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">

				    <div class="sidebar-header">
				        <div class="sidebar-title">
				            Navigation
				        </div>
				        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
				            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
				        </div>
				    </div>

				    <div class="nano">
				        <div class="nano-content">
				            <nav id="menu" class="nav-main" role="navigation">

				                <ul class="nav nav-main">
				                    <li>
				                        <a class="nav-link" href="/dashboard">
				                            <i class="bx bx-home-alt" aria-hidden="true"></i>
				                            <span>Menú Principal</span>
				                        </a>                        
				                    </li>
									<li>
				                        <a class="nav-link" href="#">
											<i class="bx bx-detail" aria-hidden="true"></i>
				                            <span>Registro de Empresas</span>
				                        </a>                        
				                    </li>
									<li>
				                        <a class="nav-link" href="/firmas">
											<i class="bx bx-loader-circle" aria-hidden="true"></i>
				                            <span>Generar Firmas</span>
				                        </a>                        
				                    </li>
									<li>
				                        <a class="nav-link" href="#">
											<i class="bx bx-file" aria-hidden="true"></i>
				                            <span>Reporte Firmas Electrónicas</span>
				                        </a>                        
				                    </li>      
				                </ul>
				            </nav> 
				        </div>

				        <script>
				            // Maintain Scroll Position
				            if (typeof localStorage !== 'undefined') {
				                if (localStorage.getItem('sidebar-left-position') !== null) {
				                    var initialPosition = localStorage.getItem('sidebar-left-position'),
				                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

				                    sidebarLeft.scrollTop = initialPosition;
				                }
				            }
				        </script>

				    </div>

				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Distribuidor CCS</h2> 
					</header>

					<!-- start: page -->   
					@hasSection('content')
                        @yield('content')
                    @else
                        <div class="container mt-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Bienvenido al Distribuidor CCS</h3>
                                        </div>
                                        <div class="card-body">
                                            <p>Esta es la página principal del sistema Distribuidor CCS. Utilice
                                                el menú de la izquierda para navegar por las diferentes secciones.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
					<!-- end: page -->
				</section>
			</div> 

		</section>

		<!--  -->
		<script src="{{ URL::asset('porto/vendor/jquery/jquery.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jquery-browser-mobile/jquery.browser.mobile.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/popper/umd/popper.min.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/common/common.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/nanoscroller/nanoscroller.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

		<!-- Specific Page   -->
		<script src="{{ URL::asset('porto/vendor/jquery-ui/jquery-ui.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqueryui-touch-punch/jquery.ui.touch-punch.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jquery-appear/jquery.appear.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/bootstrapv5-multiselect/js/bootstrap-multiselect.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jquery.easy-pie-chart/jquery.easypiechart.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/flot/jquery.flot.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/flot.tooltip/jquery.flot.tooltip.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/flot/jquery.flot.pie.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/flot/jquery.flot.categories.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/flot/jquery.flot.resize.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jquery-sparkline/jquery.sparkline.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/raphael/raphael.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/morris/morris.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/gauge/gauge.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/snap.svg/snap.svg.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/liquid-meter/liquid.meter.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/jquery.vmap.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/data/jquery.vmap.sampledata.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/maps/jquery.vmap.world.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/maps/continents/jquery.vmap.africa.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/maps/continents/jquery.vmap.asia.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/maps/continents/jquery.vmap.australia.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/maps/continents/jquery.vmap.europe.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js') }}"></script>
		<script src="{{ URL::asset('porto/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js') }}"></script>

		<!-- Theme Base, Components and Settings -->
		<script src="{{ URL::asset('porto/js/theme.js') }}"></script>

		<!-- Theme Custom -->
		<script src="{{ URL::asset('porto/js/custom.js') }}"></script>

		<!-- Theme Initialization Files -->
		<script src="{{ URL::asset('porto/js/theme.init.js') }}"></script>

		<!-- Examples -->
		<script src="{{ URL::asset('porto/js/examples/examples.dashboard.js') }}"></script>

	</body>
</html>