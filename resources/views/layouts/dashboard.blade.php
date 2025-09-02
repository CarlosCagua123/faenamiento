<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Panel principal</h2>
  </x-slot>

  <div class="p-6">
    {{-- Acciones rápidas para todos --}}
    <div class="grid sm:grid-cols-3 gap-4 mb-6">
      <a href="{{ route('lotes.index') }}" class="card block p-4 hover:bg-gray-50">
        <h3 class="font-semibold mb-1">Lotes</h3>
        <p class="text-sm text-gray-500">Ver y crear lotes</p>
      </a>
      <a href="{{ route('cerdos.index') }}" class="card block p-4 hover:bg-gray-50">
        <h3 class="font-semibold mb-1">Cerdos</h3>
        <p class="text-sm text-gray-500">Registro y consulta</p>
      </a>
      <a href="{{ route('reportes.index') }}" class="card block p-4 hover:bg-gray-50">
        <h3 class="font-semibold mb-1">Reportes</h3>
        <p class="text-sm text-gray-500">Listar, filtrar, exportar</p>
      </a>
    </div>

    {{-- Solo admin: gestionar usuarios --}}
    @can('admin')
      <div class="card p-4">
        <div class="flex items-center justify-between">
          <div>
            <h3 class="font-semibold text-lg">Usuarios</h3>
            <p class="text-sm text-gray-500">Crear y administrar usuarios del sistema</p>
          </div>
          <div class="flex gap-2">
            <a href="{{ route('usuarios.index') }}" class="btn-secondary">Gestionar</a>
            <a href="{{ route('usuarios.create') }}" class="btn-primary">Crear usuario</a>
          </div>
        </div>
      </div>
    @endcan
  </div>
</x-app-layout>
