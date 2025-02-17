@extends('dashboard')

@section('pagename')
    Maestro de Empresas
@endsection

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .rowborder {
            margin: 20px;
            /* Establece el margen deseado */
            padding: 10px;
            /* Añade un relleno interno para separar el contenido del margen */
            border: 2px solid #ccc;
            /* Añade un borde para crear el efecto rectangular */
            border-radius: 10px;
            /* Agrega bordes circulares en las esquinas */
            box-sizing: border-box;
            /* Incluye el borde y el relleno en el tamaño total del elemento */
        }

        /* Contenedor de elementos seleccionados */
        .container-selected-items {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5em;
            max-width: 100%;
            max-height: 90px;
            overflow-x: hidden;
            align-items: flex-start;
        }

        .selected-item {
            display: inline-block;
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal;
            max-width: 100%;
            /* Adjust if container size is fixed */
            overflow-wrap: break-word;
            padding: 0.5em;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            color: white;
            border-radius: 0.25em;
            box-sizing: border-box;
        }

        .selected-items .badge {
            font-size: 12px;
            padding: 8px 15px;
            margin: 5px 5px 0 0;
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            border-radius: 3px;
        }

        .selected-items .badge .remove-item {
            margin-left: 5px;
            display: inline;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
        }

        .selected-items .badge .remove-item:hover {
            color: #ff0000;
        }

        input:where(:not([type])):focus,
        [multiple]:focus,
        [type='search']:focus,
        select:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
            --tw-ring-inset: var(--tw-empty,
                    /*!*/
                    /*!*/
                );
            --tw-ring-offset-width: 0px;
            --tw-ring-offset-color: #fff;
            /* --tw-ring-color: #2563eb; */
            --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width) transparent !important;
            --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) transparent !important;
            /* box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow); */
            border-color: transparent !important;
        }
    </style>
 
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery UI (si es necesario) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/i18n/datepicker-es.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-lg-11 text-end">
                &nbsp;
            </div>
            <div class="col-lg-1">
                <a href="{{ route('dashboard') }}" id="videoLink">
                    <button type="button" class="mb-1 mt-1 me-1 btn btn-primary">Regresar</button>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-end">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <section class="card" id="w3">
                    <header class="card-header">
                        <h2 class="card-title">Gestión de Empresas</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#ModalEmpresa">Agregar Nueva Empresa</button>
                                            <!--<span class="badge bg-success text-light">ACTIVO</span>
                                            <span class="badge bg-danger text-light">INACTIVO</span>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#ModalEstablecimiento">Agregar Nuevo Registro</button> -->
                                        <!-- <button id="abrirModal" class="btn btn-primary mb-3">Agregar Nuevo Socio</button>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <section class="card">
                                    <header class="card-header">
                                        <h2 class="card-title">Listado de Empresas Registradas</h2>
                                    </header>
                                    <div class="card-body overflow-x-auto max-w-full">
                                        <table class="table table-bordered table-striped mb-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>RUC</th>
                                                    <th>RAZÓN SOCIAL</th>
                                                    <th>ACCIONES</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col"> 
                                <div id="image-container">
                                    <a href="{{ asset('storage/logos/0922489968001/0922489968001.png') }}" data-lightbox="example" target="_blank">
                                        <img src="{{ asset('storage/logos/0922489968001/0922489968001.png') }}" alt="Imagen reducida" style="max-width: 100%; height: auto;">
                                         
                                    </a>
                                </div>
                            </div>
                        </div> -->
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>
    <div class="container">
        <!-- Modal -->

        <!-- Jbuestan Modales -->
        <form enctype="multipart/form-data" class="modal fade" id="ModalEmpresa" tabindex="-1"
            aria-labelledby="ModalEmpresa" aria-hidden="true">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalEmpresaLabel"><b>Modificar Empresa</b></h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tabs">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item active">
                                                <a class="nav-link" data-bs-target="#datos_generales"
                                                    href="#datos_generales" data-bs-toggle="tab">Datos Generales</a>
                                            </li> 
                                        </ul>
                                        <div class="tab-content">
                                            <div id="datos_generales" class="tab-pane active">
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <label for="logoFile" class="btn btn-primary w-100">Subir Logo</label>
                                                        <input type="file" class="form-control-file d-none" name="logoFile" id="logoFile">
                                                        <input type="hidden" name="tipoDocFirma" value="1">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>RUC</label>
                                                        <input type="text" class="form-control" name="ruc"
                                                            id="ruc" placeholder="RUC de la Empresa">
                                                        <div id="error-ruc" style="color: red; display: none;">El RUC debe
                                                            tener
                                                            13 dígitos.</div>
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Razón Social</label>
                                                        <input type="text" class="form-control" name="razon_social"
                                                            id="razon_social" placeholder="Razón Social">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>Obligado a llevar contabilidad</label>
                                                        <select id="obligado_contabilidad" name="obligado_contabilidad"
                                                            class="form-control">
                                                            <option value="0">NO</option>
                                                            <option value="1">SI</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Tipo de Contribuyente</label>
                                                        <select id="id_tipo_contribuyente" name="id_tipo_contribuyente"
                                                            class="form-control populate">
                                                            <option value=-1>Seleccionar</option>
                                                            @foreach ($tipo_contribuyente as $id => $descripcion)
                                                                <option value={{$id}}>{{$descripcion}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>Direccion</label>
                                                        <input type="text" class="form-control"
                                                            name="direccion"
                                                            id="direccion"
                                                            placeholder="Dirección de la empresa">
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Teléfono</label>
                                                        <input type="text" class="form-control"
                                                            name="telefono"
                                                            id="telefono"
                                                            placeholder="Teléfono de la empresa">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Correo - Contacto Administrativo</label>
                                                        <input type="text" class="form-control"
                                                            name="correo_administrativo"
                                                            id="correo_administrativo"
                                                            placeholder="Email administrativo de la empresa">
                                                            <div id="error-correo-administrativo" style="color: red; display: none;">Ingrese
                                                                un correo electrónico válido.</div>
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Contribuyente Especial</label>
                                                        <select id="contribuyente_especial" name="contribuyente_especial"
                                                            class="form-control">
                                                            <option value="0">NO</option>
                                                            <option value="1">SI</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Correo - Comprobantes Electrónicos</label>
                                                        <input type="text" class="form-control"
                                                            name="correo_comprobante_electronico"
                                                            id="correo_comprobante_electronico"
                                                            placeholder="Email para generar los comprobantes elecrónicos de la empresa">
                                                            <div id="error-correo-comprobante-electronico" style="color: red; display: none;">Ingrese
                                                                un correo electrónico válido.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tipo de Ambiente</label>
                                                        <select id="id_ambiente" name="id_ambiente"
                                                            class="form-control populate">
                                                            <option value=-1>Seleccionar</option>
                                                            @foreach ($tipo_ambiente as $id => $descripcion)
                                                                <option value={{$id}}>{{$descripcion}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Clave Firma Electrónica</label>
                                                        <input type="text" class="form-control"
                                                            name="clave_firma"
                                                            id="clave_firma"
                                                            placeholder="Clave para firma electrónica de la empresa">
                                                            <div id="error-clave-firma" style="color: red; display: none;">Ingrese
                                                                un correo electrónico válido.</div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <label>Firma Electrónica</label>
                                                        <div id="dragDropBox" class = "border p-4 text center">
                                                            <p>Arrastra y suelta tu firma aquí o haz clic para seleccionar un archivo.</p>
                                                            <input type="file" class="d-none" id="firmaFile" name="firmaFile">
                                                            <input type="hidden" name="tipoDocFirma" value="1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    const dragDropBox = document.getElementById('dragDropBox');
                                                    const fileInput = document.getElementById('firmaFile');
                                                
                                                    dragDropBox.addEventListener('click', function() {
                                                        fileInput.click();
                                                    });
                                                
                                                    dragDropBox.addEventListener('dragover', function(e) {
                                                        e.preventDefault();
                                                        dragDropBox.style.backgroundColor = '#f0f0f0'; // Cambio de color al arrastrar
                                                    });
                                                
                                                    dragDropBox.addEventListener('dragleave', function() {
                                                        dragDropBox.style.backgroundColor = ''; // Vuelve al color original
                                                    });
                                                
                                                    dragDropBox.addEventListener('drop', function(e) {
                                                        e.preventDefault();
                                                        dragDropBox.style.backgroundColor = ''; // Vuelve al color original
                                                        const files = e.dataTransfer.files;
                                                        if (files.length > 0) {
                                                            fileInput.files = files; // Asigna los archivos seleccionados al input
                                                        }
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>&nbsp;
                        <button type="button" class="btn btn-primary" id="btn-register-empresa">Guardar</button>
                    </div>
                </div>
            </div>
        </form> 

        <form enctype="multipart/form-data" class="modal fade" id="ModalModificarEmpresa" tabindex="-1"
            aria-labelledby="ModalModificarEmpresaLabel" aria-hidden="true">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalModificarEmpresaLabel"><b>Modificar Empresa</b></h5>
                        <button type="button" class="btn btn-warning" id="btn-more-info">
                            <i class="fas fa-info"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tabs">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item active">
                                                <a class="nav-link" data-bs-target="#datos_generales_mod"
                                                    href="#datos_generales_mod" data-bs-toggle="tab">Datos Generales</a>
                                            </li> 
                                        </ul>
                                        <div class="tab-content">
                                            <div id="datos_generales_mod" class="tab-pane active">
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <label for="logoFile" class="btn btn-primary w-100">Subir Logo</label>
                                                        <input type="file" class="form-control-file d-none" name="logoFile_mod" id="logoFile_mod">
                                                        <input type="hidden" name="tipoDocFirma_mod" value="1">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>RUC</label>
                                                        <input type="text" class="form-control" name="ruc_mod"
                                                            id="ruc_mod" placeholder="RUC de la Empresa">
                                                        <div id="error-ruc-mod" style="color: red; display: none;">El RUC debe
                                                            tener
                                                            13 dígitos.</div>
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Razón Social</label>
                                                        <input type="text" class="form-control" name="razon_social_mod"
                                                            id="razon_social_mod" placeholder="Razón Social">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>Obligado a llevar contabilidad</label>
                                                        <select id="obligado_contabilidad_mod" name="obligado_contabilidad_mod"
                                                            class="form-control">
                                                            <option value="0">NO</option>
                                                            <option value="1">SI</option>
                                                            
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Tipo de Contribuyente</label>
                                                        <select id="id_tipo_contribuyente_mod" name="id_tipo_contribuyente_mod"
                                                            class="form-control populate">
                                                            <option value=-1>Seleccionar</option>
                                                            @foreach ($tipo_contribuyente as $id => $descripcion)
                                                                <option value={{$id}}>{{$descripcion}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>Direccion</label>
                                                        <input type="text" class="form-control"
                                                            name="direccion_mod"
                                                            id="direccion_mod"
                                                            placeholder="Dirección de la empresa">
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Teléfono</label>
                                                        <input type="text" class="form-control"
                                                            name="telefono_mod"
                                                            id="telefono_mod"
                                                            placeholder="Teléfono de la empresa">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Correo - Contacto Administrativo</label>
                                                        <input type="text" class="form-control"
                                                            name="correo_administrativo_mod"
                                                            id="correo_administrativo_mod"
                                                            placeholder="Email administrativo de la empresa">
                                                            <div id="error-correo-administrativo-mod" style="color: red; display: none;">Ingrese
                                                                un correo electrónico válido.</div>
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Contribuyente Especial</label>
                                                        <select id="contribuyente_especial_mod" name="contribuyente_especial_mod"
                                                            class="form-control">
                                                            <option value="0">NO</option>
                                                            <option value="1">SI</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Correo - Comprobantes Electrónicos</label>
                                                        <input type="text" class="form-control"
                                                            name="correo_comprobante_electronico_mod"
                                                            id="correo_comprobante_electronico_mod"
                                                            placeholder="Email para generar los comprobantes elecrónicos de la empresa">
                                                            <div id="error-correo-comprobante-electronico-mod" style="color: red; display: none;">Ingrese
                                                                un correo electrónico válido.</div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Tipo de Ambiente</label>
                                                        <select id="id_ambiente_mod" name="id_ambiente_mod"
                                                            class="form-control populate">
                                                            <option value=-1>Seleccionar</option>
                                                            @foreach ($tipo_ambiente as $id => $descripcion)
                                                                <option value={{$id}}>{{$descripcion}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Clave Firma Electrónica</label>
                                                        <input type="text" class="form-control"
                                                            name="clave_firma_mod"
                                                            id="clave_firma_mod"
                                                            placeholder="Clave para firma electrónica de la empresa">
                                                            <div id="error-clave-firma-mod" style="color: red; display: none;">Ingrese
                                                                un correo electrónico válido.</div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-12">
                                                        <label>Firma Electrónica</label>
                                                        <div id="dragDropBox" class = "border p-4 text center">
                                                            <p>Arrastra y suelta tu firma aquí o haz clic para seleccionar un archivo.</p>
                                                            <input type="file" class="d-none" id="firmaFile_mod" name="firmaFile_mod">
                                                            <input type="hidden" name="tipoDocFirma_mod" value="1">
                                                        </div>
                                                    </div>
                                                </div>

                                                <script>
                                                    const dragDropBox = document.getElementById('dragDropBox');
                                                    const fileInput = document.getElementById('firmaFile_mod');
                                                
                                                    dragDropBox.addEventListener('click', function() {
                                                        fileInput.click();
                                                    });
                                                
                                                    dragDropBox.addEventListener('dragover', function(e) {
                                                        e.preventDefault();
                                                        dragDropBox.style.backgroundColor = '#f0f0f0'; // Cambio de color al arrastrar
                                                    });
                                                
                                                    dragDropBox.addEventListener('dragleave', function() {
                                                        dragDropBox.style.backgroundColor = ''; // Vuelve al color original
                                                    });
                                                
                                                    dragDropBox.addEventListener('drop', function(e) {
                                                        e.preventDefault();
                                                        dragDropBox.style.backgroundColor = ''; // Vuelve al color original
                                                        const files = e.dataTransfer.files;
                                                        if (files.length > 0) {
                                                            fileInput.files = files; // Asigna los archivos seleccionados al input
                                                        }
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-close" data-dismiss="modal">Cerrar</button>&nbsp;
                        <button type="button" class="btn btn-primary" id="btn-modificar-empresa">Guardar cambios</button>
                    </div>
                </div>
            </div>
        </form> 
    </div> 
  
    

    <script>
        $(document).ready(function() {

            let empresa_selected = null;
            let empresas = [];
            
            Swal.fire({
                title: 'Cargando',
                text: 'Por favor espere',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            var table =  $('#dataTable').DataTable({
                destroy: true,
                processing: false,
                serverSide: true,

                ajax: {
                    url: "{{ route('admin.obtener_listado_empresas') }}",
                    type: "GET",
                    data: function(d) {
                        d.start = d.start || 0;
                        d.length = d.length || 10;
                    },
                    error: function(error) {
                        Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        confirmButtonText: 'Aceptar',
                        text: error.responseJSON?.error || "Error al cargar los datos.",
                        });
                        console.error("Error al cargar los datos: ", error);
                    },
                    complete: function(response) {
                        empresas = response.responseJSON.data;
                        Swal.close();
                    },
                },

                pageLength: 10,
                columns: [
                    { data: 'ruc', width: '15%' },
                    { data: 'razon_social', width: '67%' },
                    { data: 'btn', width: '12%' }
                ],

                order: [[0, "asc"]],
                createdRow: function(row, data, dataIndex) {
                    var td = $(row).find(".truncate");
                    td.attr("title", td.text());

                    var td2 = $(row).find(".truncate2");
                    td2.attr("title", td2.text());
                },
            });

            $('#tipo_contribuyente').on('change', function() {
                const value = $(this).val();

                if(value == '1'){
                    $('#regimen_general').show();
                    $('#rimpe_emprendedor').hide();
                    $('#rimple_negocio_popular').hide();
                
                }else if(value == '2'){
                    $('#regimen_general').hide();
                    $('#rimpe_emprendedor').show();
                    $('#rimple_negocio_popular').hide();

                }else if(value == '3'){
                    $('#regimen_general').hide();
                    $('#rimpe_emprendedor').hide();
                    $('#rimple_negocio_popular').show();
                }else{
                    $('#regimen_general').hide();
                    $('#rimpe_emprendedor').hide();
                    $('#rimple_negocio_popular').hide();
                }
            }
        );

        // Manejo de Uppercase y Lowercase en campos de texto

            $('#razon_social').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#razon_social_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#direccion').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#direccion_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#correo_administrativo').on('input', function() {
                // Convierte el valor del campo a minúscula
                $(this).val($(this).val().toLowerCase());
            });

            $('#correo_administrativo_mod').on('input', function() {
                // Convierte el valor del campo a minúscula
                $(this).val($(this).val().toLowerCase());
            });

            $('#correo_comprobante_electronico').on('input', function() {
                // Convierte el valor del campo a minúscula
                $(this).val($(this).val().toLowerCase());
            });

            $('#correo_comprobante_electronico_mod').on('input', function() {
                // Convierte el valor del campo a minúscula
                $(this).val($(this).val().toLowerCase());
            });

            $('#telefono').on('input', function() {
                let value = $(this).val();
                // Eliminar todos los caracteres no numéricos excepto el guion
                value = value.replace(/[^0-9]/g, '');
                
                // Limitar el campo a un máximo de 11 caracteres (10 dígitos + 1 guion)
                if (value.length > 11) {
                    value = value.slice(0, 11);
                }
                $(this).val(value);
            });

            $('#telefono_mod').on('input', function() {
                let value = $(this).val();
                // Eliminar todos los caracteres no numéricos excepto el guion
                value = value.replace(/[^0-9]/g, '');
                
                // Limitar el campo a un máximo de 11 caracteres (10 dígitos + 1 guion)
                if (value.length > 11) {
                    value = value.slice(0, 11);
                }
                $(this).val(value);
            });

        // Validación de valores en el formulario de creación y edición

            // Validar campo RUC
            $("#ruc").on("input", function() {
                var ruc = $(this).val();
                if (/^\d{13}$/.test(ruc)) { // Si tiene exactamente 13 dígitos
                    $("#error-ruc").hide(); // Ocultar error
                } else {
                    $("#error-ruc").show(); // Mostrar error
                }
            });

            $("#ruc_mod").on("input", function() {
                var ruc = $(this).val();
                if (/^\d{13}$/.test(ruc)) { // Si tiene exactamente 13 dígitos
                    $("#error-ruc-mod").hide(); // Ocultar error
                } else {
                    $("#error-ruc-mod").show(); // Mostrar error
                }
            });

            // Validar campo Correo administrativo
            $("#correo_administrativo").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-correo-administrativo").hide(); // Ocultar error
                } else {
                    $("#error-correo-administrativo").show(); // Mostrar error
                }
            });

            $("#correo_administrativo_mod").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-correo-administrativo-mod").hide(); // Ocultar error
                } else {
                    $("#error-correo-administrativo-mod").show(); // Mostrar error
                }
            });

            // Validar campo Correo de comprobante electrónico
            $("#correo_comprobante_electronico").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-correo-comprobante-electronico").hide(); // Ocultar error
                } else {
                    $("#error-correo-comprobante-electronico").show(); // Mostrar error
                }
            });

            $("#correo_comrpobante_electronico_mod").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-correo-comprobante-electronico-mod").hide(); // Ocultar error
                } else {
                    $("#error-correo-comprobante-electronico-mod").show(); // Mostrar error
                }
            });

            $("#btn-register-empresa").click(async function() {

                if (!/^\d{13}$/.test($('#ruc').val())) {
                    /*$("#error-ruc").show();
                    isValid = false;*/
                    $("#error-ruc").show();
                    //alert('El RUC debe tener 13 dígitos');
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'El RUC debe tener 13 dígitos',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#ruc').focus();
                    return;
                }

                if ($('#razon_social').val() == "") {
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Razón Social',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#razon_social').focus();
                    return;
                }

                if ($('#id_tipo_contribuyente').val() == -1) {
                    //alert('Debe seleccionar el Tipo de Contribuyente');
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Tipo de Contribuyente',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#id_tipo_contribuyente').focus();
                    return;
                }
                
                if ($('#direccion').val() == "") {
                    //alert('Debe ingresar la Dirección del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Dirección de la Empresa',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#direccion').focus();
                    return;
                }

                if ($('#telefono').val() == "") {
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Teléfono de la Empresa',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#telefono').focus();
                    return;
                }

                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($(
                        '#correo_administrativo').val())) {
                    $("#error-correo-administrativo").show();
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar un correo administrativo con formato válido',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });

                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#correo_administrativo').focus();
                    return;
                }

                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($(
                        '#correo_comprobante_electronico').val())) {
                    $("#error-correo-comprobante-electronico").show();
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar un correo con formato válido',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });

                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#correo_comprobante_electronico').focus();
                    return;
                }

                
                if ($('#id_ambiente').val() == -1) {
                    //alert('Debe seleccionar el Tipo de Ambiente');
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Tipo de Ambiente',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#id_ambiente').focus();
                    return;
                }

                if ($('#clave_firma').val() == "") {
                    //alert('Debe ingresar la Dirección del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Clave de la Firma Electrónica',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#clave_firma').focus();
                    return;
                }

                var formData = new FormData(document.getElementById('ModalEmpresa'));

                Swal.fire({
                    target: document.getElementById('ModalEmpresa'),
                    title: 'Enviando datos para registro de Empresa ',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    url: "{{ route('admin.registrar_empresa') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res) {
                    //$('#carga').hide();
                    Swal.close();
                    //alert(res.success); // Mostrar el mensaje de éxito en un alert
                    Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'success', // Cambiado a 'success' para mostrar un mensaje positivo
                        title: 'Éxito',
                        text: res.success,
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    //location.reload(); // Recargar la página
                    window.location.href = window.location.href.split('?')[0] + '?noCache=' + new Date().getTime();
                }).fail(function(res) {
                    $('#carga').hide();

                    if (res.status === 422) {
                        // Mostrar mensaje de error de validación
                        let errors = res.responseJSON;
                        if (errors.error) {
                            //alert(errors.error); 
                            Swal.fire({
                                target: document.getElementById('ModalEmpresa'),
                                icon: 'error',
                                title: 'Error',
                                text: errors.error,
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                            });
                        }
                    } else {
                        // Mostrar mensaje genérico si no se recibió un error específico
                        //alert("Ocurrió un error al registrar la empresa.");
                        Swal.fire({
                            target: document.getElementById('ModalEmpresa'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error al registrar la empresa.',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                    }

                    console.log(res
                        .responseText
                    ); // Muestra el error completo en la consola para depuración
                });
            });

            /*
            $(document).on('click', '.open-modal', function() {
                console.log('Botón clicado...');
                var button = $(this);
                var camaraId = button.data('id');

                //$('#carga').show();
                Swal.fire({
                    title: 'Cargando información de Empresa',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    url: '/administrador/camara/detalle/' + camaraId,
                    method: 'GET',
                    success: function(response) {
                        camara_selected = response;
                        console.log('Datos recibidos:', response);

                        var CamaraId = $('#camara_id');
                        var FechaIngreso = $('#fecha_ingreso_mod');
                        var Ruc = $('#ruc_mod');
                        var RazonSocial = $('#razon_social_mod');
                        var Cedula = $('#cedula_representante_legal_mod');
                        var Nombres = $('#nombres_representante_legal_mod');
                        var Apellidos = $('#apellidos_representante_legal_mod');
                        var Telefono = $('#telefono_representante_legal_mod');
                        var Correo = $('#correo_representante_legal_mod');
                        var Cargo = $('#cargo_representante_legal_mod');
                        var Direccion = $('#direccion_representante_legal_mod');

                        var TipoRegimen = $('#tipo_regimen_mod');
                        var FechaRegistro = $('#fecha_registro_mod');
                        var FechaConstitucion = $('#fecha_constitucion_mod');
                        var AgenteRetencion = $('#agente_retencion_mod');
                        var ContribuyenteEspecial = $('#contribuyente_especial_mod');
                        var Pais = $('#pais_mod');
                        var Provincia = $('#provincia_mod');
                        var Canton = $('#canton_mod');
                        var Parroquia = $('#parroquia_mod');
                        var Calle = $('#calle_mod');
                        var Manzana = $('#manzana_mod');
                        var Numero = $('#numero_mod');
                        var Interseccion = $('#interseccion_mod');
                        var Referencia = $('#referencia_mod');
                        var ActividadEconomica = $('#actividad_economica_mod');
                        var HiddenSelectedItemsMod = $('#hiddenSelectedItemsMod');

                        //console.log('Elemento Cargo encontrado:', CargoInput.length); // Verificar que el elemento se encuentra
                        //console.log('Elemento cargo_id encontrado:', camaraIdInput.length); // Verificar que el elemento se encuentra

                        CamaraId.val(response.id);
                        //FechaIngreso.val(response.fecha_ingreso); 
                        FechaIngreso.val(convertirFecha(response.fecha_ingreso));
                        Ruc.val(response.ruc);
                        RazonSocial.val(response.razon_social);
                        Cedula.val(response.cedula_representante_legal);
                        Nombres.val(response.nombres_representante_legal);
                        Apellidos.val(response.apellidos_representante_legal);
                        Telefono.val(response.telefono_representante_legal);
                        //Correo.val(response.correo_representante_legal);
                        Correo.val(response.correo_representante_legal.toLowerCase());
                        Cargo.val(response.cargo_representante_legal);
                        Direccion.val(response.direccion_representante_legal);

                        TipoRegimen.val(response.dato_tributario.tipo_regimen);

                        $('#abiertos-count').text(response.establecimientos?.estado_1 || 0);
                        $('#cerrados-count').text(response.establecimientos?.estado_2 || 0);
                        //FechaRegistro.val(response.dato_tributario.fecha_registro_sri); 
                        //FechaRegistro.val(convertirFecha(response.dato_tributario.fecha_registro_sri));

                        //alert (response.dato_tributario.fecha_registro_sri);
                        // Manejo de la fecha de registro
                        const fechaISO = response.dato_tributario
                            .fecha_registro_sri; // Por ejemplo, '2008-01-22'
                        const fechaConvertida = convertirFecha(fechaISO);

                        // Convertir la fecha al formato necesario para `Date`
                        const fechaObj = convertirFechaAObjetoDate(
                            fechaConvertida); // Convertir de DD/MM/YYYY a Date

                        if (!isNaN(fechaObj.getTime())) {
                            $('#fecha_registro_mod').datepicker('setDate',
                                fechaObj); // Asigna la fecha
                        } else {
                            console.error("Fecha no válida:", fechaConvertida);
                        }

                        var logoFullPath = "{{ asset('storage') }}/" + response.logo;

                        $('#image-link').attr('href', logoFullPath); // Cambia el href del enlace
                        $('#image-preview').attr('src', logoFullPath); // Cambia el src de la imagen

                        // Manejo de la fecha de constitución
                        const fechaISO2 = response.dato_tributario
                            .fecha_constitucion; // Por ejemplo, '2008-01-22'
                        const fechaConvertida2 = convertirFecha(fechaISO2);

                        const fechaObj2 = convertirFechaAObjetoDate(fechaConvertida2);

                        if (!isNaN(fechaObj2.getTime())) {
                            $('#fecha_constitucion_mod').datepicker('setDate',
                                fechaObj2); // Asigna la fecha
                        } else {
                            console.error("Fecha no válida:", fechaConvertida2);
                        }

                        // Calcular años y meses
                        var hoy = new Date();
                        var FechaConstitucion = $('#fecha_constitucion_mod').val();
                        var FechaConstitucionDate = convertirFechaAObjetoDate(
                            FechaConstitucion);

                        if (!isNaN(FechaConstitucionDate.getTime())) {
                            var years = hoy.getFullYear() - FechaConstitucionDate.getFullYear();
                            var months = hoy.getMonth() - FechaConstitucionDate.getMonth();

                            if (months < 0) {
                                years--;
                                months += 12;
                            }

                            console.log(`${years} años, ${months} meses`);
                        } else {
                            console.error("Fecha de constitución no válida.");
                        }

                        // Función auxiliar para convertir DD/MM/YYYY a Date
                        function convertirFechaAObjetoDate(fecha) {
                            if (!fecha) return new Date(
                                'Invalid Date'); // Retorna fecha inválida si la entrada es nula
                            const partes = fecha.split('/'); // Divide por barra
                            return new Date(partes[2], partes[1] - 1, partes[
                                0]); // Formato DD/MM/YYYY
                        }

                        $('#anios_creacion_mod').val(years + ' años, ' + months + ' meses');

                        AgenteRetencion.val(response.dato_tributario.agente_retencion);
                        ContribuyenteEspecial.val(response.dato_tributario
                            .contribuyente_especial);
                        Pais.val(response.dato_tributario.id_pais);
                        Provincia.val(response.dato_tributario.id_provincia);
                        Canton.val(response.dato_tributario.id_canton);
                        Parroquia.val(response.dato_tributario.id_parroquia);

                        // Asignar país y disparar cambio para cargar provincias
                        $('#pais_mod').val(response.dato_tributario.id_pais).trigger('change');

                        // Cargar provincias y asignar provincia
                        cargarProvincias(response.dato_tributario.id_pais).then(() => {
                            $('#provincia_mod').val(response.dato_tributario
                                .id_provincia).trigger('change');

                            // Cargar cantones y asignar cantón
                            cargarCantones(response.dato_tributario.id_pais, response
                                .dato_tributario.id_provincia).then(() => {
                                $('#canton_mod').val(response.dato_tributario
                                    .id_canton).trigger('change');

                                // Cargar parroquias y asignar parroquia
                                cargarParroquias(
                                    response.dato_tributario.id_pais,
                                    response.dato_tributario.id_provincia,
                                    response.dato_tributario.id_canton
                                ).then(() => {
                                    $('#parroquia_mod').val(response
                                        .dato_tributario
                                        .id_parroquia);
                                });
                            });
                        });

                        Calle.val(response.dato_tributario.calle);
                        Manzana.val(response.dato_tributario.manzana);
                        Numero.val(response.dato_tributario.numero);
                        Interseccion.val(response.dato_tributario.interseccion);
                        Referencia.val(response.dato_tributario.referencia);

                        // Limpia la lista visual y el array
                        selectedItemsMod = [];
                        $('#selectedList_mod').empty();

                        console.log(response.dato_tributario.actividades_economicas);

                        // Verifica si response.dato_tributario y response.dato_tributario.actividades_economicas tienen valores
                        if (response.dato_tributario && response.dato_tributario
                            .actividades_economicas) {
                            // Decodifica el JSON si es necesario
                            let actividadesEconomicas = response.dato_tributario
                                .actividades_economicas;

                            // Verifica si es un string y necesita ser decodificado
                            if (typeof actividadesEconomicas === 'string') {
                                try {
                                    actividadesEconomicas = JSON.parse(actividadesEconomicas);
                                    console.log(actividadesEconomicas);
                                } catch (error) {
                                    console.error(
                                        "Error al decodificar actividades_economicas:",
                                        error);
                                    actividadesEconomicas = [];
                                }
                            }

                            // Asegúrate de que ahora sea un array
                            if (Array.isArray(actividadesEconomicas) && actividadesEconomicas
                                .length > 0) {
                                console.log("Actividades económicas recibidas:",
                                    actividadesEconomicas);

                                actividadesEconomicas.forEach(function(id) {
                                    id = parseInt(
                                        id); // Asegúrate de que el ID es un entero

                                    // Obtener el texto de la opción seleccionada
                                    var optionText = $(
                                        `#actividad_economica_mod option[value=${id}]`
                                    ).text();

                                    // Añadir ID al array de elementos seleccionados
                                    console.log('ID:', id);
                                    console.log(typeof id);
                                    selectedItemsMod.push(id);

                                    // Añadir el badge visualmente en la lista
                                    $('#selectedList_mod').append(`
                                    <span class="badge bg-primary me-2 selected-item" data-id=${id}>
                                        ${optionText} <span class="remove-item" style="cursor: pointer;">&times;</span>
                                    </span>
                                `);

                                    // Marcar la opción como seleccionada
                                    $(`#actividad_economica_mod option[value=${id}]`)
                                        .prop('selected', true);
                                });

                                // Actualiza el input oculto para sincronizar
                                syncHiddenInputMod();

                                // Activa Select2 y muestra los valores seleccionados
                                $('#actividad_economica_mod').val(null).trigger('change');
                            } else {
                                console.warn(
                                    "No se recibieron actividades económicas o el array está vacío."
                                );
                            }
                        } else {
                            console.warn(
                                "No se encontraron actividades económicas en dato_tributario."
                            );
                        }


                        //console.log('Valor cargo_id:', camaraIdInput.val()); // Verificar que el valor se asigna
                        //console.log('Valor cargoname:', CargoInput.val()); // Verificar que el valor se asigna 

                        //$('#carga').hide();
                        Swal.close();
                        $('#ModalModificarCamara').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al momento de Cargar la Cámara',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                    }
                });
            });
            */

            $('#btn-close').on('click', function() {
                // Aquí puedes añadir la lógica para enviar el formulario modificado
                $('#ModalModificarEmpresa').modal('hide'); // Cerrar el modal después de guardar
            });

            $("#btn-modificar-empresa").on('click', async function() {

                $('#ModalModificarCamara').modal('show');

                if (!/^\d{13}$/.test($('#ruc_mod').val())) {
                    /*$("#error-ruc").show();
                    isValid = false;*/
                    $("#error-ruc-mod").show();
                    //alert('El RUC debe tener 13 dígitos');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'El RUC debe tener 13 dígitos',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#ruc_mod').focus();
                    return;
                }

                if ($('#razon_social_mod').val() == "") {
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Razón Social',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#razon_social_mod').focus();
                    return;
                }

                if ($('#id_tipo_contribuyente_mod').val() == -1) {
                    //alert('Debe seleccionar el Tipo de Contribuyente');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Tipo de Contribuyente',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#id_tipo_contribuyente_mod').focus();
                    return;
                }

                if ($('#direccion_mod').val() == "") {
                    //alert('Debe ingresar la Dirección del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Dirección de la Empresa',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#direccion_mod').focus();
                    return;
                }

                if ($('#telefono_mod').val() == "") {
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Teléfono de la Empresa',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#telefono_mod').focus();
                    return;
                }

                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($(
                        '#correo_administrativo_mod').val())) {
                    $("#error-correo-administrativo-mod").show();
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar un correo administrativo con formato válido',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });

                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#correo_administrativo_mod').focus();
                    return;
                }

                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($(
                        '#correo_comprobante_electronico_mod').val())) {
                    $("#error-correo-comprobante-electronico-mod").show();
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar un correo con formato válido',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });

                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#correo_comprobante_electronico_mod').focus();
                    return;
                }


                if ($('#id_ambiente_mod').val() == -1) {
                    //alert('Debe seleccionar el Tipo de Ambiente');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Tipo de Ambiente',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#id_ambiente_mod').focus();
                    return;
                }

                if ($('#clave_firma_mod').val() == "") {
                    //alert('Debe ingresar la Dirección del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Clave de la Firma Electrónica',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#clave_firma_mod').focus();
                    return;
                }

                var formData = new FormData(document.getElementById('ModalModificarEmpresa'));

                Swal.fire({
                    target: document.getElementById('ModalModificarEmpresa'),
                    title: 'Enviando datos para la modificación de la Empresa ',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    url: "{{ route('admin.modificar_empresa') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res) {
                    //$('#carga').hide();
                    Swal.close();
                    //alert(res.success); // Mostrar el mensaje de éxito en un alert
                    Swal.fire({
                        icon: 'success', // Cambiado a 'success' para mostrar un mensaje positivo
                        title: 'Éxito',
                        text: res.success,
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    //location.reload(); // Recargar la página
                    window.location.href = window.location.href.split('?')[0] + '?noCache=' + new Date().getTime();
                }).fail(function(res) {
                    let errorMessage = 'Ocurrió un error inesperado.';

                    // Verifica si la respuesta contiene JSON válido y el campo "error"
                    if (res.responseJSON && res.responseJSON.error) {
                        errorMessage = res.responseJSON.error; // Solo el mensaje de error
                    } else if (res.responseText) {
                        try {
                            const response = JSON.parse(res.responseText);
                            errorMessage = response.error ||
                                errorMessage; // Si existe, muestra el campo "error"
                        } catch (e) {
                            errorMessage = res.responseText; // Texto plano de la respuesta
                        }
                    }

                    // Muestra el mensaje de error en SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage,
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                });

                Swal.close();
                $('#ModalModificarCamara').modal('hide'); // Cerrar el modal después de guardar

                });
        });

    </script>
@endsection
