@extends('dashboard')

@section('pagename')
    Resitro de Firmas
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
                        <h2 class="card-title">Registro de Firmas</h2>
                    </header>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#ModalFirma">Agregar Nuevo Registro</button> 
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
                                        <h2 class="card-title">Listado de Firmas Registradas</h2>
                                    </header>
                                    <div class="card-body overflow-x-auto max-w-full">
                                        <table class="table table-bordered table-striped mb-0" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>TIPO SOLICITUD</th>
                                                    <th>TIPO DOCUMENTO</th>
                                                    <th>NÚMERO DOCUMENTO</th>
                                                    <th>NOMBRES</th> 
                                                    <th>APELLIDO PATERNO</th>
                                                    <th>APELLIDO MATERNO</th>
                                                    <th>TELÉFONO</th>
                                                    <th>EMAIL</th>
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
    <div class="container">
        <!-- Modal --> 
        <!-- Jbuestan Modales -->
        <form enctype="multipart/form-data" class="modal fade" id="ModalFirma" tabindex="-1"
            aria-labelledby="ModalFirmaLabel" aria-hidden="true">
            @csrf
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalFirmaLabel"><b>Agregar una Nueva Cámara de Comercio</b></h5>
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
                                            <li class="nav-item">
                                                <a class="nav-link" data-bs-target="#documentos"
                                                    href="#documentos" data-bs-toggle="tab">Documentos</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="datos_generales" class="tab-pane active">
                                                <div class="row mb-2">
                                                    <div class="col-md-12 gap-1">
                                                        <div class="form-group">
                                                            <label for="tipo_solicitud" class="form-label">Tipo de Solicitud</label>
                                                            <select id="tipo_solicitud" name="tipo_solicitud" class="form-control populate">
                                                                <option value="-1">Seleccionar</option>
                                                                @foreach ($tiposSolicitud as $id => $entidad)
                                                                    <option value="{{ $id }}">{{ $entidad }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="tipo_documento" class="form-label">Tipo de Documento</label>
                                                            <select id="tipo_documento" name="tipo_documento" class="form-control populate">
                                                                <option value="-1">Seleccionar</option>
                                                                @foreach ($tiposDocumento as $id => $entidad)
                                                                    <option value="{{ $id }}">{{ $entidad }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="numero_documento" class="form-label">Número de Documento</label>
                                                            <input type="text" class="form-control" name="numero_documento" id="numero_documento" placeholder="Número de Dopcumento">
                                                            <div id="error-numero-documento" style="color: red; display: none;">El Número de Documento debe
                                                            tener 10 dígitos.</div>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="codigo_dactilar" class="form-label">Código Dactilar</label>
                                                            <input type="text" class="form-control" name="codigo_dactilar" id="codigo_dactilar" placeholder="Código Dactilar">
                                                        </div>
                                                    </div> 
                                                </div> 
                                                <div class="row mb-2">
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="nombres" class="form-label">Nombres</label>
                                                            <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                                                            <input type="text" class="form-control" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido Paterno">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="apellido_materno" class="form-label">Apedllido Materno</label>
                                                            <input type="text" class="form-control" name="apellido_materno" id="apellido_materno" placeholder="Apellido Materno">
                                                        </div>
                                                    </div> 
                                                </div> 
                                                <div class="row mb-2">
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                                                            <input type="text" data-plugin-datepicker class="form-control"
                                                            name="fecha_nacimiento" id="fecha_nacimiento"
                                                            placeholder="Fecha de nacimiento">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="pais" class="form-label">Nacionalidad</label>
                                                            <select id="pais" name="pais" class="form-control populate">
                                                                <option value="-1">Seleccionar</option>
                                                                @foreach ($paises as $id => $entidad)
                                                                    <option value="{{ $id }}">{{ $entidad }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="tipo_sexo" class="form-label">Sexo</label>
                                                            <select id="tipo_sexo" name="tipo_sexo" class="form-control populate">
                                                                <option value="-1">Seleccionar</option>
                                                                @foreach ($tiposSexo as $id => $entidad)
                                                                    <option value="{{ $id }}">{{ $entidad }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> 
                                                </div> 
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <div class="form-group">
                                                            <label for="celular" class="form-label">Celular</label>
                                                            <input type="text" class="form-control" name="celular" id="celular" placeholder="Celular">
                                                        </div>
                                                    </div> 
                                                    <div class="col-md-6 gap-1">
                                                        <div class="form-group">
                                                            <label for="email" class="form-label">Email</label>
                                                            <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                                            <div id="error-email" style="color: red; display: none;">Ingrese
                                                            un correo electrónico válido.</div>
                                                        </div>
                                                    </div>  
                                                </div>
                                                <div id="persona_natural" class="row mb-2">
                                                    <div class="col-md-1 d-flex flex-column justify-content-center gap-1">
                                                         Con RUC: 
                                                    </div>
                                                    <div class="col-md-5 d-flex flex-column justify-content-center gap-1"> 
                                                        <div class="switch switch-success">
                                                            <input type="checkbox" id="switch_ruc" name="switch_ruc" data-plugin-ios-switch />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 gap-1">
                                                        <div class="form-group">
                                                            <label for="ruc" class="form-label">Número de Ruc</label>
                                                            <input type="text" class="form-control" name="ruc" id="ruc" placeholder="Número de Ruc">
                                                            <div id="error-ruc" style="color: red; display: none;">El RUC debe
                                                            tener 13 dígitos.</div>
                                                        </div>
                                                    </div>   
                                                </div> 
                                                <div id="representante_legal">
                                                    <hr class="custom-hr">
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <b>Datos de la Empresa</b>
                                                        </div>  
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="ruc_empresa" class="form-label">RUC Empresa</label>
                                                                <input type="text" class="form-control" name="ruc_empresa" id="ruc_empresa" placeholder="RUC Empresa">
                                                                <div id="error-ruc-empresa" style="color: red; display: none;">El RUC debe
                                                            tener 13 dígitos.</div>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="razon_social_empresa" class="form-label">Razón Social Empresa</label>
                                                                <input type="text" class="form-control" name="razon_social_empresa" id="razon_social_empresa" placeholder="Razón Social Empresa">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="cargo_representante" class="form-label">Cargo Representante</label>
                                                                <input type="text" class="form-control" name="cargo_representante" id="cargo_representante" placeholder="Cargo Representante">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                </div>
                                                <div id="miembro_empresa">
                                                    <hr class="custom-hr">
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <b>Datos de la Empresa</b>
                                                        </div>  
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="ruc_empresa_miembro" class="form-label">RUC Empresa</label>
                                                                <input type="text" class="form-control" name="ruc_empresa_miembro" id="ruc_empresa_miembro" placeholder="RUC Empresa">
                                                                <div id="error-ruc-miembro" style="color: red; display: none;">El RUC debe
                                                            tener 13 dígitos.</div>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="razon_social_empresa_miembro" class="form-label">Razón Social Empresa</label>
                                                                <input type="text" class="form-control" name="razon_social_empresa_miembro" id="razon_social_empresa_miembro" placeholder="Razón Social Empresa">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="area_miembro" class="form-label">Área</label>
                                                                <input type="text" class="form-control" name="area_miembro" id="area_miembro" placeholder="Área">
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="motivo_miembro" class="form-label">Motivo</label>
                                                                <input type="text" class="form-control" name="motivo_miembro" id="motivo_miembro" placeholder="Motivo">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="cargo_solicitante_miembro" class="form-label">Cargo del Solicitante</label>
                                                                <input type="text" class="form-control" name="cargo_solicitante_miembro" id="cargo_solicitante_miembro" placeholder="Cargo del Solicitante">
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <hr class="custom-hr">
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <b>Representante Legal</b>
                                                        </div>  
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="tipo_documento_empresa" class="form-label">Tipo de Documento</label> 
                                                                <select id="tipo_documento_empresa" name="tipo_documento_empresa" class="form-control populate">
                                                                    <option value="-1">Seleccionar</option>
                                                                    @foreach ($tiposDocumento as $id => $entidad)
                                                                        <option value="{{ $id }}">{{ $entidad }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div> 
                                                        <div class="col-md-6 gap-1">
                                                            <div class="form-group">
                                                                <label for="numero_documento_empresa" class="form-label">Número de Documento</label>
                                                                <input type="text" class="form-control" name="numero_documento_empresa" id="numero_documento_empresa" placeholder="Número de Documento">
                                                                <div id="error-numero-documento-empresa" style="color: red; display: none;">El Número de Documento debe
                                                            tener 10 dígitos.</div>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-md-4 gap-1">
                                                            <div class="form-group">
                                                                <label for="nombres_empresa" class="form-label">Nombres</label>
                                                                <input type="text" class="form-control" name="nombres_empresa" id="nombres_empresa" placeholder="Nombres">
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-4 gap-1">
                                                            <div class="form-group">
                                                                <label for="apellido_paterno_empresa" class="form-label">Apellido Paterno</label>
                                                                <input type="text" class="form-control" name="apellido_paterno_empresa" id="apellido_paterno_empresa" placeholder="Apellido Paterno">
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-4 gap-1">
                                                            <div class="form-group">
                                                                <label for="apellido_materno_empresa" class="form-label">Apellido Materno</label>
                                                                <input type="text" class="form-control" name="apellido_materno_empresa" id="apellido_materno_empresa" placeholder="Apellido Materno">
                                                            </div>
                                                        </div>  
                                                    </div>  
                                                </div>
                                                <hr class="custom-hr">
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <b>Dirección del Domicilio</b>
                                                    </div>  
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="provincia" class="form-label">Provincia</label>
                                                            <select id="provincia" name="provincia" class="form-control populate">
                                                                <option value="-1">Seleccionar</option>
                                                                @foreach ($provincias as $id => $entidad)
                                                                    <option value="{{ $id }}">{{ $entidad }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>  
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="canton" class="form-label">Ciudad</label>
                                                            <select id="canton" name="canton" class="form-control populate">
                                                                <option value="-1">Seleccionar</option>
                                                                @foreach ($cantones as $id => $entidad)
                                                                    <option value="{{ $id }}">{{ $entidad }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>   
                                                </div> 
                                                <div class="row mb-2"> 
                                                    <div class="col-md-12 gap-1">
                                                        <div class="form-group">
                                                            <label for="direccion_empresa" class="form-label">Dirección completa, tal como consta en su RUC</label>
                                                            <input type="text" class="form-control" name="direccion_empresa" id="direccion_empresa" placeholder="Dirección">
                                                        </div>
                                                    </div>  
                                                </div> 
                                                <hr class="custom-hr">
                                                <div class="row mb-2">
                                                    <div class="col-md-6 gap-1">
                                                        <b>Vigencia</b>
                                                    </div>  
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-4 gap-1">
                                                        <div class="form-group">
                                                            <label for="tipo_vigencia" class="form-label">Tiempo de Vigencia</label>
                                                            <select id="tipo_vigencia" name="tipo_vigencia" class="form-control populate">
                                                                <option value="-1">Seleccionar</option>
                                                                @foreach ($tiposVigencia as $id => $entidad)
                                                                    <option value="{{ $id }}">{{ $entidad }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>   
                                                </div>
                                            </div> 
                                            <div id="documentos" class="tab-pane">
                                                <div class="row"> 
                                                    <div class="col-6"> 
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Foto del lado Frontal de su Cédula</b></label>
                                                                <div id="cedula-frontal" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Foto del lado Posterior de su Cédula</b></label>
                                                                <div id="cedula-posterior" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-12"> 
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-6"> 
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Foto de Selfie con su Cédula</b></label>
                                                                <div id="cedula-selfie" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Copia del RUC</b></label>
                                                                <div id="ruc-image" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-12"> 
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-6"> 
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Documento adicional (Vídeo)</b></label>
                                                                <div id="documento-adicional" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6" id="col-constitucion-compania">
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Constitución de Compañía</b></label>
                                                                <div id="constitucion-compania" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-12"> 
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row" id="row-nombramiento"> 
                                                    <div class="col-6"> 
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Nombramiento de Representante</b></label>
                                                                <div id="nombramiento-representante" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Aceptación de Nombramiento</b></label>
                                                                <div id="aceptacion-nombramiento" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row"> 
                                                    <div class="col-12"> 
                                                        &nbsp;
                                                    </div>
                                                </div>
                                                <div class="row" id="row-representante"> 
                                                    <div class="col-6"> 
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Cédula del Representante Legal</b></label>
                                                                <div id="cedula-representante" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group row align-items-center">
                                                            <div class="col">
                                                                <label for="canton" class="form-label"><b>Autorización del Representante</b></label>
                                                                <div id="autorizacion-representante" class="dropzone-modern dz-square">
                                                                    <span class="dropzone-upload-message text-center">
                                                                        <i class="bx bxs-cloud-upload"></i>
                                                                        <b class="text-color-primary">Arrastra/Sube</b> tu archivo aquí.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
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
                        <button type="button" class="btn btn-primary" id="btn-register-firma">Guardar</button>
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

            $('#persona_natural').hide();
            $('#representante_legal').hide();
            $('#miembro_empresa').hide(); 
            $('#ruc').closest('.form-group').hide(); 
            
            $('#col-constitucion-compania').hide(); 
            $('#row-nombramiento').hide();
            $('#row-representante').hide(); 

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
                url: "{{ route('admin.obtener_listado_firmas') }}",
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
                { data: 'id', width: '3%' },
                { data: 'tipo_solicitud', width: '20%' },
                { data: 'tipo_documento', width: '5%' },
                { data: 'numero_documento', width: '10%' },
                { data: 'nombres', width: '15%' }, 
                { data: 'apellido_paterno', width: '15%' }, 
                { data: 'apellido_materno', width: '15%' }, 
                { data: 'celular', width: '10%' }, 
                { data: 'email', width: '10%' }, 
                ],
                order: [[0, "asc"]],
                createdRow: function(row, data, dataIndex) {
                var td = $(row).find(".truncate");
                td.attr("title", td.text());

                var td2 = $(row).find(".truncate2");
                td2.attr("title", td2.text());
                }
            });

            $('#tipo_solicitud').on('change', function () {
                const value = $(this).val(); 

                if( value === '1' ){

                    $('#persona_natural').show();
                    $('#representante_legal').hide();
                    $('#miembro_empresa').hide(); 

                    $('#col-constitucion-compania').hide(); 
                    $('#row-nombramiento').hide();
                    $('#row-representante').hide();

                }else if(value === '2'){

                    $('#persona_natural').hide();
                    $('#representante_legal').show();
                    $('#miembro_empresa').hide(); 

                    $('#col-constitucion-compania').show(); 
                    $('#row-nombramiento').show();
                    $('#row-representante').hide();

                }else if(value === '3'){

                    $('#persona_natural').hide();
                    $('#representante_legal').hide();
                    $('#miembro_empresa').show(); 

                    $('#col-constitucion-compania').show(); 
                    $('#row-nombramiento').show();
                    $('#row-representante').show();

                }else{
                    $('#persona_natural').hide();
                    $('#representante_legal').hide();
                    $('#miembro_empresa').hide(); 

                    $('#col-constitucion-compania').hide(); 
                    $('#row-nombramiento').hide();
                    $('#row-representante').hide();
                }
            }); 

            $('[name="switch_ruc"]').on('change', function() {
                if ($(this).prop('checked')) {
                    $('#ruc').closest('.form-group').show(); // Mostrar campo RUC
                } else {
                    $('#ruc').closest('.form-group').hide(); // Ocultar campo RUC
                }
            });

            //Jbuestan: Se agrega Dropzones para los 10 Documentos
            $('#cedula-frontal').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "image/jpeg, image/png",
                init: function() {
                    if( $('#cedula-frontal').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#cedula-frontal"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized');

            $('#cedula-posterior').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "image/jpeg, image/png",
                init: function() {
                    if( $('#cedula-posterior').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#cedula-posterior"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized');

            $('#cedula-selfie').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "image/jpeg, image/png",
                init: function() {
                    if( $('#cedula-selfie').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#cedula-selfie"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized'); 

            $('#ruc-image').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "application/pdf",
                init: function() {
                    if( $('#ruc-image').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#ruc-image"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized');

            $('#documento-adicional').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1, 
                init: function() {
                    if( $('#documento-adicional').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#documento-adicional"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized');

            $('#constitucion-compania').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "application/pdf",
                init: function() {
                    if( $('#constitucion-compania').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#constitucion-compania"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized');

            $('#nombramiento-representante').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "application/pdf",
                init: function() {
                    if( $('#nombramiento-representante').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#nombramiento-representante"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized');

            $('#aceptacion-nombramiento').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "application/pdf",
                init: function() {
                    if( $('#aceptacion-nombramiento').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#aceptacion-nombramiento"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized');

            $('#cedula-representante').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "application/pdf",
                init: function() {
                    if( $('#cedula-representante').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#cedula-representante"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized');

            $('#autorizacion-representante').dropzone({
                url: '/upload.php',
                addRemoveLinks: true,
                autoProcessQueue: false, // Evita la subida automática
                maxFiles: 1,
                acceptedFiles: "application/pdf",
                init: function() {
                    if( $('#autorizacion-representante').hasClass('dz-filled') ) {
                        var dropzoneObj = Dropzone.forElement("#autorizacion-representante"),
                            mockFile = { name: "Image Name", size: 12345 };

                            dropzoneObj.displayExistingFile(mockFile, 'img/products/product-1.jpg');
                    }
                }
            }).addClass('dropzone initialized'); 


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
            $('#fecha_nacimiento').on('blur', function() {
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

            $("#email").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-email").hide(); // Ocultar error
                } else {
                    $("#error-email").show(); // Mostrar error
                }
            });

            $('#celular').on('input', function() {
                let value = $(this).val();
                // Eliminar todos los caracteres no numéricos excepto el guion
                value = value.replace(/[^0-9]/g, '');
                
                // Limitar el campo a un máximo de 11 caracteres (10 dígitos + 1 guion)
                if (value.length > 19) {
                    value = value.slice(0, 19);
                }
                $(this).val(value);
            });
 

            //Manejo de Upercase 
            $('#numero_documento').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#codigo_dactilar').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#nombres').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });  

            $('#apellido_paterno').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#apellido_materno').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#razon_social_empresa').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#cargo_representante').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#razon_social_empresa_miembro').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#area_miembro').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#motivo_miembro').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#cargo_solicitante_miembro').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#nombres_empresa').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#apellido_paterno_empresa').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });  

            $('#apellido_materno_empresa').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            });

            $('#direccion_empresa').on('input', function() {
                // Convierte el valor del campo a mayúsculas
                $(this).val($(this).val().toUpperCase());
            }); 
 
            //jbuestan   

            // Validar campo RUC
            $("#numero_documento").on("input", function() {
                var tipo_documento = $("#tipo_documento").val();

                if (tipo_documento == 1) {
                    var ruc = $(this).val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

                    $(this).val(ruc); // Asignar el valor limpio al input

                    if (/^\d{10}$/.test(ruc)) { // Validar si tiene exactamente 10 dígitos
                        $("#error-numero-documento").hide(); // Ocultar error
                    } else {
                        $("#error-numero-documento").show(); // Mostrar error
                    }
                }
                if (tipo_documento == 2) {
                    $("#error-numero-documento").hide(); // Ocultar error
                }
            });  

            $("#numero_documento_empresa").on("input", function() {
                var tipo_documento = $("#tipo_documento_empresa").val();

                if (tipo_documento == 1) {
                    var ruc = $(this).val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

                    $(this).val(ruc); // Asignar el valor limpio al input

                    if (/^\d{10}$/.test(ruc)) { // Validar si tiene exactamente 10 dígitos
                        $("#error-numero-documento-empresa").hide(); // Ocultar error
                    } else {
                        $("#error-numero-documento-empresa").show(); // Mostrar error
                    }
                }
                if (tipo_documento == 2) {
                    $("#error-numero-documento-empresa").hide(); // Ocultar error
                }
            });  

            $("#ruc").on("input", function() { 
                var ruc = $(this).val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

                $(this).val(ruc); // Asignar el valor limpio al input

                if (/^\d{13}$/.test(ruc)) { // Validar si tiene exactamente 10 dígitos
                    $("#error-ruc").hide(); // Ocultar error
                } else {
                    $("#error-ruc").show(); // Mostrar error
                } 
            });

            $("#ruc_empresa").on("input", function() { 
                var ruc = $(this).val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

                $(this).val(ruc); // Asignar el valor limpio al input

                if (/^\d{13}$/.test(ruc)) { // Validar si tiene exactamente 10 dígitos
                    $("#error-ruc-empresa").hide(); // Ocultar error
                } else {
                    $("#error-ruc-empresa").show(); // Mostrar error
                } 
            });

            $("#ruc_empresa_miembro").on("input", function() { 
                var ruc = $(this).val().replace(/\D/g, ''); // Eliminar caracteres no numéricos

                $(this).val(ruc); // Asignar el valor limpio al input

                if (/^\d{13}$/.test(ruc)) { // Validar si tiene exactamente 10 dígitos
                    $("#error-ruc-miembro").hide(); // Ocultar error
                } else {
                    $("#error-ruc-miembro").show(); // Mostrar error
                } 
            });

            $("#email").on("input", function() {
                $(this).val($(this).val().toLowerCase());
                var correo = $(this).val();
                var regexCorreo =
                    /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // Regex para correo válido
                if (regexCorreo.test(correo)) { // Si es un correo válido
                    $("#error-email").hide(); // Ocultar error
                } else {
                    $("#error-email").show(); // Mostrar error
                }
            }); 

            $("#btn-register-firma").click(async function() {

                if ($('#tipo_solicitud').val() == "-1") {
                    //alert('Debe seleccionar un Tipo de Régimen');
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Tipo de Solicitud',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    //$('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#tipo_solicitud').focus();
                    return;
                }

                if ($('#tipo_documento').val() == "-1") {
                    //alert('Debe seleccionar un Tipo de Régimen');
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Tipo de Documento',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    //$('.nav-tabs a[href="#datos_tributarios"]').tab('show');
                    $('#tipo_solicitud').focus();
                    return;
                } 

                if ($('#tipo_documento').val() == "1") {
                    if (!/^\d{10}$/.test($('#numero_documento').val())) { 
                        $("#error-numero-documento").show(); 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'El Número  de Documento debe tener 10 dígitos',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        //$('.nav-tabs a[href="#datos_generales"]').tab('show');
                        $('#numero_documento').focus();
                        return;
                    }
                    
                    if ($('#codigo_dactilar').val() == "") {
                        //alert('Debe ingresar la Razón Social');
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe ingresar el Código Dactilar',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        //$('.nav-tabs a[href="#datos_generales"]').tab('show');
                        $('#codigo_dactilar').focus();
                        return;
                    }
                } 
                

                if ($('#nombres').val() == "") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar los Nombres',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#nombres').focus();
                    return;
                }

                if ($('#apellido_paterno').val() == "") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Apellido Paterno',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#apellido_paterno').focus();
                    return;
                }

                if ($('#apellido_materno').val() == "") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar el Apellido Materno',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#apellido_materno').focus();
                    return;
                }

                if ($('#fecha_nacimiento').val() == "") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe ingresar la Fecha de nacimiento',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#fecha_nacimiento').focus();
                    return;
                }

                if ($('#pais').val() == "-1") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar la nacionalidad',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#pais').focus();
                    return;
                }

                if ($('#tipo_sexo').val() == "-1") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Sexo',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#tipo_sexo').focus();
                    return;
                }

                if ($('#celular').val() == "") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar el Celular',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#celular').focus();
                    return;
                } 

                if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test($(
                        '#email').val())) { 
                    $("#error-email").show();
                    //alert('Debe registrar un correo con formato válido');
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar un correo con formato válido',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#email').focus();
                    return;
                }

                if ($('#tipo_solicitud').val() == "1") {
                    if ($('#switch_ruc').is(':checked')) { 
                        
                        if (!/^\d{13}$/.test($('#ruc').val())) { 
                            $("#error-ruc").show(); 
                            await Swal.fire({
                                target: document.getElementById('ModalFirma'),
                                icon: 'error',
                                title: 'Error',
                                text: 'El RUC debe tener 13 dígitos',
                                confirmButtonText: 'Aceptar',
                                allowOutsideClick: false
                            });
                            //$('.nav-tabs a[href="#datos_generales"]').tab('show');
                            $('#ruc').focus();
                            return;
                        }
                    }
                }

                if ($('#tipo_solicitud').val() == "2") {

                    if (!/^\d{13}$/.test($('#ruc_empresa').val())) { 
                        $("#error-ruc-empresa").show(); 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'El RUC debe tener 13 dígitos',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        //$('.nav-tabs a[href="#datos_generales"]').tab('show');
                        $('#ruc_empresa').focus();
                        return;
                    }

                    if ($('#razon_social_empresa').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar la Razón Social de la Empresa',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#razon_social_empresa').focus();
                        return;
                    } 

                    if ($('#cargo_representante').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar el Cargo del Representante',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#cargo_representante').focus();
                        return;
                    } 

                }

                if ($('#tipo_solicitud').val() == "3") {

                    if (!/^\d{13}$/.test($('#ruc_empresa_miembro').val())) { 
                        $("#error-ruc-miembro").show(); 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'El RUC debe tener 13 dígitos',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        //$('.nav-tabs a[href="#datos_generales"]').tab('show');
                        $('#ruc_empresa_miembro').focus();
                        return;
                    }

                    if ($('#razon_social_empresa_miembro').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar la Razón Social de la Empresa',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#razon_social_empresa_miembro').focus();
                        return;
                    } 

                    if ($('#area_miembro').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar el Área',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#area_miembro').focus();
                        return;
                    } 

                    if ($('#motivo_miembro').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar el Motivo',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#motivo_miembro').focus();
                        return;
                    } 

                    if ($('#cargo_solicitante_miembro').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar el Cargo del Solicitante',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#cargo_solicitante_miembro').focus();
                        return;
                    }
                    
                    if ($('#tipo_documento_empresa').val() == "-1") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe seleccionar un Tipo de Documento del Representante Legal',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#tipo_documento_empresa').focus();
                        return;
                    }

                    if (!/^\d{10}$/.test($('#numero_documento_empresa').val())) { 
                        $("#error-numero-documento-empresa").show(); 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'El Número de Documento del Representante Legal debe tener 10 dígitos',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        //$('.nav-tabs a[href="#datos_generales"]').tab('show');
                        $('#numero_documento_empresa').focus();
                        return;
                    }

                    if ($('#nombres_empresa').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar los Nommbres del Representante Legal',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#nombres_empresa').focus();
                        return;
                    }

                    if ($('#apellido_paterno_empresa').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar el Apellido Paterno del Representante Legal',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#apellido_paterno_empresa').focus();
                        return;
                    }

                    if ($('#apellido_materno_empresa').val() == "") { 
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe registrar el APellido Materno del Representante Legal',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        }); 
                        $('#apellido_materno_empresa').focus();
                        return;
                    }

                }

                if ($('#provincia').val() == "-1") {
                    //alert('Debe seleccionar la Provincia');
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar la Provincia',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#provincia').focus();
                    return;
                }

                if ($('#canton').val() == "-1") {
                    //alert('Debe seleccionar el Cantón');
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar la Ciudad',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#canton').focus();
                    return;
                }

                if ($('#direccion_empresa').val() == "") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe registrar la Dirección',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#direccion_empresa').focus();
                    return;
                }
                
                if ($('#tipo_vigencia').val() == "-1") { 
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe seleccionar el Tipo de Vigencia',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    }); 
                    $('#tipo_vigencia').focus();
                    return;
                }

                // Verificar si ambos archivos están cargados en Dropzone
                var cedulaFrontalFile = $('#cedula-frontal')[0].dropzone.getAcceptedFiles();
                var cedulaPosteriorFile = $('#cedula-posterior')[0].dropzone.getAcceptedFiles();
                var cedulaSelfieFile = $('#cedula-selfie')[0].dropzone.getAcceptedFiles();
                var rucImageFile = $('#ruc-image')[0].dropzone.getAcceptedFiles();
                var documentoAdicionalFile = $('#documento-adicional')[0].dropzone.getAcceptedFiles();
                var constitucionCompaniaFile = $('#constitucion-compania')[0].dropzone.getAcceptedFiles();
                var nombramientoRepresentanteFile = $('#nombramiento-representante')[0].dropzone.getAcceptedFiles();
                var aceptacionNombramientoFile = $('#aceptacion-nombramiento')[0].dropzone.getAcceptedFiles();
                var cedulaRepresentanteFile = $('#cedula-representante')[0].dropzone.getAcceptedFiles();
                var autorizacionRepresentanteFile = $('#autorizacion-representante')[0].dropzone.getAcceptedFiles();

                // Validación de archivos
                if (cedulaFrontalFile.length === 0) {
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe cargar la cédula frontal',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    return;
                }

                if (cedulaPosteriorFile.length === 0) {
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe cargar la cédula posterior',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    return;
                }

                if (cedulaSelfieFile.length === 0) {
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe cargar la selfie con cédula',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    return;
                }

                if (rucImageFile.length === 0) {
                    await Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'error',
                        title: 'Error',
                        text: 'Debe cargar la Copia del RUC',
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    return;
                }

                if ($('#tipo_solicitud').val() == "2" || $('#tipo_solicitud').val() == "3") {
                    if (constitucionCompaniaFile.length === 0) {
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe cargar la Constitución de la Comañía',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        return;
                    }

                    if (nombramientoRepresentanteFile.length === 0) {
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe cargar el nombramiento del Representante',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        return;
                    }

                    if (aceptacionNombramientoFile.length === 0) {
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe cargar la aceptación del Nombramiento',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        return;
                    }
                }

                if ($('#tipo_solicitud').val() == "3") {

                    if (cedulaRepresentanteFile.length === 0) {
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe cargar la Cédula del Representante Legal',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        return;
                    }

                    if (autorizacionRepresentanteFile.length === 0) {
                        await Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Debe cargar la autorización del Representante Legal',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                        return;
                    }

                }

                // Si los archivos son válidos, proceder con el envío del formulario
                var formData = new FormData(document.getElementById("ModalFirma"));

                // Agregar los archivos de Dropzone al FormData
                formData.append('cedula_frontal', cedulaFrontalFile[0]);
                formData.append('cedula_posterior', cedulaPosteriorFile[0]);  
                formData.append('cedula_selfie', cedulaSelfieFile[0]);  
                formData.append('ruc_image', rucImageFile[0]);  
                formData.append('documento_adicional', documentoAdicionalFile[0]);  
                formData.append('constitucion_compania', constitucionCompaniaFile[0]);  
                formData.append('nombramiento_representante', nombramientoRepresentanteFile[0]);  
                formData.append('aceptacion_nombramiento', aceptacionNombramientoFile[0]);  
                formData.append('cedula_representante', cedulaRepresentanteFile[0]);  
                formData.append('autorizacion_representante', autorizacionRepresentanteFile[0]);  

                // Verifica si el checkbox está marcado o no antes de enviar el formulario
                if (!$('#switch_ruc').prop('checked')) {
                    // Si no está marcado, asigna un valor vacío o '0' para garantizar que se envíe
                    formData.append('switch_ruc', '0');
                } else {
                    formData.append('switch_ruc', '1'); // Asigna '1' si está marcado
                }

                //$('#carga').show();
                Swal.fire({
                    target: document.getElementById('ModalFirma'),
                    title: 'Enviando datos para registro de Cámara',
                    text: 'Por favor espere',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });

                $.ajax({
                    url: "{{ route('admin.registrar_firma') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(res) {
                    //$('#carga').hide();
                    Swal.close();
                    // Mostrar el mensaje de éxito en un alert
                    Swal.fire({
                        target: document.getElementById('ModalFirma'),
                        icon: 'success', // Cambiado a 'success' para mostrar un mensaje positivo
                        title: 'Éxito',
                        text: res.success,
                        confirmButtonText: 'Aceptar',
                        allowOutsideClick: false
                    });
                    // Recargar la página para reflejar los cambios
                    window.location.href = window.location.href.split('?')[0] + '?noCache=' + new Date().getTime();
                    //table.ajax.reload();
                }).fail(function(res) { 

                    if (res.status === 422) {
                        // Mostrar mensaje de error de validación
                        let errors = res.responseJSON.errors;

                        // Recorre los errores y muestra un mensaje para cada uno
                        let errorMessage = "";
                        for (let field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                // Agregar los errores de cada campo
                                errorMessage += errors[field].join(', ') + "\n";
                            }
                        }

                        Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage, // Mostrar todos los errores concatenados
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                    } else {
                        // Mostrar mensaje genérico si no se recibió un error específico
                        Swal.fire({
                            target: document.getElementById('ModalFirma'),
                            icon: 'error',
                            title: 'Error',
                            text: 'Ocurrió un error al registrar la cámara.',
                            confirmButtonText: 'Aceptar',
                            allowOutsideClick: false
                        });
                    }

                    console.log(res.responseText); // Muestra el error completo en la consola para depuración
                });
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

            $('#fecha_nacimiento').datepicker('destroy').datepicker({
                format: 'dd/mm/yyyy', // Define el formato de fecha
                autoclose: true, // Cierra automáticamente al seleccionar
                todayHighlight: true, // Resalta la fecha actual
                language: 'es' // Asegúrate de establecer el idioma correcto
            }); 
 
            $('#btn-close').on('click', function() {
                // Aquí puedes añadir la lógica para enviar el formulario modificado
                $('#ModalModificarCamara').modal('hide'); // Cerrar el modal después de guardar
            });  

            $('#provincia').change(function() {
                let paisId = 57; // ID del país seleccionado
                let provinciaId = $(this).val(); // ID de la provincia seleccionada

                if (paisId != -1 && provinciaId != -1) {
                    $.ajax({
                        url: '{{ route('funciones_generales.get_cantones') }}', // Ruta para obtener los cantones
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

                Swal.close();
                $('#ModalFirma').modal('show');
            });


    });
</script>
@endsection
