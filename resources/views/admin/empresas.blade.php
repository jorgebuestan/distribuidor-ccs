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
            <input type="hidden" id="empresa_id" name="empresa_id">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalEmpresaLabel"><b>Agregar Nueva Empresa</b></h5>
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
                                                        <span id="logoFileName" class="text-muted"></span>
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
                                                            <span id="firmaFileName" class="text-muted"></span>
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

                                                    // Mostrar el nombre del archivo seleccionado para el logo
                                                    document.getElementById('logoFile').addEventListener('change', function() {
                                                        const fileName = this.files[0].name;
                                                        document.getElementById('logoFileName').textContent = fileName;
                                                    });

                                                    // Mostrar el nombre del archivo seleccionado para la firma
                                                    document.getElementById('firmaFile').addEventListener('change', function() {
                                                        const fileName = this.files[0].name;
                                                        document.getElementById('firmaFileName').textContent = fileName;
                                                    });

                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id = "btn-cerrar-formulario" data-dismiss="modal">Cerrar</button>&nbsp;
                        <button type="button" class="btn btn-primary" id="btn-register-empresa">Guardar</button>
                        <button type="button" class="btn btn-warning" id="btn-modificar-empresa">Guardar Cambios</button>
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

            $('#direccion').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#correo_administrativo').on('input', function() {
                // Convierte el valor del campo a minúscula
                $(this).val($(this).val().toLowerCase());
            });

            $('#correo_comprobante_electronico').on('input', function() {
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

            $(document).on('click', '[data-target="#ModalEmpresa"]', function() {
            // Cambiar el título del modal cuando se agrega una nueva empresa
            $('#ModalEmpresaLabel').html('<b>Agregar Nueva Empresa</b>');

            // Mostrar el botón de guardar y ocultar el de modificar
            $('#btn-register-empresa').removeClass('d-none');
            $('#btn-modificar-empresa').addClass('d-none');

            // Limpiar los campos del formulario
            limpiarFormulario();
            });

            $(document).on('click', '.open-modal', function() {
                var empresaId = $(this).data('id');

                // Cambiar el título del modal
                $('#ModalEmpresaLabel').html('<b>Modificar Empresa</b>');

                // Mostrar el botón de modificar y ocultar el de guardar
                $('#btn-register-empresa').addClass('d-none');
                $('#btn-modificar-empresa').removeClass('d-none');
                
                // Asignar el ID de la empresa al campo oculto
                $('#empresa_id').val(empresaId);

                if (!empresaId) {
                    console.error('No se encontró el ID de la empresa');
                    return;
                }

                // Realizar una solicitud AJAX para obtener los datos de la empresa
                $.ajax({
                    url: "{{ route('admin.obtenerDatosEmpresa', ':id') }}".replace(':id', empresaId),
                    method: 'GET',
                    success: function(response) {
                        // Verificar si la respuesta contiene los datos esperados
                        if (response && response.ruc) {
                            // Llenar los campos del modal con los datos de la empresa
                            $('#ruc').val(response.ruc);
                            $('#razon_social').val(response.razon_social);
                            $('#direccion').val(response.direccion);
                            $('#telefono').val(response.telefono);
                            $('#correo_administrativo').val(response.correo_administrativo);
                            $('#correo_comprobante_electronico').val(response.correo_comprobante_electronico);
                            $('#id_tipo_contribuyente').val(response.id_tipo_contribuyente);
                            $('#obligado_contabilidad').val(response.obligado_contabilidad);
                            $('#contribuyente_especial').val(response.contribuyente_especial);
                            $('#id_ambiente').val(response.id_ambiente);
                            $('#clave_firma').val(response.clave_firma);

                            // Mostrar el modal
                            $('#ModalEmpresa').modal('show');
                        } else {
                            console.error('La respuesta del servidor no contiene los datos esperados');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'La respuesta del servidor no contiene los datos esperados',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error en la solicitud AJAX:', xhr.responseText);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Error al obtener los datos de la empresa: ' + (xhr.responseText || 'Error desconocido'),
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                    }
                });
            });

            $(document).on('click', '#btn-modificar-empresa', async function() {

                let shouldCloseModal = false;

                if (await validarFormulario()){
                    var empresaId = $('#empresa_id').val(); // Obtener ID de la empresa

                    if (!empresaId) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se encontró el ID de la empresa para modificar.',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        return;
                    }

                    var formData = new FormData(document.getElementById('ModalEmpresa'));
                    formData.append('id_empresa', empresaId); // Agregar ID al formulario

                    Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
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
                        Swal.close();
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: res.message,
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        shouldCloseModal = true;
                        window.location.reload(); // Recargar la página
                    }).fail(function(res) {
                        let errorMessage = 'Ocurrió un error inesperado.';

                        if (res.responseJSON && res.responseJSON.message) {
                            errorMessage = res.responseJSON.message;
                        } else if (res.responseText) {
                            try {
                                const response = JSON.parse(res.responseText);
                                errorMessage = response.message || errorMessage;
                            } catch (e) {
                                errorMessage = res.responseText;
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                    });
                }

                if (shouldCloseModal){
                    $('#ModalEmpresa').modal('hide'); // Cerrar el modal después de guardar
                }
            });    

            $("#btn-register-empresa").click(async function() {

                let shouldCloseModal = false;

                if (await validarFormulario()){
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
                        shouldCloseModal = true;
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

                        console.log(res.responseText); // Muestra el error completo en la consola para depuración
                    });
                }

                if (shouldCloseModal){
                    $('#ModalEmpresa').modal('hide'); // Cerrar el modal después de guardar
                }
            });

                // Mostrar el nombre del archivo seleccionado para el logo
            document.getElementById('logoFile').addEventListener('change', function() {
                const fileName = this.files[0].name;
                document.getElementById('logoFileName').textContent = fileName;
            });

            // Mostrar el nombre del archivo seleccionado para la firma
            document.getElementById('firmaFile').addEventListener('change', function() {
                const fileName = this.files[0].name;
                document.getElementById('firmaFileName').textContent = fileName;
            });

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
                    document.getElementById('firmaFileName').textContent = files[0].name; // Mostrar el nombre del archivo
                }
            });

        });
    </script>

    <script>
        async function validarFormulario() {
            if (!/^\d{13}$/.test($('#ruc').val())) {
                $("#error-ruc").show();
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
                return false;
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
                return false;
            }

            if ($('#id_tipo_contribuyente').val() == -1) {
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
                return false;
            }

            if ($('#direccion').val() == "") {
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
                return false;
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
                return false;
            }

            if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($('#correo_administrativo').val())) {
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
                return false;
            }

            if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($('#correo_comprobante_electronico').val())) {
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
                return false;
            }

            if ($('#id_ambiente').val() == -1) {
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
                return false;
            }

            if ($('#clave_firma').val() == "") {
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
                return false;
            }

            return true;
        }
    </script>

    <script>
        function limpiarFormulario() {
            $('#ModalEmpresa').find('input[type="text"], input[type="email"], input[type="file"], select').val('');
            $('#ModalEmpresa').find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
            $('#ModalEmpresa').find('textarea').val('');
            $('#ModalEmpresa').find('select').prop('selectedIndex', 0);
            $('#error-ruc').hide();
            $('#error-correo-administrativo').hide();
            $('#error-correo-comprobante-electronico').hide();
            $('#logoFileName').text(''); // Limpiar el nombre del archivo del logo
            $('#firmaFileName').text(''); // Limpiar el nombre del archivo de la firma
        }
    </script>


@endsection
