<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Gestión de Usuarios</h2>
    </x-slot>

    <div class="p-6">
        <!-- Botón para crear -->
        <div class="mb-4">
            <a href="{{ route('usuarios.create') }}" class="btn-primary">+ Nuevo Usuario</a>
        </div>

        <!-- Mensajes de éxito -->
        @if(session('ok'))
            <div class="alert-ok mb-4">
                {{ session('ok') }}
            </div>
        @endif

        <!-- Tabla -->
        <div class="overflow-x-auto">
            <table class="w-full table-basic">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                @if($u->role === 'admin')
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">Administrador</span>
                                @elseif($u->role === 'operador')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Operador</span>
                                @elseif($u->role === 'inspector')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">Inspector</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded text-sm">{{ ucfirst($u->role) }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('usuarios.edit', $u) }}" class="btn-secondary">Editar</a>
                                <form method="POST" action="{{ route('usuarios.destroy', $u) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger"
                                            onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">No hay usuarios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
