<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Dashboard</h2>
  </x-slot>

  <div class="p-6 space-y-6">
    {{-- Acciones rápidas --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <a href="{{ route('lotes.index') }}" class="card hover:bg-gray-50 transition">
        <div class="flex items-center justify-between">
          <h3 class="font-semibold text-lg">Lotes</h3>
          <span class="btn-secondary px-3 py-1">Ir</span>
        </div>
        <p class="text-sm text-gray-500 mt-1">Ver y crear lotes</p>
      </a>

      <a href="{{ route('cerdos.index') }}" class="card hover:bg-gray-50 transition">
        <div class="flex items-center justify-between">
          <h3 class="font-semibold text-lg">Cerdos</h3>
          <span class="btn-secondary px-3 py-1">Ir</span>
        </div>
        <p class="text-sm text-gray-500 mt-1">Registro y consulta</p>
      </a>

      <a href="{{ route('faenas.index') }}" class="card hover:bg-gray-50 transition">
        <div class="flex items-center justify-between">
          <h3 class="font-semibold text-lg">Faenas</h3>
          <span class="btn-secondary px-3 py-1">Ir</span>
        </div>
        <p class="text-sm text-gray-500 mt-1">Gestión de faenas</p>
      </a>

      <a href="{{ route('reportes.index') }}" class="card hover:bg-gray-50 transition">
        <div class="flex items-center justify-between">
          <h3 class="font-semibold text-lg">Reportes</h3>
          <span class="btn-secondary px-3 py-1">Ir</span>
        </div>
        <p class="text-sm text-gray-500 mt-1">Listar, filtrar, exportar</p>
      </a>
    </div>

    {{-- Resumen rápido (ejemplo; si no tienes datos aún, puedes ocultar) --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <div class="card">
        <div class="text-sm text-gray-500">Total Lotes</div>
        <div class="text-2xl font-bold mt-1">{{ $totalLotes ?? '—' }}</div>
      </div>
      <div class="card">
        <div class="text-sm text-gray-500">Cerdos Registrados</div>
        <div class="text-2xl font-bold mt-1">{{ $totalCerdos ?? '—' }}</div>
      </div>
      <div class="card">
        <div class="text-sm text-gray-500">Faenas del mes</div>
        <div class="text-2xl font-bold mt-1">{{ $faenasMes ?? '—' }}</div>
      </div>
      <div class="card">
        <div class="text-sm text-gray-500">Rend. promedio</div>
        <div class="text-2xl font-bold mt-1">
          {{ isset($rendPromedio) ? $rendPromedio.' %' : '—' }}
        </div>
      </div>
    </div>

    {{-- Bloque de usuarios (solo admin) --}}
    @can('admin')
      <div class="card">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
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

    {{-- Alertas de ejemplo --}}
    @if(session('ok'))
      <div class="alert-ok">{{ session('ok') }}</div>
    @endif
    @if(session('warn'))
      <div class="alert-warning">{{ session('warn') }}</div>
    @endif
  </div>
</x-app-layout>
