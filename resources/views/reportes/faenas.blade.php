<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Reporte de Faenas</h2></x-slot>

  <style>@media print {.no-print{display:none}}</style>

  <div class="p-6">
    <div class="no-print mb-4 flex gap-2">
      <a class="btn-secondary" href="{{ route('reportes.index') }}">Volver</a>
      <button class="btn-primary" onclick="window.print()">Imprimir</button>
    </div>

    <div class="grid sm:grid-cols-4 gap-4 mb-4">
      <div class="card">Total faenas: <b>{{ $totalFaenas }}</b></div>
      <div class="card">Peso vivo (kg): <b>{{ number_format($pesoVivo,2) }}</b></div>
      <div class="card">Peso canal (kg): <b>{{ number_format($pesoCanal,2) }}</b></div>
      <div class="card">Rendimiento (%): <b>{{ $rendimiento ?? 'N/A' }}</b></div>
    </div>

    <table class="w-full table-basic">
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
  </div>
  <div class="no-print mb-4 flex flex-wrap gap-2">
  <a class="btn-secondary" href="{{ route('reportes.index') }}">Volver</a>
  <button class="btn-primary" onclick="window.print()">Imprimir</button>

  {{-- Export CSV conservando filtros --}}
  <a class="btn-secondary"
     href="{{ route('reportes.faenas.csv', request()->only('desde','hasta','lote_id')) }}">
     Exportar CSV
  </a>

  {{-- Export PDF conservando filtros --}}
  <a class="btn-secondary"
     href="{{ route('reportes.faenas.pdf', request()->only('desde','hasta','lote_id')) }}">
     Exportar PDF
  </a>
</div>
</x-app-layout>
