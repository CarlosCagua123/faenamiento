<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl">Cerdos</h2></x-slot>
    <div class="p-6">
        <a href="{{ route('cerdos.create') }}" class="btn btn-primary">Nuevo cerdo</a>
        <x-auth-session-status class="mt-3" :status="session('ok')" />
        <table class="table-auto w-full mt-4 border">
            <thead><tr><th>Arete</th><th>Lote</th><th>Sexo</th><th>Estado</th></tr></thead>
            <tbody>
                @foreach($cerdos as $c)
                <tr class="border-b">
                    <td>{{ $c->arete }}</td>
                    <td>{{ $c->lote->codigo }}</td>
                    <td>{{ $c->sexo }}</td>
                    <td>{{ $c->estado }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">{{ $cerdos->links() }}</div>
    </div>
</x-app-layout>
