<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
.table { width:100%; border-collapse: collapse; }
.table th, .table td { border:1px solid #ccc; padding:6px; }
h1,h2 { margin: 0 0 10px; }
.small { color:#666; font-size:11px; }
</style>
</head>
<body>
  <h1>Reporte de Faenas</h1>
  <div class="small">
    @if($filtros['desde']) Desde: {{ $filtros['desde'] }} @endif
    @if($filtros['hasta']) | Hasta: {{ $filtros['hasta'] }} @endif
    @if($filtros['lote'])  | Lote: {{ $filtros['lote'] }} @endif
  </div>

  <h2>Resumen</h2>
  <table class="table" style="margin-bottom:10px">
    <tr><th>Total faenas</th><td>{{ $stats['totalFaenas'] }}</td></tr>
    <tr><th>Peso vivo total (kg)</th><td>{{ number_format($stats['pesoVivo'],2) }}</td></tr>
    <tr><th>Peso canal total (kg)</th><td>{{ number_format($stats['pesoCanal'],2) }}</td></tr>
    <tr><th>Rendimiento (%)</th><td>{{ $stats['rendimiento'] ?? 'N/A' }}</td></tr>
  </table>

  <h2>Detalle</h2>
  <table class="table">
    <thead>
      <tr><th>Fecha</th><th>Arete</th><th>Lote</th><th>Peso vivo</th><th>Peso canal</th></tr>
    </thead>
    <tbody>
      @foreach($faenas as $f)
      <tr>
        <td>{{ $f->fecha }}</td>
        <td>{{ $f->cerdo->arete }}</td>
        <td>{{ $f->cerdo->lote->codigo }}</td>
        <td>{{ optional($f->pesajes->firstWhere('tipo','vivo'))->peso }}</td>
        <td>{{ optional($f->pesajes->firstWhere('tipo','canal'))->peso }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>
