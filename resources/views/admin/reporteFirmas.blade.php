@extends('dashboard')

@section('pagename')
    Reporte de Firmas Electrónicas
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
                        <h2 class="card-title">Firmas electrónicas emitidas</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12"> 
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-default btn-lg" id="btnExportCSV" title="Descargar CSV">
                                        <i class="fa-solid fa-file-csv fa-2x"></i>
                                    </button> &nbsp;
                                    <button class="btn btn-default btn-lg" id="btnExportExcel" title="Descargar Excel">
                                        <i class="fa-regular fa-file-excel fa-2x"></i>
                                    </button> &nbsp;
                                    <button class="btn btn-default btn-lg" id="btnExportPDF" title="Descargar PDF">
                                        <i class="fa-regular fa-file-pdf fa-2x"></i>
                                    </button> &nbsp;
                                    <button class="btn btn-default btn-lg" id="btnImprimir" title="Imprimir">
                                        <i class="fa-solid fa-print fa-2x"></i>
                                    </button> 
                                   
                                        <!-- <button class="btn btn-default" id="btnExportExcel" title="Descargar Excel"><i class="fa-regular fa-file-excel"></i></button>&nbsp;
                                        <button class="btn btn-default" id="btnExportPDF" title="Descargar PDF"><i class="fa-regular fa-file-pdf"></i></button>&nbsp;
                                        <button class="btn btn-default" id="btnImprimir" title="Imprimir"><i class="fa-solid fa-print"></i></button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                                        <h2 class="card-title">Listado de Firmas Elecrónicas Emitidas</h2>
                                    </header>
                                    <div class="card-body overflow-x-auto max-w-full">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label for="filtro_fecha">Filtrar por mes y año:</label>
                                                <input type="text" id="filtro_fecha" class="form-control" placeholder="Selecciona mes y año">
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-striped mb-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>FECHA DE EMISIÓN</th>
                                                    <th>CLIENTE</th>
                                                    <th>TIPO DE FIRMA</th>
                                                    <th>VIGENCIA FIRMA</th>
                                                    <th>VER ESTADO</th> 
                                                    <th>ÚLTIMO ESTADO</th>
                                                    <th>ÚLTIMA CONSULTA</th>
                                                    <th>OBSERVACIONES</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </section>
                            </div>
                        </div> 
                    </div>
            </div>
            </section>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            let firma_selected = null;
            let firmas = [];

            Swal.fire({
                title: 'Cargando',
                text: 'Por favor espere',
                icon: 'info',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                }
            });

            // Inicializar el Datepicker para seleccionar solo mes y año
            $("#filtro_fecha").datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'mm/yy',
                onClose: function(dateText, inst) {
                    let month = $("#ui-datepicker-div .ui-datepicker-month option:selected").val();
                    let year = $("#ui-datepicker-div .ui-datepicker-year option:selected").val();
                    $(this).val((parseInt(month) + 1).toString().padStart(2, '0') + '/' + year);
                    $(this).datepicker("hide");

                    // Recargar la tabla con el nuevo filtro
                    $('#dataTable').DataTable().ajax.reload();
                }
            });

            // Modificar el comportamiento para solo mostrar mes y año
            $("#filtro_fecha").focus(function() {
                $(".ui-datepicker-calendar").hide();
                $("#ui-datepicker-div").position({
                    my: "center top",
                    at: "center bottom",
                    of: $(this)
                });
            });

            var table = $('#dataTable').DataTable({
                destroy: true,
                processing: false,
                serverSide: true,
                ajax: {
                url: "{{ route('admin.obtener_listado_firmas_emitidas') }}",
                type: "GET",
                data: function(d) {
                    d.start = d.start || 0;
                    d.length = d.length || 10;
                    d.fecha = $('#filtro_fecha').val(); // Pasar el valor de fecha como parámetro
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
                    firmas = response.responseJSON.data;
                    Swal.close();
                },
                },
                pageLength: 10,
                columns: [
                { data: 'fecha_emision', width: '13%' },
                { data: 'cliente', width: '24%'},
                { data: 'tipo_solicitud', width: '10%' },
                { data: 'tipo_vigencia', width: '5%' },
                { data: 'btn_consultar', width: '10%' },
                { data: 'ultimo_estado', width: '10%' }, 
                { data: 'ultima_consulta', width: '13%' }, 
                { data: 'observaciones', width: '15%' }, 
                ],
                order: [[0, "asc"]],
                createdRow: function(row, data, dataIndex) {
                var td = $(row).find(".truncate");
                td.attr("title", td.text());

                var td2 = $(row).find(".truncate2");
                td2.attr("title", td2.text());
                }
            });

            // Recargar la tabla cuando se cambie la fecha
            $("#filtro_fecha").change(function() {
                table.ajax.reload();
            });

            $("#btn-consultar").click(async function() {
                alert("Consultar estado")
            }); 

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
            

            $('#btnExportCSV').on('click', function() { 

                var url = "{{ route('admin.exportar_csv_firmas_emitidas') }}";

                window.location.href = url;
            });

            $('#btnExportExcel').on('click', function() { 

                var url = "{{ route('admin.exportar_excel_firmas_emitidas') }}";
                window.location.href = url;
            });

            $('#btnExportPDF').on('click', function() {  
                // Construir la URL con el parámetro
                var url = "{{ route('admin.exportar_pdf_firmas_emitidas') }}";   
                // Redireccionar a la URL
                window.location.href = url;
            });

            $('#btnImprimir').on('click', function() {  
                // Construir la URL con el parámetro
                var url = "{{ route('admin.imprimir_pdf_firmas_emitidas') }}";   
                // Abrir la URL en una nueva ventana o pestaña
                window.open(url, '_blank');
            });

    });
</script>
@endsection
