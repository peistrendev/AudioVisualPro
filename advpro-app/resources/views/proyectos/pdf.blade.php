<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Proyectos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            text-align: center;
            color: #4a4a4a;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10px; /* Tamaño de fuente más pequeño para que quepa más contenido */
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-center { text-align: center; }
        .total-row {
            font-weight: bold;
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>

    <h1>Reporte de Proyectos</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Presupuesto</th>
                <th>Lugar</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id }}</td>
                    <td>{{ $proyecto->nombre }}</td>
                    <td>{{ $proyecto->cliente->nombre ?? 'N/A' }}</td>
                    <td>{{ $proyecto->estado }}</td>
                    <td>{{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}</td>
                    <td>{{ $proyecto->fecha_fin ? \Carbon\Carbon::parse($proyecto->fecha_fin)->format('d/m/Y') : 'N/A' }}</td>
                    <td>${{ number_format($proyecto->presupuesto, 2, ',', '.') }}</td>
                    <td>{{ $proyecto->lugar }}</td>
                    <td>{{ $proyecto->responsable->nombre ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No hay proyectos que coincidan con los filtros.</td>
                </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="6">Total de Proyectos:</td>
                <td>{{ count($proyectos) }}</td>
                <td colspan="2"></td>
            </tr>
        </tbody>
    </table>

</body>
</html>