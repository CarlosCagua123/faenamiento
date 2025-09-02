<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Lotes</h2></x-slot>
    <div class="p-6">
        <a href="{{ route('lotes.create') }}" class="btn btn-primary">Nuevo lote</a>
        <x-auth-session-status class="mt-3" :status="session('ok')" />
        <table class="table-auto w-full mt-4 border">
            <thead><tr><th>Código</th><th>Fecha ingreso</th><th>Proveedor</th></tr></thead>
            <tbody>
                @foreach($lotes as $l)
                <tr class="border-b">
                    <td>{{ $l->codigo }}</td>
                    <td>{{ $l->fecha_ingreso }}</td>
                    <td>{{ $l->proveedor }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $lotes->links() }}</div>
    </div>
</x-app-layout>
