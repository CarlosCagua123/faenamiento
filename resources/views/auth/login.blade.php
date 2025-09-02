<x-guest-layout>
    <div class="max-w-md mx-auto bg-white border border-gray-200 rounded-lg shadow p-6 mt-8">
        <h2 class="text-2xl font-bold text-center text-blue-700 mb-6">
            Iniciar sesión - Faenamiento de Cerdos
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 alert-ok" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="label">Correo electrónico</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="input" required autofocus autocomplete="username">
                @error('email') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="label">Contraseña</label>
                <input id="password" type="password" name="password"
                       class="input" required autocomplete="current-password">
                @error('password') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="remember_me" class="ml-2 text-sm text-gray-600">
                    Recuérdame
                </label>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-sm text-blue-600 hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <button type="submit" class="btn-primary">
                    Ingresar
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
