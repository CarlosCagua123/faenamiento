<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Nueva faena</h2></x-slot>
    <div class="p-6">
        <form method="POST" action="{{ route('faenas.store') }}" class="space-y-4">
            @csrf
            <div>
                <label>Cerdo</label>
                <select name="cerdo_id" class="input">
                    @foreach($cerdos as $c)
                      <option value="{{ $c->id }}">{{ $c->arete }} (Lote {{ $c->lote->codigo }})</option>
                    @endforeach
                </select>
                @error('cerdo_id')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Fecha</label>
                <input type="date" name="fecha" class="input" value="{{ old('fecha', now()->toDateString()) }}">
                @error('fecha')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Categoría</label>
                <input name="categoria" class="input" value="{{ old('categoria') }}" placeholder="normal/urgente">
            </div>
            <div>
                <label>Peso vivo (kg)</label>
                <input type="number" step="0.01" name="peso_vivo" class="input" value="{{ old('peso_vivo') }}">
            </div>
            <div>
                <label>Peso canal (kg)</label>
                <input type="number" step="0.01" name="peso_canal" class="input" value="{{ old('peso_canal') }}">
            </div>
            <div>
                <label>Observaciones</label>
                <textarea name="observaciones" class="input">{{ old('observaciones') }}</textarea>
            </div>
            <button class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-app-layout>
