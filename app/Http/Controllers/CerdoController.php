<?php

namespace App\Http\Controllers;

use App\Models\Cerdo;
use App\Models\Lote;
use Illuminate\Http\Request;

class CerdoController extends Controller
{
    public function index() {
        $cerdos = Cerdo::with('lote')->latest()->paginate(10);
        return view('cerdos.index', compact('cerdos'));
    }

    public function create() {
        $lotes = Lote::orderBy('codigo')->get();
        return view('cerdos.create', compact('lotes'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'lote_id' => 'required|exists:lotes,id',
            'arete'   => 'required|string|max:50|unique:cerdos,arete',
            'sexo'    => 'nullable|in:M,H',
            'peso_inicial' => 'nullable|numeric|min:0',
            'fecha_nacimiento' => 'nullable|date',
        ]);
        Cerdo::create($data + ['estado' => 'vivo']);
        return redirect()->route('cerdos.index')->with('ok','Cerdo registrado');
    }
}
