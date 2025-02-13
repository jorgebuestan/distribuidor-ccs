@extends('dashboard')

@section('pagename')
    Maestro de Cámaras
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/i18n/datepicker-es.js"></script>

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
                        <h2 class="card-title">Gestión de Cámaras</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#ModalCamara">Agregar Nuevo Registro</button>
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
                            <div class="col-md-1 d-flex align-items-end">
                                Estado
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                    <select id="estado_camara" name="estado_camara" class="form-control populate">  
                                        <option value=1>Todos</option> 
                                        <option value=2>Afiliados</option> 
                                        <option value=3>Desafiliados</option> 
                                    </select>
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
                                        <h2 class="card-title">Listado de Cámaras Registradas</h2>
                                    </header>
                                    <div class="card-body overflow-x-auto max-w-full">
                                        <table class="table table-bordered table-striped mb-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>FECHA DE INGRESO</th>
                                                    <th>RUC</th>
                                                    <th>RAZÓN SOCIAL</th>
                                                    <th>REPRESENTANTE LEGAL</th>
                                                    <th>CÉDULA REP. LEGAL</th>
                                                    <!-- <th>Estado</th> --> 
                                                    <th>FECHA DESAFILIACIÓN</th>
                                                    <th>MOTIVO DESAFILIACIÓN</th>
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
        <form enctype="multipart/form-data" class="modal fade" id="ModalCamara" tabindex="-1"
            aria-labelledby="ModalCamaraLabel" aria-hidden="true">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalCamaraLabel"><b>Agregar una Nueva Cámara de Comercio</b></h5>
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
                                                    <div class="col-md-6 gap-1">
                                                        <label>Fecha de Ingreso</label>
                                                        <input type="text" data-plugin-datepicker class="form-control"
                                                            name="fecha_ingreso" id="fecha_ingreso"
                                                            placeholder="Fecha de Ingreso">
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>RUC</label>
                                                        <input type="text" class="form-control" name="ruc"
                                                            id="ruc" placeholder="RUC de la Cámara">
                                                        <div id="error-ruc" style="color: red; display: none;">El RUC debe
                                                            tener
                                                            13 dígitos.</div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>Razón Social</label>
                                                        <input type="text" class="form-control" name="razon_social"
                                                            id="razon_social" placeholder="Razón Social">
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Cédula Representante Legal</label>
                                                        <input type="text" class="form-control"
                                                            name="cedula_representante_legal"
                                                            id="cedula_representante_legal"
                                                            placeholder="Cédula Representante Legal">
                                                        <div id="error-cedula" style="color: red; display: none;">La
                                                            Cédula debe tener 10 dígitos.</div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>Nombres Representante Legal</label>
                                                        <input type="text" class="form-control"
                                                            name="nombres_representante_legal"
                                                            id="nombres_representante_legal"
                                                            placeholder="Nombres Representante Legal">
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Apellidos Representante Legal</label>
                                                        <input type="text" class="form-control"
                                                            name="apellidos_representante_legal"
                                                            id="apellidos_representante_legal"
                                                            placeholder="Apellidos Representante Legal">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6">
                                                        <label>Teléfono Representante Legal</label>
                                                        <input type="text" class="form-control"
                                                            name="telefono_representante_legal"
                                                            id="telefono_representante_legal"
                                                            placeholder="Teléfono Representante Legal">
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <label>Correo Representante Legal</label>
                                                        <input type="text" class="form-control"
                                                            name="correo_representante_legal"
                                                            id="correo_representante_legal"
                                                            placeholder="Correo Representante Legal">
                                                        <div id="error-correo" style="color: red; display: none;">Ingrese
                                                            un correo electrónico válido.</div>
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <label>Cargo Representante Legal</label>
                                                        <input type="text" class="form-control"
                                                            name="cargo_representante_legal"
                                                            id="cargo_representante_legal"
                                                            placeholder="Cargo Representante Legal">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label>Dirección Representante Legal</label>
                                                        <input type="text" class="form-control"
                                                            name="direccion_representante_legal"
                                                            id="direccion_representante_legal"
                                                            placeholder="Dirección Representante Legal">
                                                    </div>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-12 flex flex-col gap-1">
                                                        <label>Logo</label>
                                                        <input type="file" class="form-control-file" id="logoFile"
                                                            name="file">
                                                        <input type="hidden" name="tipoDoc" value="1">
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>&nbsp;
                        <button type="button" class="btn btn-primary" id="btn-register-camara">Guardar</button>
                    </div>
                </div>
            </div>
        </form> 
    </div> 
  

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            let camara_selected = null;
            let camaras = [];
            Swal.fire({
                title: 'Cargando',
                text: 'Por favor espere',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            var table = $('#dataTable').DataTable({
    destroy: true,
    processing: false,
    serverSide: true,
    ajax: {
      url: "",
      type: "GET",
      data: function(d) {
        d.start = d.start || 0;
        d.length = d.length || 10;
        d.estado = $('#estado_camara').val(); // Enviar el valor de localidad seleccionada
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
        camaras = response.responseJSON.data;
        Swal.close();
      },
    },
    pageLength: 10,
    columns: [
      { data: 'fecha_ingreso', width: '3%' },
      { data: 'ruc', width: '5%' },
      { data: 'razon_social', width: '20%' },
      { data: 'representante_legal', width: '15%' },
      { data: 'cedula_representante_legal', width: '15%' },
      {
        data: 'fecha_desafiliacion',
        width: '3%'
      },
      {
        data: 'motivo_desafiliacion',
        width: '10%'
      }, 
      { data: 'btn', width: '30%' }
    ],
    order: [[0, "asc"]],
    createdRow: function(row, data, dataIndex) {
      var td = $(row).find(".truncate");
      td.attr("title", td.text());

      var td2 = $(row).find(".truncate2");
      td2.attr("title", td2.text());
    }
  });

            $('#estado_camara').change(function() { 
                Swal.fire({
                    title: 'Cargando',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                table.ajax.reload(); // Recargar la tabla con la cámara seleccionada 
            });
            // Inicializar Select2 con búsqueda habilitada
            // Inicializar Select2
            // Inicializar Select2
            $('#actividad_economica').select2({
                placeholder: "Selecciona una o más opciones",
                width: '100%',
                allowClear: true
            });

            function syncHiddenInput() {
                $('#hiddenSelectedItems').val(selectedItems.join(',')); // Actualizar el campo oculto
                console.log('Contenido actualizado de selectedItems:', selectedItems);
            }

            let selectedItems = [];

            // Manejar selección de elementos
            $('#actividad_economica').on('select2:select', function(e) {
                const selectedId = parseInt(e.params.data.id); // Convertir a cadena
                const selectedText = e.params.data.text;

                if (!selectedItems.includes(selectedId)) {
                    selectedItems.push(selectedId); // Agregar al array como cadena
                    $('#selectedList').append(`
                <span class="badge bg-primary me-2 selected-item" data-id=${selectedId}>
                    ${selectedText} <span class="remove-item" style="cursor: pointer;">&times;</span>
                </span>
            `);
                    syncHiddenInput(); // Sincronizar el campo oculto
                }

                $(this).val(null).trigger('change'); // Resetear el dropdown
            });

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

            // Sincronizar al quitar desde el dropdown
            $('#actividad_economica').on('select2:unselect', function(e) {
                const unselectedId = (e.params.data.id); // Convertir a cadena

                // Eliminar visualmente el badge
                $(`#selectedList .selected-item[data-id=${unselectedId}]`).remove();

                // Eliminar el ID del array
                selectedItems = selectedItems.filter(item => item !== unselectedId);
                console.log(
                    `Eliminado desde dropdown: ${unselectedId}, Nuevo contenido: ${selectedItems}`
                ); // Depuración

                syncHiddenInput(); // Sincronizar el campo oculto
            });

            // Actualizar el array 'selectedItems' cuando cambie la selección en Select2
            /*$('#actividad_economica').on('change', function () {
                selectedItems = $(this).val() || []; // Sincronizar con los valores seleccionados reales
            });*/

            //Para el Mod
            $('#actividad_economica_mod').select2({
                placeholder: "Selecciona una o más opciones",
                width: '100%',
                allowClear: true
            });

            function syncHiddenInputMod() {
                $('#hiddenSelectedItemsMod').val(selectedItemsMod.join(',')); // Actualizar el campo oculto
                console.log('Contenido actualizado de selectedItemsMod:', selectedItemsMod);
            }

            let selectedItemsMod = [];

            // Manejar selección de elementos
            $('#actividad_economica_mod').on('select2:select', function(e) {
                const selectedId = parseInt(e.params.data.id); // Convertir a cadena
                const selectedText = e.params.data.text;

                if (!selectedItemsMod.includes(selectedId)) {
                    selectedItemsMod.push(selectedId); // Agregar el ID al array
                    $('#selectedList_mod').append(`
                    <span class="badge bg-primary me-2 selected-item" data-id=${selectedId}>
                        ${selectedText} <span class="remove-item" style="cursor: pointer;">&times;</span>
                    </span>
                `);

                    syncHiddenInputMod(); // Sincronizar el campo oculto
                }

                $(this).val(null).trigger('change'); // Resetear el dropdown
            });

            // Manejar eliminación de elementos seleccionados (badge)
            $('#selectedList_mod').on('click', '.remove-item', function() {
                const badge = $(this).closest('.selected-item');
                const id = (badge.data('id')); // Convertir a cadena

                // Eliminar el ID del array
                selectedItemsMod = selectedItemsMod.filter(item => item !== id);
                console.log(
                    `Eliminado del array Mod: ${id}, Nuevo contenido Mod: ${selectedItemsMod}`
                ); // Depuración

                // Eliminar visualmente el badge
                badge.remove();

                // Restaurar la opción en el dropdown
                const optionElement = $(`#actividad_economica_mod option[value=${id}]`);
                optionElement.prop('disabled', false).prop('selected', false);

                syncHiddenInputMod(); // Sincronizar el campo oculto
            });

            // Sincronizar al quitar desde el dropdown
            $('#actividad_economica_mod').on('select2:unselect', function(e) {
                const unselectedId = e.params.data.id; // Convertir a cadena

                // Eliminar visualmente el badge
                $(`#selectedList_mod .selected-item[data-id=${unselectedId}]`).remove();

                // Eliminar el ID del array
                selectedItemsMod = selectedItemsMod.filter(item => item !== unselectedId);
                console.log(
                    `Eliminado desde dropdown Mod: ${unselectedId}, Nuevo contenido Mod: ${selectedItemsMod}`
                ); // Depuración

                syncHiddenInputMod(); // Sincronizar el campo oculto
            });


            $('#ModalCamara').on('show.bs.modal', function() {
                // Reiniciar el array de ítems seleccionados
                selectedItems = [];

                // Limpiar lista de badges y el campo oculto
                $('#selectedList').empty();
                $('#hiddenSelectedItems').val('');

                // Limpiar completamente el select, establecer en blanco
                $('#actividad_economica').val([]).trigger('change'); // Para select2 u otros plugins
                $('#actividad_economica option:selected').prop('selected', false); // Fuerza la deselección
                console.log('Modal abierto, campos limpios');
            });

            $('#ModalCamara').on('hidden.bs.modal', function() {
                selectedItems = [];

                // Limpiar lista de badges y el campo oculto
                $('#selectedList').empty();
                $('#hiddenSelectedItems').val('');

                // Limpiar completamente el select, establecer en blanco
                $('#actividad_economica').val([]).trigger('change'); // Para select2 u otros plugins
                $('#actividad_economica option:selected').prop('selected', false); // Fuerza la deselección
                console.log('Modal abierto, campos limpios');
            });


            //Manejo de Fechas
            // Función para validar el formato dd/mm/yyyy
            function esFechaValida(fecha) {
                // Expresión regular para validar el formato dd/mm/yyyy
                var regex = /^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/;

                if (!regex.test(fecha)) {
                    return false; // No cumple con el formato
                }

                // Validación adicional para asegurar que la fecha sea válida en el calendario
                var partes = fecha.split('/'); // Divide la fecha por '/'
                var dia = parseInt(partes[0], 10);
                var mes = parseInt(partes[1], 10) - 1; // Mes en JavaScript es 0-indexado
                var anio = parseInt(partes[2], 10);

                var fechaObj = new Date(anio, mes, dia);

                return (
                    fechaObj.getDate() === dia &&
                    fechaObj.getMonth() === mes &&
                    fechaObj.getFullYear() === anio
                );
            }

            // Evento para validar la fecha al salir del campo
            $('#fecha_ingreso').on('blur', function() {
                var fecha = $(this).val();

                if (fecha && !esFechaValida(fecha)) {
                    alert('Por favor, ingrese una fecha válida en el formato dd/mm/yyyy.');
                    $(this).val(''); // Limpia el campo de entrada

                    // Retrasa el enfoque al campo para evitar el bucle infinito
                    setTimeout(() => {
                        $(this).focus();
                    }, 0);
                }
            });

            // Evento para validar la fecha al salir del campo
            $('#fecha_registro').on('blur', function() {
                var fecha = $(this).val();

                if (fecha && !esFechaValida(fecha)) {
                    alert('Por favor, ingrese una fecha válida en el formato dd/mm/yyyy.');
                    $(this).val(''); // Limpia el campo de entrada

                    // Retrasa el enfoque al campo para evitar el bucle infinito
                    setTimeout(() => {
                        $(this).focus();
                    }, 0);
                }
            });

            // Evento para validar la fecha al salir del campo
            $('#fecha_constitucion').on('blur', function() {
                var fecha = $(this).val();

                if (fecha && !esFechaValida(fecha)) {
                    alert('Por favor, ingrese una fecha válida en el formato dd/mm/yyyy.');
                    $(this).val(''); // Limpia el campo de entrada

                    // Retrasa el enfoque al campo para evitar el bucle infinito
                    setTimeout(() => {
                        $(this).focus();
                    }, 0);
                }
            });

            // Evento para validar la fecha al salir del campo
            $('#fecha_ingreso_mod').on('blur', function() {
                var fecha = $(this).val();

                if (fecha && !esFechaValida(fecha)) {
                    alert('Por favor, ingrese una fecha válida en el formato dd/mm/yyyy.');
                    $(this).val(''); // Limpia el campo de entrada

                    // Retrasa el enfoque al campo para evitar el bucle infinito
                    setTimeout(() => {
                        $(this).focus();
                    }, 0);
                }
            });

            // Evento para validar la fecha al salir del campo
            $('#fecha_registro_mod').on('blur', function() {
                var fecha = $(this).val();

                if (fecha && !esFechaValida(fecha)) {
                    alert('Por favor, ingrese una fecha válida en el formato dd/mm/yyyy.');
                    $(this).val(''); // Limpia el campo de entrada

                    // Retrasa el enfoque al campo para evitar el bucle infinito
                    setTimeout(() => {
                        $(this).focus();
                    }, 0);
                }
            });

            // Evento para validar la fecha al salir del campo
            $('#fecha_constitucion_mod').on('blur', function() {
                var fecha = $(this).val();

                if (fecha && !esFechaValida(fecha)) {
                    alert('Por favor, ingrese una fecha válida en el formato dd/mm/yyyy.');
                    $(this).val(''); // Limpia el campo de entrada

                    // Retrasa el enfoque al campo para evitar el bucle infinito
                    setTimeout(() => {
                        $(this).focus();
                    }, 0);
                }
            });

            //Manejo de Upercase 
            $('#razon_social').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#nombres_representante_legal').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#apellidos_representante_legal').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            /*$('#telefono_representante_legal').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });*/

            $('#telefono_representante_legal').on('input', function() {
                let value = $(this).val();
                // Eliminar todos los caracteres no numéricos excepto el guion
                value = value.replace(/[^0-9]/g, '');
                
                // Limitar el campo a un máximo de 11 caracteres (10 dígitos + 1 guion)
                if (value.length > 11) {
                    value = value.slice(0, 11);
                }
                $(this).val(value);
            });

            $('#cargo_representante_legal').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#direccion_representante_legal').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#calle').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#manzana').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#numero').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#interseccion').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#referencia').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#razon_social_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#nombres_representante_legal_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#apellidos_representante_legal_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            /*$('#telefono_representante_legal_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });*/

            $('#telefono_representante_legal_mod').on('input', function() {
                let value = $(this).val();
                // Eliminar todos los caracteres no numéricos excepto el guion
                value = value.replace(/[^0-9]/g, '');
                
                // Limitar el campo a un máximo de 11 caracteres (10 dígitos + 1 guion)
                if (value.length > 11) {
                    value = value.slice(0, 11);
                }
                $(this).val(value);
            });

            $('#cargo_representante_legal_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#direccion_representante_legal_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#calle_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#manzana_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#numero_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#interseccion_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#referencia_mod').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            // Evento para recargar el DataTable cuando cambia el valor del select de localidad
            $('#localidad').on('change', function() {
                table.ajax.reload();
            });

            function showFileDocumentoCargo(id) {
                $.ajax({
                    url: "{{ asset('/documentosCargo/file/') }}/" + id,
                    type: "get",
                    dataType: "html",
                    contentType: false,
                    processData: false
                }).done(function(res) {
                    url = JSON.parse(res).response.url
                    //http://miexperienciaune.test/colaborador/
                    //window.open('storage/'+url,'_blank');
                    var rutaRaiz = window.location.origin;
                    window.open(rutaRaiz + '/storage/' + url, '_blank');
                }).fail(function(res) {
                    console.log(res)
                });
            }

            //jbuestan   

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

            $("#cedula_representante_legal").on("input", function() {
                var cedula = $(this).val();
                if (/^\d{10}$/.test(cedula)) { // Si tiene exactamente 13 dígitos
                    $("#error-cedula").hide(); // Ocultar error
                } else {
                    $("#error-cedula").show(); // Mostrar error
                }
            });

            $("#cedula_representante_legal_mod").on("input", function() {
                var cedula = $(this).val();
                if (/^\d{10}$/.test(cedula)) { // Si tiene exactamente 13 dígitos
                    $("#error-cedula-mod").hide(); // Ocultar error
                } else {
                    $("#error-cedula-mod").show(); // Mostrar error
                }
            });

            // Validar campo Correo
            $("#correo_representante_legal").on("input", function() {
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

            $("#correo_representante_legal_mod").on("input", function() {
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

            $('#fecha_constitucion, #fecha_registro').on('change', function() {
                var fechaConstitucion = $('#fecha_constitucion').val();
                var fechaRegistro = $('#fecha_registro').val();

                // Función para convertir fecha en formato dd/mm/yyyy a objeto Date
                function convertirFecha(fecha) {
                    var partes = fecha.split('/');
                    // partes[0] = día, partes[1] = mes, partes[2] = año
                    return new Date(partes[2], partes[1] - 1, partes[0]); // El mes es base 0
                }

                // Validar que fecha_constitucion sea menor a fecha_registro
                if (fechaConstitucion && fechaRegistro) {
                    var fechaConstitucionDate = convertirFecha(fechaConstitucion);
                    var fechaRegistroDate = convertirFecha(fechaRegistro);

                    if (fechaConstitucionDate >= fechaRegistroDate) {
                        $('#error-fecha-constitucion').show();
                    } else {
                        $('#error-fecha-constitucion').hide();
                    }
                }

                // Calcular años y meses desde fecha_constitucion hasta la fecha actual
                if (fechaConstitucion) {
                    var hoy = new Date();
                    var fechaConstitucionDate = convertirFecha(fechaConstitucion);

                    var years = hoy.getFullYear() - fechaConstitucionDate.getFullYear();
                    var months = hoy.getMonth() - fechaConstitucionDate.getMonth();

                    if (months < 0) {
                        years--;
                        months += 12;
                    }

                    $('#anios_creacion').val(years + ' años, ' + months + ' meses');
                }
            });

            $('#fecha_constitucion_mod, #fecha_registro_mod').on('change', function() {
                var fechaConstitucion = $('#fecha_constitucion_mod').val();
                var fechaRegistro = $('#fecha_registro_mod').val();

                // Función para convertir fecha en formato dd/mm/yyyy a objeto Date
                function convertirFecha(fecha) {
                    var partes = fecha.split('/');
                    // partes[0] = día, partes[1] = mes, partes[2] = año
                    return new Date(partes[2], partes[1] - 1, partes[0]); // El mes es base 0
                }

                // Validar que fecha_constitucion sea menor a fecha_registro
                if (fechaConstitucion && fechaRegistro) {
                    var fechaConstitucionDate = convertirFecha(fechaConstitucion);
                    var fechaRegistroDate = convertirFecha(fechaRegistro);

                    if (fechaConstitucionDate >= fechaRegistroDate) {
                        $('#error-fecha-constitucion-mod').show();
                    } else {
                        $('#error-fecha-constitucion-mod').hide();
                    }
                }

                // Calcular años y meses desde fecha_constitucion hasta la fecha actual
                if (fechaConstitucion) {
                    var hoy = new Date();
                    var fechaConstitucionDate = convertirFecha(fechaConstitucion);

                    var years = hoy.getFullYear() - fechaConstitucionDate.getFullYear();
                    var months = hoy.getMonth() - fechaConstitucionDate.getMonth();

                    if (months < 0) {
                        years--;
                        months += 12;
                    }

                    $('#anios_creacion_mod').val(years + ' años, ' + months + ' meses');
                }
            });

            $("#btn-register-camara").click(async function() {

                //alert($('#hiddenSelectedItems').val());
                //return;

                if ($('#fecha_ingreso').val() == "") {
                    //alert('Debe ingresar la Fecha de Ingreso de la Cámara');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Fecha de Ingreso de la Cámara',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#fecha_ingreso').focus();
                    return;
                }

                if (!/^\d{13}$/.test($('#ruc').val())) {
                    /*$("#error-ruc").show();
                    isValid = false;*/
                    $("#error-ruc").show();
                    //alert('El RUC debe tener 13 dígitos');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
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
                    //alert('Debe ingresar la Razón Social');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
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

                if (!/^\d{10}$/.test($('#cedula_representante_legal').val())) {
                    /*$("#error-ruc").show();
                    isValid = false;*/
                    $("#error-cedula").show();
                    //alert('La Cédula del Representante Legal debe tener 10 dígitos');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'La Cédula del Representante Legal debe tener 10 dígitos',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#cedula_representante_legal').focus();
                    return;
                }

                if ($('#nombres_representante_legal').val() == "") {
                    //alert('Debe ingresar los Nombres del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar los Nombres del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#nombres_representante_legal').focus();
                    return;
                }

                if ($('#apellidos_representante_legal').val() == "") {
                    //alert('Debe ingresar los Apellidos del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar los Apellidos del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#apellidos_representante_legal').focus();
                    return;
                }

                if ($('#telefono_representante_legal').val() == "") {
                    //alert('Debe ingresar el Teléfono del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Teléfono del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#telefono_representante_legal').focus();
                    return;
                }


                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($(
                        '#correo_representante_legal').val())) {
                    /*$("#error-correo").show();
                    isValid = false;*/
                    $("#error-correo").show();
                    //alert('Debe registrar un correo con formato válido');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar un correo con formato válido',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#correo_representante_legal').focus();
                    return;
                }

                if ($('#cargo_representante_legal').val() == "") {
                    //alert('Debe ingresar el Cargo del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Cargo del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#cargo_representante_legal').focus();
                    return;
                }

                if ($('#direccion_representante_legal').val() == "") {
                    //alert('Debe ingresar la Dirección del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Dirección del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales"]').tab('show');
                    $('#direccion_representante_legal').focus();
                    return;
                }

                if ($('#tipo_regimen').val() == "-1") {
                    //alert('Debe seleccionar un Tipo de Régimen');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar un Tipo de Régimen',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#tipo_regimen').focus();
                    return;
                }

                if ($('#fecha_registro').val() == "") {
                    //alert('Debe ingresar la Fecha de Registro de la Cámara');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Fecha de Registro de la Cámara',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#fecha_registro').focus();
                    return;
                }

                if ($('#fecha_constitucion').val() == "") {
                    //alert('Debe ingresar la Fecha de Constitución de la Cámara');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Fecha de Constitución de la Cámara',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#fecha_constitucion').focus();
                    return;
                }

                // Función para convertir una fecha en formato dd/mm/yyyy a objeto Date
                function convertirFechaAObjetoDate(fecha) {
                    if (!fecha) return new Date(
                        'Invalid Date'); // Retorna una fecha inválida si la entrada es nula
                    var partes = fecha.split('/'); // Divide la fecha por '/'
                    return new Date(partes[2], partes[1] - 1, partes[0]); // Formato DD/MM/YYYY
                }

                // Validación de que la Fecha de Constitución sea menor a la Fecha de Registro
                var fechaConstitucion = $('#fecha_constitucion').val();
                var fechaRegistro = $('#fecha_registro').val();

                if (fechaConstitucion && fechaRegistro) {
                    // Convertir las fechas al formato correcto
                    var fechaConstitucionDate = convertirFechaAObjetoDate(fechaConstitucion);
                    var fechaRegistroDate = convertirFechaAObjetoDate(fechaRegistro);

                    // Validar si las fechas son válidas
                    if (!isNaN(fechaConstitucionDate.getTime()) && !isNaN(fechaRegistroDate
                            .getTime())) {
                        if (fechaConstitucionDate >= fechaRegistroDate) {
                            //alert('La Fecha de Constitución debe ser menor a la Fecha de Registro');
                            await Swal.fire({
                                target: document.getElementById('ModalCamara'),
                                icon: 'error',
                                title: 'Error',
                                text: 'La Fecha de Constitución debe ser menor a la Fecha de Registro',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                            });
                            $('#error-fecha-constitucion').show();
                            $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                            $('#fecha_constitucion').focus();
                            return;
                        }
                    }
                    /*else {
                                           //alert('Una o ambas fechas no son válidas. Por favor, verifica los campos.');
                                           await Swal.fire({ 
                                                   target: document.getElementById('ModalCamara'),
                                                   icon: 'error',
                                                   title: 'Error',
                                                   text: 'Una o ambas fechas no son válidas. Por favor, verifica los campos.',
                                                   confirmButtonText: 'Aceptar',
                                                   allowOutsideClick: false
                                               });
                                           return;
                                       }*/
                }

                if ($('#agente_retencion').val() == "-1") {
                    //alert('Debe indicar si la Cámara es o no un Agente de Retención');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe indicar si la Cámara es o no un Agente de Retención',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#agente_retencion').focus();
                    return;
                }

                if ($('#contribuyente_especial').val() == "-1") {
                    //alert('Debe indicar si la Cámara es o no un Contribuyente Especial');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe indicar si la Cámara es o no un Contribuyente Especial',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#contribuyente_especial').focus();
                    return;
                }

                if ($('#pais').val() == "-1") {
                    //alert('Debe seleccionar el País');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el País',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#pais').focus();
                    return;
                }

                if ($('#provincia').val() == "-1") {
                    //alert('Debe seleccionar la Provincia');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar la Provincia',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#provincia').focus();
                    return;
                }

                if ($('#canton').val() == "-1") {
                    //alert('Debe seleccionar el Cantón');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Cantón',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#canton').focus();
                    return;
                }

                if ($('#parroquia').val() == "-1") {
                    //alert('Debe seleccionar la Parroquia');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar la Parroquia',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#parroquia').focus();
                    return;
                }

                if ($('#calle').val() == "") {
                    //alert('Debe ingresar la Calle en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Calle en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#calle').focus();
                    return;
                }

                if ($('#manzana').val() == "") {
                    //alert('Debe ingresar la Manzana en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Manzana en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#manzana').focus();
                    return;
                }

                if ($('#numero').val() == "") {
                    // alert('Debe ingresar el Número en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Número en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#numero').focus();
                    return;
                }

                if ($('#interseccion').val() == "") {
                    //alert('Debe ingresar la Intersección en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Intersección en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#interseccion').focus();
                    return;
                }

                if ($('#referencia').val() == "") {
                    //alert('Debe ingresar la Referencia en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Referencia en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#referencia').focus();
                    return;
                }

                if ($('#hiddenSelectedItems').val() == "") {
                    //alert('Debe seleccionar al menos una Actividad Económica');
                    await Swal.fire({
                        target: document.getElementById('ModalCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar al menos una Actividad Económica',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#hiddenSelectedItems').focus();
                    return;
                }

                var formData = new FormData(document.getElementById("ModalCamara"));
                //$('#carga').show();
                Swal.fire({
                    target: document.getElementById('ModalCamara'),
                    title: 'Enviando datos para registro de Cámara',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    url: "",
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
                        target: document.getElementById('ModalCamara'),
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
                                target: document.getElementById('ModalCamara'),
                                icon: 'error',
                                title: 'Error',
                                text: errors.error,
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                            });
                        }
                    } else {
                        // Mostrar mensaje genérico si no se recibió un error específico
                        //alert("Ocurrió un error al registrar la cámara.");
                        Swal.fire({
                            target: document.getElementById('ModalCamara'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error al registrar la cámara.',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                    }

                    console.log(res
                        .responseText
                    ); // Muestra el error completo en la consola para depuración
                });
            });


            /*function convertirFecha(fecha) {
                const partes = fecha.split('-'); // Divide la fecha en partes [YYYY, MM, DD]
                return `${partes[1]}/${partes[2]}/${partes[0]}`; // Reordena en formato MM/DD/YYYY
            }*/

            function convertirFecha(fechaISO) {
                if (!fechaISO) return ''; // Maneja casos nulos o indefinidos
                const partes = fechaISO.split('-'); // Divide por guión
                return `${partes[2]}/${partes[1]}/${partes[0]}`; // Formato DD/MM/YYYY
            }

            // Establecer el idioma de forma global para todos los datepickers
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
                    'Dic'
                ],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            };
            $.datepicker.setDefaults($.datepicker.regional['es']);

            $('#fecha_ingreso').datepicker('destroy').datepicker({
                format: 'dd/mm/yyyy', // Define el formato de fecha
                autoclose: true, // Cierra automáticamente al seleccionar
                todayHighlight: true, // Resalta la fecha actual
                language: 'es' // Asegúrate de establecer el idioma correcto
            });


            $('#fecha_registro').datepicker('destroy').datepicker({
                format: 'dd/mm/yyyy', // Define el formato de fecha
                autoclose: true, // Cierra automáticamente al seleccionar
            });


            $('#fecha_constitucion').datepicker('destroy').datepicker({
                format: 'dd/mm/yyyy', // Define el formato de fecha
                autoclose: true, // Cierra automáticamente al seleccionar
            });


            $('#fecha_ingreso_mod').datepicker('destroy').datepicker({
                format: 'dd/mm/yyyy', // Define el formato de fecha
                autoclose: true, // Cierra automáticamente al seleccionar
            });

            // Destruir el datepicker si ya está inicializado y volver a inicializarlo con formato adecuado
            $('#fecha_registro_mod').datepicker('destroy').datepicker({
                format: 'mm/dd/yyyy', // Define el formato de fecha
                autoclose: true // Cierra automáticamente al seleccionar
            });

            $('#fecha_constitucion_mod').datepicker('destroy').datepicker({
                format: 'mm/dd/yyyy', // Define el formato de fecha
                autoclose: true, // Cierra automáticamente al seleccionar
            });

            $('#swal-fecha').datepicker('destroy').datepicker({
                format: 'dd/mm/yyyy', // Define el formato de fecha
                autoclose: true, // Cierra automáticamente al seleccionar
                todayHighlight: true, // Resalta la fecha actual
                language: 'es' // Asegúrate de establecer el idioma correcto
            });

            // Delegar el evento de clic al documento para asegurar que funcione con elementos dinámicos
            $(document).on('click', '.open-modal', function() {
                console.log('Botón clicado...');
                var button = $(this);
                var camaraId = button.data('id');

                console.log('Cargo ID:', camaraId);

                //$('#carga').show();
                Swal.fire({
                    title: 'Cargando información de Cámara',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                // **LIMPIAR EL SELECT Y EL INPUT HIDDEN ANTES DE CARGAR DATOS**
                selectedItemsMod = []; // Vaciar el array de actividades económicas seleccionadas
                $('#selectedList_mod').empty(); // Vaciar la lista de badges visuales
                $('#actividad_economica_mod').val(null).trigger(
                    'change'); // Limpiar y deseleccionar el select2
                $('#hiddenSelectedItemsMod').val(''); // Limpiar el input hidden


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

            $('#btn-close').on('click', function() {
                // Aquí puedes añadir la lógica para enviar el formulario modificado
                $('#ModalModificarCamara').modal('hide'); // Cerrar el modal después de guardar
            });

            // Función para cargar provincias
            function cargarProvincias(paisId) {
                return $.ajax({
                    url: '/get-provincias',
                    method: 'GET',
                    data: {
                        id_pais: paisId
                    },
                    success: function(response) {
                        let provincias = response.provincias;
                        let $provinciaSelect = $('#provincia_mod');
                        $provinciaSelect.empty().append('<option value=-1>Seleccionar</option>');

                        provincias.forEach(function(provincia) {
                            $provinciaSelect.append(
                                `<option value=${provincia.id}>${provincia.nombre}</option>`
                            );
                        });
                    },
                    error: function() {
                        alert('Hubo un error al cargar las provincias.');
                    }
                });
            }

            // Función para cargar cantones
            function cargarCantones(paisId, provinciaId) {
                return $.ajax({
                    url: '/get-cantones',
                    method: 'GET',
                    data: {
                        id_pais: paisId,
                        id_provincia: provinciaId
                    },
                    success: function(response) {
                        let cantones = response.cantones;
                        let $cantonSelect = $('#canton_mod');
                        $cantonSelect.empty().append('<option value=-1>Seleccionar</option>');

                        cantones.forEach(function(canton) {
                            $cantonSelect.append(
                                `<option value=${canton.id}>${canton.nombre}</option>`);
                        });
                    },
                    error: function() {
                        alert('Hubo un error al cargar los cantones.');
                    }
                });
            }

            // Función para cargar parroquias
            function cargarParroquias(paisId, provinciaId, cantonId) {
                return $.ajax({
                    url: '/get-parroquias',
                    method: 'GET',
                    data: {
                        id_pais: paisId,
                        id_provincia: provinciaId,
                        id_canton: cantonId
                    },
                    success: function(response) {
                        let parroquias = response.parroquias;
                        let $parroquiaSelect = $('#parroquia_mod');
                        $parroquiaSelect.empty().append('<option value=-1>Seleccionar</option>');

                        parroquias.forEach(function(parroquia) {
                            $parroquiaSelect.append(
                                `<option value=${parroquia.id}>${parroquia.nombre}</option>`
                            );
                        });
                    },
                    error: function() {
                        alert('Hubo un error al cargar las parroquias.');
                    }
                });
            }


            $('#btn-modificar-camara').on('click', async function() {

                //alert($('#hiddenSelectedItemsMod').val());
                //return;

                if ($('#fecha_ingreso_mod').val() == "") {
                    //alert('Debe ingresar la Fecha de Ingreso de la Cámara');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Fecha de Ingreso de la Cámara',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#fecha_ingreso_mod').focus();
                    return;
                }

                if (!/^\d{13}$/.test($('#ruc_mod').val())) {
                    /*$("#error-ruc").show();
                    isValid = false;*/
                    $("#error-ruc-mod").show();
                    //alert('El RUC debe tener 13 dígitos');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
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
                    //alert('Debe ingresar la Razón Social');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
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

                if (!/^\d{10}$/.test($('#cedula_representante_legal_mod').val())) {
                    /*$("#error-ruc").show();
                    isValid = false;*/
                    $("#error-cedula-mod").show();
                    //alert('La Cédula del Representante Legal debe tener 10 dígitos');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'La Cédula del Representante Legal debe tener 10 dígitos',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#cedula_representante_legal_mod').focus();
                    return;
                }

                if ($('#nombres_representante_legal_mod').val() == "") {
                    //alert('Debe ingresar los Nombres del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar los Nombres del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#nombres_representante_legal_mod').focus();
                    return;
                }

                if ($('#apellidos_representante_legal_mod').val() == "") {
                    //alert('Debe ingresar los Apellidos del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar los Apellidos del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#apellidos_representante_legal_mod').focus();
                    return;
                }

                if ($('#telefono_representante_legal_mod').val() == "") {
                    //alert('Debe ingresar el Teléfono del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Teléfono del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#telefono_representante_legal_mod').focus();
                    return;
                }


                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($(
                        '#correo_representante_legal_mod').val())) {
                    /*$("#error-correo").show();
                    isValid = false;*/
                    $("#error-correo-mod").show();
                    //alert('Debe registrar un correo con formato válido');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar un correo con formato válido',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#correo_representante_legal_mod').focus();
                    return;
                }

                if ($('#cargo_representante_legal_mod').val() == "") {
                    //alert('Debe ingresar el Cargo del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Cargo del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#cargo_representante_legal_mod').focus();
                    return;
                }

                if ($('#direccion_representante_legal_mod').val() == "") {
                    //alert('Debe ingresar la Dirección del Representante Legal');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Dirección del Representante Legal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_generales_mod"]').tab('show');
                    $('#direccion_representante_legal_mod').focus();
                    return;
                }

                if ($('#tipo_regimen_mod').val() == "-1") {
                    //alert('Debe seleccionar un Tipo de Régimen');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar un Tipo de Régimen',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#tipo_regimen_mod').focus();
                    return;
                }

                if ($('#fecha_registro_mod').val() == "") {
                    //alert('Debe ingresar la Fecha de Registro de la Cámara');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Fecha de Registro de la Cámara',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#fecha_registro_mod').focus();
                    return;
                }

                if ($('#fecha_constitucion_mod').val() == "") {
                    //alert('Debe ingresar la Fecha de Constitución de la Cámara');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Fecha de Constitución de la Cámara',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#fecha_constitucion_mod').focus();
                    return;
                }

                // Función para convertir una fecha en formato dd/mm/yyyy a objeto Date
                function convertirFechaAObjetoDate(fecha) {
                    if (!fecha) return new Date(
                        'Invalid Date'); // Retorna una fecha inválida si la entrada es nula
                    var partes = fecha.split('/'); // Divide la fecha por '/'
                    return new Date(partes[2], partes[1] - 1, partes[0]); // Formato DD/MM/YYYY
                }

                // Validación de que la Fecha de Constitución sea menor a la Fecha de Registro
                var fechaConstitucion = $('#fecha_constitucion_mod').val();
                var fechaRegistro = $('#fecha_registro_mod').val();

                if (fechaConstitucion && fechaRegistro) {
                    // Convertir las fechas al formato correcto
                    var fechaConstitucionDate = convertirFechaAObjetoDate(fechaConstitucion);
                    var fechaRegistroDate = convertirFechaAObjetoDate(fechaRegistro);

                    // Validar si las fechas son válidas
                    if (!isNaN(fechaConstitucionDate.getTime()) && !isNaN(fechaRegistroDate
                            .getTime())) {
                        if (fechaConstitucionDate >= fechaRegistroDate) {
                            //alert('La Fecha de Constitución debe ser menor a la Fecha de Registro');
                            await Swal.fire({
                                target: document.getElementById('ModalModificarCamara'),
                                icon: 'error',
                                title: 'Error',
                                text: 'La Fecha de Constitución debe ser menor a la Fecha de Registro',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                            });
                            $('#error-fecha-constitucion-mod').show();
                            $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                            $('#fecha_constitucion_mod').focus();
                            return;
                        }
                    }
                    /*else {
                                           alert('Una o ambas fechas no son válidas. Por favor, verifica los campos.');
                                           return;
                                       }*/
                }

                if ($('#agente_retencion_mod').val() == "-1") {
                    //alert('Debe indicar si la Cámara es o no un Agente de Retención');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe indicar si la Cámara es o no un Agente de Retención',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#agente_retencion_mod').focus();
                    return;
                }

                if ($('#contribuyente_especial_mod').val() == "-1") {
                    //alert('Debe indicar si la Cámara es o no un Contribuyente Especial');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe indicar si la Cámara es o no un Contribuyente Especial',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#contribuyente_especial_mod').focus();
                    return;
                }

                if ($('#pais_mod').val() == "-1") {
                    //alert('Debe seleccionar el País');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el País',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#pais_mod').focus();
                    return;
                }

                if ($('#provincia_mod').val() == "-1") {
                    //alert('Debe seleccionar la Provincia');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar la Provincia',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#provincia_mod').focus();
                    return;
                }

                if ($('#canton_mod').val() == "-1") {
                    //alert('Debe seleccionar el Cantón');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Cantón',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#canton_mod').focus();
                    return;
                }

                if ($('#parroquia_mod').val() == "-1") {
                    //alert('Debe seleccionar la Parroquia');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar la Parroquia',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#parroquia_mod').focus();
                    return;
                }

                if ($('#calle_mod').val() == "") {
                    //alert('Debe ingresar la Calle en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Calle en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#calle_mod').focus();
                    return;
                }

                if ($('#manzana_mod').val() == "") {
                    //alert('Debe ingresar la Manzana en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Manzana en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#manzana_mod').focus();
                    return;
                }

                if ($('#numero_mod').val() == "") {
                    //alert('Debe ingresar el Número en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Número en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#numero_mod').focus();
                    return;
                }

                if ($('#interseccion_mod').val() == "") {
                    //alert('Debe ingresar la Intersección en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Intersección en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#interseccion_mod').focus();
                    return;
                }

                if ($('#referencia_mod').val() == "") {
                    //alert('Debe ingresar la Referencia en la Dirección Tributaria');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Referencia en la Dirección Tributaria',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#referencia_mod').focus();
                    return;
                }

                if ($('#hiddenSelectedItemsMod').val() == "") {
                    //alert('Debe seleccionar al menos una Actividad Económica');
                    await Swal.fire({
                        target: document.getElementById('ModalModificarCamara'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar al menos una Actividad Económica',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    $('.nav-tabs a[href="#datos_tributarios_mod"]').tab('show');
                    $('#hiddenSelectedItemsMod').focus();
                    return;
                }

                //$('#carga').show();
                Swal.fire({
                    target: document.getElementById('ModalModificarCamara'),
                    title: 'Enviando datos para modificación de Cámara',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                // Aquí puedes añadir la lógica para enviar el formulario modificado
                var formData = new FormData(document.getElementById("ModalModificarCamara"));
                $.ajax({
                    url: "",
                    type: "post",
                    dataType: "html",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res) {
                    msg = JSON.parse(res).response.msg
                    Swal.close();
                    Swal.fire({
                        icon: 'success', // Cambiado a 'success' para mostrar un mensaje positivo
                        title: 'Éxito',
                        text: res.success,
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    //alert(msg);
                    //location.reload();
                    window.location.href = window.location.href.split('?')[0] + '?noCache=' + new Date().getTime();
                    $('#carga').hide();
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
                //$('#carga').hide();
                Swal.close();
                $('#ModalModificarCamara').modal('hide'); // Cerrar el modal después de guardar
            });

            $(document).on('click', '.delete-camara', async function() {
                var button = $(this);
                var camaraId = button.data('id');

                // Mostrar la confirmación antes de proceder con la eliminación
                //var confirmDelete = confirm('¿Está seguro de que desea eliminar este registro?');
                const result = await Swal.fire({
                    title: '¿Está seguro de que desea eliminar este registro?',
                    text: "Esta acción no se puede deshacer.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                });

                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Cargando',
                        text: 'Por favor espere',
                        icon: 'info',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    $.ajax({
                        url: '/administrador/camara/eliminar/' + camaraId,
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}' // Asegúrate de incluir el token CSRF
                        },
                        success: function(response) {
                            //alert('Registro eliminado correctamente.');
                            Swal.close();
                            //alert(res.success); // Mostrar el mensaje de éxito en un alert
                            Swal.fire({
                                icon: 'success', // Cambiado a 'success' para mostrar un mensaje positivo
                                title: 'Éxito',
                                text: 'Registro eliminado correctamente.',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                            });
                            // Actualizar la interfaz, por ejemplo, recargando la página o eliminando el Cargo de la lista
                            location
                                .reload(); // O cualquier otra lógica para actualizar la interfaz
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                            //alert('Hubo un problema al eliminar el Registro.');
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al eliminar el Registro.',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                            });
                        }
                    });
                } else {
                    // El usuario canceló la eliminación
                    console.log('Eliminación cancelada por el usuario.');
                }
            });

            $('#pais').change(function() {
                let paisId = $(this).val();

                if (paisId != -1) {
                    $.ajax({
                        url: '/get-provincias', // Ruta para obtener las provincias
                        method: 'GET',
                        data: {
                            id_pais: paisId
                        },
                        success: function(response) {
                            let provincias = response.provincias;
                            let $provinciaSelect = $('#provincia');
                            let $cantonSelect = $('#canton');
                            let $parroquiaSelect = $('#parroquia');

                            $provinciaSelect.empty(); // Limpiamos el select de provincias
                            $provinciaSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            $cantonSelect.empty(); // Limpiamos el select de provincias
                            $cantonSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            $parroquiaSelect.empty(); // Limpiamos el select de provincias
                            $parroquiaSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            // Agregamos las provincias al select
                            provincias.forEach(function(provincia) {
                                $provinciaSelect.append(
                                    `<option value=${provincia.id}>${provincia.nombre}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert('Hubo un error al cargar las provincias.');
                        }
                    });
                }
            });

            $('#provincia').change(function() {
                let paisId = $('#pais').val(); // ID del país seleccionado
                let provinciaId = $(this).val(); // ID de la provincia seleccionada

                if (paisId != -1 && provinciaId != -1) {
                    $.ajax({
                        url: '/get-cantones', // Ruta para obtener los cantones
                        method: 'GET',
                        data: {
                            id_pais: paisId, // Enviamos el ID del país
                            id_provincia: provinciaId // Enviamos el ID de la provincia
                        },
                        success: function(response) {
                            let cantones = response.cantones;
                            let $cantonSelect = $('#canton'); // Select de cantones
                            let $parroquiaSelect = $('#parroquia'); // Select de parroquias

                            $cantonSelect.empty(); // Limpiamos el select de cantones
                            $parroquiaSelect.empty().append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Limpiamos parroquias

                            $cantonSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            // Agregamos los cantones al select
                            cantones.forEach(function(canton) {
                                $cantonSelect.append(
                                    `<option value=${canton.id}>${canton.nombre}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert('Hubo un error al cargar los cantones.');
                        }
                    });
                } else {
                    $('#canton').empty().append(
                        '<option value=-1>Seleccionar</option>'); // Limpiar select de cantones
                    $('#parroquia').empty().append(
                        '<option value=-1>Seleccionar</option>'); // Limpiar select de parroquias
                }
            });

            $('#canton').change(function() {
                let paisId = $('#pais').val(); // ID del país seleccionado
                let provinciaId = $('#provincia').val(); // ID de la provincia seleccionada
                let cantonId = $(this).val(); // ID del cantón seleccionado

                if (paisId != -1 && provinciaId != -1 && cantonId != -1) {
                    $.ajax({
                        url: '/get-parroquias', // Ruta para obtener las parroquias
                        method: 'GET',
                        data: {
                            id_pais: paisId, // Enviamos el ID del país
                            id_provincia: provinciaId, // Enviamos el ID de la provincia
                            id_canton: cantonId // Enviamos el ID del cantón
                        },
                        success: function(response) {
                            let parroquias = response
                                .parroquias; // Asegúrate de usar el nombre correcto en el JSON de respuesta
                            let $parroquiaSelect = $('#parroquia'); // Select de parroquias

                            $parroquiaSelect.empty(); // Limpiamos el select de parroquias
                            $parroquiaSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            // Agregamos las parroquias al select
                            parroquias.forEach(function(parroquia) {
                                $parroquiaSelect.append(
                                    `<option value=${parroquia.id}>${parroquia.nombre}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert('Hubo un error al cargar las parroquias.');
                        }
                    });
                } else {
                    $('#parroquia').empty().append(
                        '<option value=-1>Seleccionar</option>'); // Limpiar select de parroquias
                }
            });

            $('#pais_mod').change(function() {
                let paisId = $(this).val();

                if (paisId != -1) {
                    $.ajax({
                        url: '/get-provincias', // Ruta para obtener las provincias
                        method: 'GET',
                        data: {
                            id_pais: paisId
                        },
                        success: function(response) {
                            let provincias = response.provincias;
                            let $provinciaSelect = $('#provincia_mod');
                            let $cantonSelect = $('#canton_mod');
                            let $parroquiaSelect = $('#parroquia_mod');

                            $provinciaSelect.empty(); // Limpiamos el select de provincias
                            $provinciaSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            $cantonSelect.empty(); // Limpiamos el select de provincias
                            $cantonSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            $parroquiaSelect.empty(); // Limpiamos el select de provincias
                            $parroquiaSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            // Agregamos las provincias al select
                            provincias.forEach(function(provincia) {
                                $provinciaSelect.append(
                                    `<option value=${provincia.id}>${provincia.nombre}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert('Hubo un error al cargar las provincias.');
                        }
                    });
                }
            });

            $('#provincia_mod').change(function() {
                let paisId = $('#pais_mod').val(); // ID del país seleccionado
                let provinciaId = $(this).val(); // ID de la provincia seleccionada

                if (paisId != -1 && provinciaId != -1) {
                    $.ajax({
                        url: '/get-cantones', // Ruta para obtener los cantones
                        method: 'GET',
                        data: {
                            id_pais: paisId, // Enviamos el ID del país
                            id_provincia: provinciaId // Enviamos el ID de la provincia
                        },
                        success: function(response) {
                            let cantones = response.cantones;
                            let $cantonSelect = $('#canton_mod'); // Select de cantones
                            let $parroquiaSelect = $('#parroquia_mod'); // Select de parroquias

                            $cantonSelect.empty(); // Limpiamos el select de cantones
                            $parroquiaSelect.empty().append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Limpiamos parroquias

                            $cantonSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            // Agregamos los cantones al select
                            cantones.forEach(function(canton) {
                                $cantonSelect.append(
                                    `<option value=${canton.id}>${canton.nombre}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert('Hubo un error al cargar los cantones.');
                        }
                    });
                } else {
                    $('#canton_mod').empty().append(
                        '<option value=-1>Seleccionar</option>'); // Limpiar select de cantones
                    $('#parroquia_mod').empty().append(
                        '<option value=-1>Seleccionar</option>'); // Limpiar select de parroquias
                }
            });

            $('#canton_mod').change(function() {
                let paisId = $('#pais_mod').val(); // ID del país seleccionado
                let provinciaId = $('#provincia_mod').val(); // ID de la provincia seleccionada
                let cantonId = $(this).val(); // ID del cantón seleccionado

                if (paisId != -1 && provinciaId != -1 && cantonId != -1) {
                    $.ajax({
                        url: '/get-parroquias', // Ruta para obtener las parroquias
                        method: 'GET',
                        data: {
                            id_pais: paisId, // Enviamos el ID del país
                            id_provincia: provinciaId, // Enviamos el ID de la provincia
                            id_canton: cantonId // Enviamos el ID del cantón
                        },
                        success: function(response) {
                            let parroquias = response
                                .parroquias; // Asegúrate de usar el nombre correcto en el JSON de respuesta
                            let $parroquiaSelect = $('#parroquia_mod'); // Select de parroquias

                            $parroquiaSelect.empty(); // Limpiamos el select de parroquias
                            $parroquiaSelect.append(
                                '<option value=-1>Seleccionar</option>'
                            ); // Opción por defecto

                            // Agregamos las parroquias al select
                            parroquias.forEach(function(parroquia) {
                                $parroquiaSelect.append(
                                    `<option value=${parroquia.id}>${parroquia.nombre}</option>`
                                );
                            });
                        },
                        error: function() {
                            alert('Hubo un error al cargar las parroquias.');
                        }
                    });
                } else {
                    $('#parroquia_mod').empty().append(
                        '<option value=-1>Seleccionar</option>'); // Limpiar select de parroquias
                }
            });

            $('#btn-more-info').on('click', function() {
                let camaraLogInsert = camara_selected.insert;
                let camaraLogUpdate = camara_selected.update;

                // Manejo del caso cuando camaraLogUpdate es vacío
                let lastItem = null;
                if (Array.isArray(camaraLogUpdate) && camaraLogUpdate.length > 0) {
                    lastItem = camaraLogUpdate[camaraLogUpdate.length - 1];
                } else {
                    lastItem = {
                        created_at: 'No hay modificaciones',
                        user: {
                            name: 'N/A'
                        }
                    };
                }

                // Función para formatear fechas
                const formatDate = (dateString) => {
                    if (dateString === 'No hay modificaciones') {
                        return dateString;
                    }
                    const options = {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                        hour12: false, // Para formato 24 horas
                    };
                    return new Date(dateString).toLocaleDateString('es-ES', options);
                };

                // Formatear las fechas
                const formattedCreatedAt = formatDate(camaraLogInsert.created_at);
                const formattedUpdatedAt = formatDate(lastItem?.created_at);

                // Mostrar el modal con SweetAlert2
                const swalInfo = Swal.fire({
                    target: document.getElementById('ModalModificarCamara'),
                    title: 'Información adicional',
                    html: `
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h5><strong>Creación</strong></h5>
                                <p><strong>Usuario:</strong> ${camaraLogInsert.user.name}</p>
                                <p><strong>Fecha de creación:</strong> ${formattedCreatedAt}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5><strong>Última modificación</strong></h5>
                                <p><strong>Usuario:</strong> ${lastItem?.user?.name}</p>
                                <p><strong>Fecha de modificación:</strong> ${formattedUpdatedAt}</p>
                            </div>
                        </div>
                    </div>
                    `,
                    showCloseButton: true,
                    showConfirmButton: true,
                    allowOutsideClick: false,
                });
            });


            $(document).on('click', '.desafiliar-camara', async function() {
                var button = $(this);
                var camaraId = button.data('id'); 

                const {
                    value: { motivo, fechaDesafiliacion }
                } = await Swal.fire({
                    title: '¿Está seguro de desafiliar la Cámara?',
                    text: "Indíquenos el motivo de la desafiliación y la fecha",
                    html: ` 
                        <div class="row">
                            <div class="col-6"> 
                                <b>Fecha Desafiliación: </b>
                            </div>
                            <div class="col-6"> 
                                <input type="text" class="form-control" name="swal-fecha" id="swal-fecha" placeholder="Fecha de Desafiliación">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12"> 
                                <textarea id="swal-motivo" class="form-control" rows="3" data-plugin-maxlength maxlength="140" placeholder="Motivo de la desafiliación" style="text-transform: uppercase;"></textarea>
                            </div>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                    didOpen: () => {
                        // Inicializar el datepicker después de que se ha abierto el modal de SweetAlert
                        $('#swal-fecha').datepicker({
                            format: 'yyyy-mm-dd',  // Formato de fecha
                            autoclose: true,        // Cerrar el picker después de seleccionar una fecha
                            todayHighlight: true    // Resaltar el día de hoy
                        });
                    },
                    preConfirm: () => {
                        const motivo = document.getElementById('swal-motivo').value;
                        const fechaDesafiliacion = document.getElementById('swal-fecha').value;
                        return { motivo, fechaDesafiliacion };
                    }
                });
                
                if (motivo && fechaDesafiliacion) {
                    Swal.fire({
                        title: 'Cargando',
                        text: 'Por favor espere',
                        icon: 'info',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    $.ajax({
                        url: "",
                        type: "POST",
                        data: {
                            camara_id: camaraId,
                            motivo: motivo.toUpperCase(),
                            fecha_desafiliacion: fechaDesafiliacion.toUpperCase(),
                            _token: '{{ csrf_token() }}'
                        },
                    }).done(async function(response) {
                        Swal.close();
                        await Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message,
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            confirmButtonText: 'Aceptar',
                        });
                        table.ajax.reload(null, false);
                    }).fail(function(error) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            confirmButtonText: 'Aceptar',
                            text: error.responseJSON?.message ||
                                "Error al eliminar el socio.",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.error("Error al cargar los datos: ", error);
                            }
                        });
                        return;
                    });
                } else {
                    // El usuario canceló la eliminación
                    console.log('Eliminación cancelada por el usuario.');
                    if (!motivo) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Motivo requerido',
                            text: 'Por favor, ingrese un motivo para la desafiliación.',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                    if (!fechaDesafiliacion) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Fecha requerida',
                            text: 'Por favor, ingrese una fecha de desafiliación.',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }
            });

            $(document).on('click', '.reafiliar-camara', async function() {
                var button = $(this);
                var camaraId = button.data('id');

                var result = await Swal.fire({
                    title: '¿Está seguro de reafiliar al Socio?', 
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    allowOutsideClick: false,
                });

                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Cargando',
                        text: 'Por favor espere',
                        icon: 'info',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    });
                    $.ajax({
                        url: "",
                        type: "POST",
                        data: {
                            camara_id: camaraId, 
                            _token: '{{ csrf_token() }}'
                        },
                    }).done(async function(response) {
                        Swal.close();
                        await Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message,
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            confirmButtonText: 'Aceptar',
                        });
                        table.ajax.reload(null, false);
                    }).fail(function(error) {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            confirmButtonText: 'Aceptar',
                            text: error.responseJSON?.message ||
                                "Error al reafiliar la cámara.",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                console.error("Error al cargar los datos: ", error);
                            }
                        });
                        return;
                    });
                } else {
                    // El usuario canceló la eliminación
                    console.log('Eliminación cancelada por el usuario.');
                }
            });

    });
</script>
@endsection
