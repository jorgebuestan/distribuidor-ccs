<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firmas Electrónicas Emitidas</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto; /* Esto permite que las columnas se ajusten al contenido */
        }

        th, td {
            padding: 8px;
            text-align: left;
            font-size: 12px;
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
            max-width: 120px; /* Ajusta según sea necesario, pero no se aplica directamente en tipo_solicitud y numero_documento */
        } 

        /* Ancho fijo para la columna 'Número de Documento' (columna 4) */

        td:nth-child(2), th:nth-child(2) {
            width: 150px; /* Ajusta el valor a lo que necesites */
            text-align: left; /* Opcional: centra el texto */
        }


        td:nth-child(3), th:nth-child(3) {
            width: 80px; /* Ajusta el valor a lo que necesites */
            text-align: left; /* Opcional: centra el texto */
        }

        td:nth-child(4), th:nth-child(4) {
            width: 80px; /* Ajusta el valor a lo que necesites */
            text-align: left; /* Opcional: centra el texto */
        }

    </style>
</head>
<body>
    <h2>Listado de Firmas Emitidas</h2>

    <table>
        <thead>
            <tr>
                <th>FECHA DE EMISIÓN</th>
                <th>CLIENTE</th>
                <th>TIPO DE FIRMA</th>
                <th>VIGENCIA FIRMA</th>
                <th>ÚLTIMO ESTADO</th>
                <th>ÚLTIMA CONSULTA</th>
                <th>OBSERVACIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($firmas as $firma)
                <tr>
                    <td>{{ $firma->created_at }}</td>
                    <td>{{ $firma->cliente }} </td>
                    <td>{{ $firma->tipo_solicitud }}</td>
                    <td>{{ $firma->tipo_vigencia }}</td>
                    <td>{{ "EMITIDO (VÁLIDO)"}}</td>
                    <td>{{ $firma->updated_at }}</td>
                    <td>{{ "" }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>