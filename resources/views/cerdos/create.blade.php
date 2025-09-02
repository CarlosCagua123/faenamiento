<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Nuevo cerdo</h2></x-slot>
    <div class="p-6">
        <form method="POST" action="{{ route('cerdos.store') }}" class="space-y-4">
            @csrf
            <div>
                <label>Lote</label>
                <select name="lote_id" class="input">
                    @foreach($lotes as $l)
                      <option value="{{ $l->id }}">{{ $l->codigo }}</option>
                    @endforeach
                </select>
                @error('lote_id')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Arete</label>
                <input name="arete" value="{{ old('arete') }}" class="input">
                @error('arete')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Sexo</label>
                <select name="sexo" class="input">
                    <option value="">-</option>
                    <option value="M">M</option>
                    <option value="H">H</option>
                </select>
            </div>
            <div>
                <label>Peso inicial (kg)</label>
                <input type="number" step="0.01" name="peso_inicial" class="input" value="{{ old('peso_inicial') }}">
            </div>
            <div>
                <label>Fecha nacimiento</label>
                <input type="date" name="fecha_nacimiento" class="input" value="{{ old('fecha_nacimiento') }}">
            </div>
            <button class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-app-layout>
