<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::latest()->paginate(10);
        return view('usuarios.index', compact('users'));
    }

    public function create() {
        return view('usuarios.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,operador,inspector',   // ✅ aquí el cambio
        ]);

        $data['password'] = Hash::make($data['password']);

        User::create($data);

        return redirect()->route('usuarios.index')->with('ok', 'Usuario creado.');
    }

    public function edit(User $usuario) {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario) {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => "required|email|unique:users,email,{$usuario->id}",
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,operador,inspector',   // ✅ aquí el cambio
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')->with('ok', 'Usuario actualizado.');
    }

    public function destroy(User $usuario) {
        $usuario->delete();
        return back()->with('ok', 'Usuario eliminado.');
    }
}
