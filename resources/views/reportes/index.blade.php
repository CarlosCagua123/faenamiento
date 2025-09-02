<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Reportes</h2></x-slot>
  <div class="p-6 max-w-4xl">
    <form method="GET" action="{{ route('reportes.faenas') }}" class="grid sm:grid-cols-4 gap-4">
      <div><label class="label">Desde</label><input class="input" type="date" name="desde"></div>
      <div><label class="label">Hasta</label><input class="input" type="date" name="hasta"></div>
      <div>
        <label class="label">Lote</label>
        <select name="lote_id" class="input">
          <option value="">Todos</option>
          @foreach($lotes as $l) <option value="{{ $l->id }}">{{ $l->codigo }}</option> @endforeach
        </select>
      </div>
      <div class="flex items-end"><button class="btn-primary w-full">Generar</button></div>
    </form>
  </div>
</x-app-layout>
<div class="mt-6">
  <h3 class="font-semibold mb-2">Reporte por Lote</h3>
  <div class="flex gap-2">
    <form onsubmit="if(!this.lote_id.value){alert('Selecciona un lote');return false;}"
          method="GET" action="{{ route('reportes.lote', ['lote' => 'ID']) }}"
          id="formLote">
      <select class="input" name="lote_id" id="loteSelect">
        <option value="">Selecciona lote</option>
        @foreach($lotes as $l) <option value="{{ $l->id }}">{{ $l->codigo }}</option> @endforeach
      </select>
      <button type="button" class="btn-primary"
        onclick="if(document.getElementById('loteSelect').value){window.location='{{ url('reportes/lote') }}/'+document.getElementById('loteSelect').value}">
        Ver reporte
      </button>
    </form>
  </div>
</div>
