<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Faenas</h2></x-slot>
  <div class="p-6">
    <a href="{{ route('faenas.create') }}" class="btn btn-primary">Nueva faena</a>
    <x-auth-session-status class="mt-3" :status="session('ok')" />
    <table class="table-auto w-full mt-4 border">
      <thead><tr><th>Fecha</th><th>Arete</th><th>Lote</th><th>Peso vivo</th><th>Peso canal</th></tr></thead>
      <tbody>
        @foreach($faenas as $f)
        <tr class="border-b">
          <td>{{ $f->fecha }}</td>
          <td>{{ $f->cerdo->arete }}</td>
          <td>{{ $f->cerdo->lote->codigo }}</td>
          <td>{{ optional($f->pesajes->firstWhere('tipo','vivo'))->peso }}</td>
          <td>{{ optional($f->pesajes->firstWhere('tipo','canal'))->peso }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="mt-4">{{ $faenas->links() }}</div>
  </div>
</x-app-layout>
