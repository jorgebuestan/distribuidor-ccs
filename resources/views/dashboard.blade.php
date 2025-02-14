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

   
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"> 
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css') }}" /> 
		 
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/elusive-icons/css/elusive-icons.css') }}" />

		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/select2/css/select2.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/select2-bootstrap-theme/select2-bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/pnotify/pnotify.custom.css') }}" />

		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/datatables/media/css/dataTables.bootstrap5.css') }}" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/dropzone/basic.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('porto/vendor/dropzone/dropzone.css') }}" />

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
									@elseif(Auth::user()->hasRole('user'))
										Usuario
									@else
										Usuario
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
    <script src="{{ URL::asset('porto/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/common/common.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/nanoscroller/nanoscroller.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/magnific-popup/jquery.magnific-popup.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/jquery-placeholder/jquery.placeholder.js') }}"></script>

    <!-- Specific Page Vendor -->
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


    <!-- Specific Page Vendor -->
    <script src="{{ URL::asset('porto/vendor/select2/js/select2.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/pnotify/pnotify.custom.js') }}"></script>

    <!-- Specific Page Vendor -->
    <script src="{{ URL::asset('porto/vendor/jquery-validation/jquery.validate.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/bootstrapv5-wizard/jquery.bootstrap.wizard.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/pnotify/pnotify.custom.js') }}"></script>

    <!-- Specific Page Vendor -->
    <script src="{{ URL::asset('porto/vendor/select2/js/select2.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/datatables/media/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ URL::asset('porto/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.bootstrap4.min.js') }}">
    </script>
    <script src="{{ URL::asset('porto/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.html5.min.js') }}">
    </script>
    <script src="{{ URL::asset('porto/vendor/datatables/extras/TableTools/Buttons-1.4.2/js/buttons.print.min.js') }}">
    </script>
    <script src="{{ URL::asset('porto/vendor/datatables/extras/TableTools/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/datatables/extras/TableTools/pdfmake-0.1.32/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('porto/vendor/datatables/extras/TableTools/pdfmake-0.1.32/vfs_fonts.js') }}"></script>

 
	<script src="{{ URL::asset('porto/vendor/bootstrap-markdown/js/markdown.js') }}"></script>
	<script src="{{ URL::asset('porto/vendor/bootstrap-markdown/js/to-markdown.js') }}"></script>
	<script src="{{ URL::asset('porto/vendor/bootstrap-markdown/js/bootstrap-markdown.js') }}"></script> 
	<script src="{{ URL::asset('porto/vendor/ios7-switch/ios7-switch.js') }}"></script>
	<script src="{{ URL::asset('porto/vendor/dropzone/dropzone.js') }}"></script>

    <!-- Theme Base, Components and Settings -->
    <script src="{{ URL::asset('porto/js/theme.js') }}"></script>

    <!-- Theme Custom -->
    <script src="{{ URL::asset('porto/js/custom.js') }}"></script>

    <!-- Theme Initialization Files -->
    <script src="{{ URL::asset('porto/js/theme.init.js') }}"></script>

    <!-- Examples -->
    <script src="{{ URL::asset('porto/js/examples/examples.dashboard.js') }}"></script>

    <!-- Examples -->
    <script src="{{ URL::asset('porto/js/examples/examples.modals.js') }}"></script>

    <!-- Examples -->
    <script src="{{ URL::asset('porto/js/examples/examples.wizard.js') }}"></script>


    <script src="{{ URL::asset('porto/js/examples/examples.datatables.default.js') }}"></script>
    <script src="{{ URL::asset('porto/js/examples/examples.datatables.row.with.details.js') }}"></script>
    <script src="{{ URL::asset('porto/js/examples/examples.datatables.tabletools.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="{{ URL::asset('porto/js/examples/examples.advanced.form.js') }}"></script>
	<script src="{{ URL::asset('porto/js/examples/examples.header.menu.js') }}"></script>
	<script src="{{ URL::asset('porto/js/examples/examples.ecommerce.form.js') }}"></script>

	
	<style>
		.custom-hr {
			height: 5px; /* Ajusta el grosor */
			background-color: black; /* Cambia el color */
			border: none; /* Elimina bordes predeterminados */
		}
	</style>

	</body>
</html>