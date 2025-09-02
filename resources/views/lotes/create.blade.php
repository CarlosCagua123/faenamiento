<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Nuevo lote</h2></x-slot>
    <div class="p-6">
        <form method="POST" action="{{ route('lotes.store') }}" class="space-y-4">
            @csrf
            <div>
                <label>Código</label>
                <input name="codigo" value="{{ old('codigo') }}" class="input">
                @error('codigo')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Fecha ingreso</label>
                <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}" class="input">
                @error('fecha_ingreso')<div class="text-red-600">{{ $message }}</div>@enderror
            </div>
            <div>
                <label>Proveedor</label>
                <input name="proveedor" value="{{ old('proveedor') }}" class="input">
            </div>
            <button class="btn btn-primary">Guardar</button>
        </form>
    </div>
</x-app-layout>
