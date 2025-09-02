<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Editar Usuario</h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST" action="{{ route('usuarios.update', $usuario) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label class="label">Nombre</label>
                <input type="text" name="name" value="{{ old('name', $usuario->name) }}" class="input" required>
                @error('name') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="label">Email</label>
                <input type="email" name="email" value="{{ old('email', $usuario->email) }}" class="input" required>
                @error('email') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <!-- Contraseña -->
            <div>
                <label class="label">Nueva Contraseña (opcional)</label>
                <input type="password" name="password" class="input">
                @error('password') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <!-- Confirmar contraseña -->
            <div>
                <label class="label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="input">
            </div>

            <!-- Rol -->
            <div>
                <label class="label">Rol</label>
                <select name="role" class="input" required>
                    <option value="admin" {{ old('role', $usuario->role)=='admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="operador" {{ old('role', $usuario->role)=='operador' ? 'selected' : '' }}>Operador</option>
                    <option value="inspector" {{ old('role', $usuario->role)=='inspector' ? 'selected' : '' }}>Inspector</option>
                </select>
                @error('role') <div class="text-red-600">{{ $message }}</div> @enderror
            </div>

            <!-- Botón -->
            <div>
                <button type="submit" class="btn-primary">Actualizar</button>
                <a href="{{ route('usuarios.index') }}" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
