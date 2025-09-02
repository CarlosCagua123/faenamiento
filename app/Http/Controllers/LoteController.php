<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    public function index() {
        $lotes = Lote::latest()->paginate(10);
        return view('lotes.index', compact('lotes'));
    }

    public function create() {
        return view('lotes.create');
    }

    public function store(Request $request) {
        $data = $request->validate([
            'codigo' => 'required|string|max:50|unique:lotes,codigo',
            'fecha_ingreso' => 'required|date',
            'proveedor' => 'nullable|string|max:120',
        ]);
        Lote::create($data);
        return redirect()->route('lotes.index')->with('ok','Lote creado');
    }
}
