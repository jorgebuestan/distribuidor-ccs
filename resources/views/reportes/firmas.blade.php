<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>firmas por Cámara</title>
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
    <h2>Listado de Firmas Registradas</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Solicitud</th>
                <th>Tipo de Documento</th>
                <th>Número de Documento</th>
                <th>Nombres</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Celular</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($firmas as $firma)
                <tr>
                    <td>{{ $firma->id }}</td>
                    <td>{{ $firma->tipo_solicitud }}</td>
                    <td>{{ $firma->tipo_documento }}</td>
                    <td>{{ $firma->numero_documento }}</td>
                    <td>{{ $firma->nombres }}</td>
                    <td>{{ $firma->apellido_paterno }}</td>
                    <td>{{ $firma->apellido_materno }}</td>
                    <td>{{ $firma->celular }}</td>
                    <td>{{ $firma->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>