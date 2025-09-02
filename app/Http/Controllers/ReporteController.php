<?php
namespace App\Http\Controllers;

use App\Models\Faena;
use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class ReporteController extends Controller
{
    public function index() {
        $lotes = Lote::orderBy('codigo')->get();
        return view('reportes.index', compact('lotes'));
    }

    // Listado general con filtros (ya lo tenías)
    public function faenas(Request $request) {
        [$faenas, $stats] = $this->queryFaenas($request);
        return view('reportes.faenas', [
            'faenas' => $faenas,
            'totalFaenas' => $stats['totalFaenas'],
            'pesoVivo' => $stats['pesoVivo'],
            'pesoCanal' => $stats['pesoCanal'],
            'rendimiento' => $stats['rendimiento'],
            'desde' => $request->input('desde'),
            'hasta' => $request->input('hasta'),
            'loteId' => $request->input('lote_id'),
        ]);
    }

    // ========== CSV ==========
    public function faenasCsv(Request $request) {
        [$faenas, $stats] = $this->queryFaenas($request);

        $filename = 'faenas_' . now()->format('Ymd_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($faenas, $stats) {
            $out = fopen('php://output', 'w');
            // BOM para Excel/UTF-8
            fprintf($out, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($out, ['Fecha','Arete','Lote','Peso vivo (kg)','Peso canal (kg)']);
            foreach ($faenas as $f) {
                $vivo  = optional($f->pesajes->firstWhere('tipo','vivo'))->peso;
                $canal = optional($f->pesajes->firstWhere('tipo','canal'))->peso;
                fputcsv($out, [$f->fecha, $f->cerdo->arete, $f->cerdo->lote->codigo, $vivo, $canal]);
            }
            fputcsv($out, []); // línea en blanco
            fputcsv($out, ['Resumen']);
            fputcsv($out, ['Total faenas', $stats['totalFaenas']]);
            fputcsv($out, ['Peso vivo total (kg)', $stats['pesoVivo']]);
            fputcsv($out, ['Peso canal total (kg)', $stats['pesoCanal']]);
            fputcsv($out, ['Rendimiento (%)', $stats['rendimiento'] ?? 'N/A']);

            fclose($out);
        };

        return Response::stream($callback, 200, $headers);
    }

    // ========== PDF ==========
    public function faenasPdf(Request $request) {
        [$faenas, $stats] = $this->queryFaenas($request);
        $html = view('reportes.pdf.faenas', [
            'faenas' => $faenas,
            'stats'  => $stats,
            'filtros'=> [
                'desde' => $request->input('desde'),
                'hasta' => $request->input('hasta'),
                'lote'  => optional(Lote::find($request->input('lote_id')))->codigo,
            ],
        ])->render();

        $pdf = app('dompdf.wrapper');
        $pdf->loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->download('faenas_' . now()->format('Ymd_His') . '.pdf');
    }

    // ========== Reporte por lote con gráfico ==========
    public function reportePorLote(Lote $lote) {
        $faenas = Faena::with(['cerdo','pesajes' => fn($q)=>$q->whereIn('tipo',['vivo','canal'])])
            ->whereHas('cerdo', fn($q)=>$q->where('lote_id',$lote->id))
            ->orderBy('fecha')
            ->get();

        // dataset simple: fecha -> vivo/canal
        $labels = [];
        $vivos = [];
        $canales = [];
        foreach ($faenas as $f) {
            $labels[] = $f->fecha;
            $vivos[]  = (float) optional($f->pesajes->firstWhere('tipo','vivo'))->peso ?? 0;
            $canales[]= (float) optional($f->pesajes->firstWhere('tipo','canal'))->peso ?? 0;
        }

        $pesoVivo  = array_sum($vivos);
        $pesoCanal = array_sum($canales);
        $rend = $pesoVivo > 0 ? round($pesoCanal / $pesoVivo * 100, 2) : null;

        return view('reportes.lote', [
            'lote'   => $lote,
            'faenas' => $faenas,
            'labels' => $labels,
            'vivos'  => $vivos,
            'canales'=> $canales,
            'pesoVivo' => $pesoVivo,
            'pesoCanal'=> $pesoCanal,
            'rendimiento' => $rend
        ]);
    }

    // ========== Helper de consultas ==========
    private function queryFaenas(Request $request): array
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $loteId= $request->input('lote_id');

        $faenas = Faena::with(['cerdo.lote','pesajes' => fn($q) => $q->whereIn('tipo',['vivo','canal'])])
            ->when($desde, fn($q)=>$q->whereDate('fecha','>=',$desde))
            ->when($hasta, fn($q)=>$q->whereDate('fecha','<=',$hasta))
            ->when($loteId, fn($q)=>$q->whereHas('cerdo', fn($qq)=>$qq->where('lote_id',$loteId)))
            ->orderBy('fecha','desc')
            ->get();

        $totalFaenas = $faenas->count();
        $pesoVivo   = $faenas->flatMap->pesajes->where('tipo','vivo')->sum('peso');
        $pesoCanal  = $faenas->flatMap->pesajes->where('tipo','canal')->sum('peso');
        $rendimiento = $pesoVivo > 0 ? round($pesoCanal / $pesoVivo * 100, 2) : null;

        return [$faenas, compact('totalFaenas','pesoVivo','pesoCanal','rendimiento')];
    }
}
