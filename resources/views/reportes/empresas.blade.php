<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas Registradas</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        table {
            width: 100%; /* Ajusta el ancho de la tabla, puedes reducirlo si es necesario */
            border-collapse: collapse;
            table-layout: fixed; /* Asegura que las columnas se ajusten al tamaño */
        }

        th, td {
            padding: 5px; /* Reduce el padding para hacer la tabla más compacta */
            text-align: left;
            font-size: 10px; /* Reduce el tamaño de la fuente */
            word-wrap: break-word;
        }

        th {
            background-color: #003366; /* Azul oscuro */
            color: white; /* Texto blanco */
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2; /* Gris claro para filas impares */
        }

        tr:nth-child(even) {
            background-color: #ffffff; /* Sin color (blanco) para filas pares */
        }

        td {
            max-width: 100px; /* Ajusta el tamaño máximo de las celdas */
        }

        td:nth-child(2), th:nth-child(2) {
            width: 100px; /* Ajusta el valor a lo que necesites */
            text-align: left;
        }

        td:nth-child(3), th:nth-child(3) {
            width: 120px;
            text-align: left;
        }

        td:nth-child(4), th:nth-child(4) {
            width: 150px;
            text-align: left;
        }

        td:nth-child(5), th:nth-child(5) {
            width: 130px;
            text-align: left;
        }

        td:nth-child(6), th:nth-child(6) {
            width: 120px;
            text-align: left;
        }

        td:nth-child(7), th:nth-child(7) {
            width: 100px;
            text-align: left;
        }

        td:nth-child(8), th:nth-child(8) {
            width: 150px;
            text-align: left;
        }

        td:nth-child(9), th:nth-child(9) {
            width: 130px;
            text-align: left;
        }

        td:nth-child(10), th:nth-child(10) {
            width: 180px;
            text-align: left;
        }

        td:nth-child(11), th:nth-child(11) {
            width: 120px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Listado de Empresas Registradas</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>RUC</th>
                <th>Razón Social</th>
                <th>Obligado a llevar contabilidad</th>
                <th>Tipo de Contribuyente</th>  
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo Administrativo</th>
                <th>Contribuyente Especial</th>
                <th>Correo Comprobante Electrónico</th>
                <th>Tipo de Ambiente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empresas as $empresa)
                <tr>
                    <td>{{ $empresa->id }}</td>
                    <td>{{ $empresa->ruc }}</td>
                    <td>{{ $empresa->razon_social }}</td>
                    <td>{{ $empresa->obligado_contabilidad}}</td>
                    <td>{{ $empresa->tipo_contribuyente }}</td>
                    <td>{{ $empresa->direccion}}</td>
                    <td>{{ $empresa->telefono }}</td>
                    <td>{{ $empresa->correo_administrativo}}</td>
                    <td>{{ $empresa->contribuyente_especial}}</td>
                    <td>{{ $empresa->correo_comprobante_electronico}}</td>
                    <td>{{ $empresa->tipo_ambiente }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
