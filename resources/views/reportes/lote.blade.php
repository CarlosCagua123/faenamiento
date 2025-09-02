<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">
    Reporte por Lote: {{ $lote->codigo }}
  </h2></x-slot>

  <div class="p-6">
    <div class="grid sm:grid-cols-3 gap-4 mb-6">
      <div class="card">Peso vivo total: <b>{{ number_format($pesoVivo,2) }} kg</b></div>
      <div class="card">Peso canal total: <b>{{ number_format($pesoCanal,2) }} kg</b></div>
      <div class="card">Rendimiento: <b>{{ $rendimiento ?? 'N/A' }} %</b></div>
    </div>

    <div class="card p-4 mb-6">
      <canvas id="chartPesos" height="110"></canvas>
    </div>

    <table class="w-full table-basic">
      <thead>
        <tr><th>Fecha</th><th>Arete</th><th>Peso vivo</th><th>Peso canal</th></tr>
      </thead>
      <tbody>
        @foreach($faenas as $f)
          <tr>
            <td>{{ $f->fecha }}</td>
            <td>{{ $f->cerdo->arete }}</td>
            <td>{{ optional($f->pesajes->firstWhere('tipo','vivo'))->peso }}</td>
            <td>{{ optional($f->pesajes->firstWhere('tipo','canal'))->peso }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Chart.js desde CDN --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <script>
    const labels = @json($labels);
    const vivos  = @json($vivos);
    const canales= @json($canales);

    new Chart(document.getElementById('chartPesos'), {
      type: 'line',
      data: {
        labels,
        datasets: [
          { label: 'Peso vivo (kg)',  data: vivos },
          { label: 'Peso canal (kg)', data: canales }
        ]
      },
      options: {
        responsive: true,
        interaction: { mode: 'index', intersect: false },
        scales: {
          y: { beginAtZero: true }
        }
      }
    });
  </script>
</x-app-layout>
