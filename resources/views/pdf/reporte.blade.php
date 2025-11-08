<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Reporte de Estudiantes</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
    h1 { text-align: center; color: #2b6cb0; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
    th { background-color: #e2e8f0; }
    tr:nth-child(even) { background-color: #f8fafc; }
  </style>
</head>
<body>
  <h1>Listado de Estudiantes</h1>

  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Código</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>DNI</th>
        <th>Carrera</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($estudiantes as $i => $est)
      <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $est->codigo }}</td>
        <td>{{ $est->nombres }}</td>
        <td>{{ $est->pri_ape }} {{ $est->seg_ape }}</td>
        <td>{{ $est->dni }}</td>
        <td>{{ $est->carrera }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <p style="margin-top: 20px; text-align: right;">
    Generado el {{ now()->format('d/m/Y H:i') }}
  </p>
</body>
</html>
