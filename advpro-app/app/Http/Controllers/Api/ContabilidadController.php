<?php

namespace App\Http\Controllers\Api;
namespace App\Http\Controllers;
use App\Models\Contabilidad;
use App\Models\DetalleAsiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContabilidadController extends Controller
{
    // Mostrar todos los asientos
    public function index()
    {
        $asientos = Contabilidad::with('detalles')->latest()->get();
        return response()->json($asientos);
    }

    // Registrar un nuevo asiento contable
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
            'detalles' => 'required|array|min:2', // debe y haber
            'detalles.*.id_cuenta' => 'required|integer|exists:cuenta_contable,id_cuenta',
            'detalles.*.debe' => 'numeric',
            'detalles.*.haber' => 'numeric',
        ]);

        DB::transaction(function () use ($request) {
            $asiento = Contabilidad::create([
                'fecha' => $request->fecha,
                'descripcion' => $request->descripcion,
            ]);

            foreach ($request->detalles as $detalle) {
                DetalleAsiento::create([
                    'id_asiento' => $asiento->id_asiento,
                    'id_cuenta' => $detalle['id_cuenta'],
                    'debe' => $detalle['debe'] ?? 0,
                    'haber' => $detalle['haber'] ?? 0,
                    'descripcion_linea' => $detalle['descripcion_linea'] ?? null
                ]);
            }
        });

        return response()->json(['message' => 'Asiento contable registrado con éxito.'], 201);
    }
}
