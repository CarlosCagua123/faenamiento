<?php

namespace App\Http\Controllers;

use App\Models\Faena;
use App\Models\Cerdo;
use App\Models\Pesaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FaenaController extends Controller
{
    public function index() {
        $faenas = Faena::with(['cerdo.lote','pesajes'])->latest()->paginate(10);
        return view('faenas.index', compact('faenas'));
    }

    public function create() {
        $cerdos = Cerdo::where('estado','vivo')->orderBy('arete')->get();
        return view('faenas.create', compact('cerdos'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'cerdo_id' => 'required|exists:cerdos,id',
            'fecha' => 'required|date',
            'categoria' => 'nullable|string|max:20',
            'observaciones' => 'nullable|string',
            'peso_vivo' => 'nullable|numeric|min:0',
            'peso_canal' => 'nullable|numeric|min:0',
        ]);

        DB::transaction(function() use ($data) {
            $faena = Faena::create([
                'cerdo_id' => $data['cerdo_id'],
                'fecha' => $data['fecha'],
                'categoria' => $data['categoria'] ?? null,
                'observaciones' => $data['observaciones'] ?? null,
            ]);

            if (!empty($data['peso_vivo'])) {
                Pesaje::create(['faena_id'=>$faena->id,'tipo'=>'vivo','peso'=>$data['peso_vivo']]);
            }
            if (!empty($data['peso_canal'])) {
                Pesaje::create(['faena_id'=>$faena->id,'tipo'=>'canal','peso'=>$data['peso_canal']]);
            }

            // Marcar cerdo como faenado
            $faena->cerdo->update(['estado' => 'faenado']);
        });

        return redirect()->route('faenas.index')->with('ok','Faena registrada');
    }
}
