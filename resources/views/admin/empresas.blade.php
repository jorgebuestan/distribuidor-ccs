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
            aria-labelledby="ModalEmpresaLabel" aria-hidden="true">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalEmpresaLabel"><b>Agregar una Nueva Empresa</b></h5>
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
                                                            <option value="1">SI</option>
                                                            <option value="0">NO</option>
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
                                                        <label>Email Contacto Administrativo</label>
                                                        <input type="text" class="form-control"
                                                            name="email_administrativo"
                                                            id="email_administrativo"
                                                            placeholder="Email administrativo de la empresa">
                                                            <div id="error-correo" style="color: red; display: none;">Ingrese
                                                                un correo electrónico válido.</div>
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Contribuyente Especial</label>
                                                        <select id="contribuyente_especial" name="contribuyente_especial"
                                                            class="form-control">
                                                            <option value="1">SI</option>
                                                            <option value="0">NO</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Email Comprobantes Electrónicos</label>
                                                        <input type="text" class="form-control"
                                                            name="email_comprobante_electronico"
                                                            id="email_comprobante_electronico"
                                                            placeholder="Email para generar los comprobantes elecrónicos de la empresa">
                                                            <div id="error-correo" style="color: red; display: none;">Ingrese
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
                                                            <div id="error-correo" style="color: red; display: none;">Ingrese
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
    </div> 
  
    

    <script>
        var $j = jQuery.noConflict();
        $j(document).ready(function() {

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

            var table =  $j('#dataTable').DataTable({
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
                    { data: 'ruc', width: '45%' },
                    { data: 'razon_social', width: '45%' },
                    { data: 'btn', width: '10%' }
                ],

                order: [[0, "asc"]],
                createdRow: function(row, data, dataIndex) {
                    var td = $(row).find(".truncate");
                    td.attr("title", td.text());

                    var td2 = $(row).find(".truncate2");
                    td2.attr("title", td2.text());
                },
            });

            function syncHiddenInput() {
                $('#hiddenSelectedItems').val(selectedItems.join(',')); // Actualizar el campo oculto
                console.log('Contenido actualizado de selectedItems:', selectedItems);
            }

            let selectedItems = [];

            // Manejar eliminación de elementos seleccionados (badge)
            $('#selectedList').on('click', '.remove-item', function() {
                const badge = $(this).closest('.selected-item');
                const id = badge.data('id'); // Convertir a cadena

                // Eliminar el ID del array
                selectedItems = selectedItems.filter(item => item !== id);
                console.log(`Eliminado del array: ${id}, Nuevo contenido: ${selectedItems}`); // Depuración

                // Eliminar visualmente el badge
                badge.remove();

                // Restaurar la opción en el dropdown
                const optionElement = $(`#actividad_economica option[value=${id}]`);
                optionElement.prop('disabled', false).prop('selected', false);

                syncHiddenInput(); // Sincronizar el campo oculto
            });

            function syncHiddenInputMod() {
                $('#hiddenSelectedItemsMod').val(selectedItemsMod.join(',')); // Actualizar el campo oculto
                console.log('Contenido actualizado de selectedItemsMod:', selectedItemsMod);
            }

            let selectedItemsMod = [];

            $('#ModalEmpresa').on('show.bs.modal', function() {
                // Reiniciar el array de ítems seleccionados
                selectedItems = [];

                // Limpiar lista de badges y el campo oculto
                $('#selectedList').empty();
                $('#hiddenSelectedItems').val('');

                // Limpiar completamente el select, establecer en blanco
                console.log('Modal abierto, campos limpios');
            });

            $('#ModalEmpresa').on('hidden.bs.modal', function() {
                selectedItems = [];

                // Limpiar lista de badges y el campo oculto
                $('#selectedList').empty();
                $('#hiddenSelectedItems').val('');

            //Manejo de Upercase para el formulario de creación
            });
            
            $('#razon_social').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#direccion').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#email_administrativo').on('input', function() {
                // Convierte el valor del campo a minúscula
                $(this).val($(this).val().toLowerCase());
            });

            $('#email_comprobante_electronico').on('input', function() {
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
                    $("#error-correo").hide(); // Ocultar error
                } else {
                    $("#error-correo").show(); // Mostrar error
                }
            });

            $("#correo_administrativo_mod").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-correo-mod").hide(); // Ocultar error
                } else {
                    $("#error-correo-mod").show(); // Mostrar error
                }
            });

            // Validar campo Correo de comprobante electrónico
            $("#correo_comprobante_electronico").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-correo").hide(); // Ocultar error
                } else {
                    $("#error-correo").show(); // Mostrar error
                }
            });

            $("#correo_comrpobante_electronico_mod").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-correo-mod").hide(); // Ocultar error
                } else {
                    $("#error-correo-mod").show(); // Mostrar error
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
                    $("#error-correo").show();
                    await Swal.fire({
                        target: document.getElementById('ModalEmpresa'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar un correo con formato válido',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#correo_administrativo').focus();
                    return;
                }

                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($(
                        '#correo_comprobante_electronico').val())) {
                    $("#error-correo").show();
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

                var formData = new FormData(document.getElementById('ModalEmpresa'));

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

            $('#btn-close').on('click', function() {
                // Aquí puedes añadir la lógica para enviar el formulario modificado
                $('#ModalModificarEmpresa').modal('hide'); // Cerrar el modal después de guardar
            });

        });
    </script>
@endsection
