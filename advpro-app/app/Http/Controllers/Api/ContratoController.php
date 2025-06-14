<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Cliente;

class ContratoController extends Controller
{
    /**
     * Mostrar todos los contratos (Web y API)
     */
    public function index(Request $request)
    {
        
        $contratos = Contrato::with('cliente')->paginate(10);
        $clientes = Cliente::all(); // Opcional, si necesitas mostrar los clientes relacionados

        return $request->wantsJson()
            ? response()->json($contratos, 200)
            : view('contratos.panel', compact('contratos', 'clientes'));
    }

    /**
     * Crear un nuevo contrato (Web y API)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_contrato' => 'required|string|max:255',
            'cliente_id' => 'required|exists:clientes,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'monto' => 'required|numeric|min:0',
            'estado' => 'required|string|in:activo,inactivo,finalizado,cancelado,pendiente',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        $contrato = Contrato::create($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Contrato creado', 'data' => $contrato], 201)
            : redirect('/contratos/panel')->with('success', 'Contrato creado');
    }

    /**
     * Mostrar un contrato específico (Web y API)
     */
    public function show(Contrato $contrato, Request $request)
    {
        $contrato->load('cliente');

        return $request->wantsJson()
            ? response()->json($contrato, 200)
            : view('contratos.show', compact('contrato'));
    }

    /**
     * Editar un contrato (Web y API)
     */
    public function edit(Contrato $contrato, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($contrato, 200)
            : view('contratos.edit', compact('contrato'));
    }

    /**
     * Actualizar un contrato (Web y API)
     */
    public function update(Request $request, Contrato $contrato)
    {
        $validatedData = $request->validate([
            'nombre_contrato' => 'sometimes|string|max:255',
            'cliente_id' => 'sometimes|required|exists:clientes,id',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'monto' => 'sometimes|numeric|min:0',
            'estado' => 'sometimes|string|in:activo,inactivo,finalizado,cancelado,pendiente',
            'descripcion' => 'nullable|string|max:1000',
        ]);

        $contrato->update($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Contrato actualizado', 'data' => $contrato], 200)
            : redirect('/contratos/panel')->with('success', 'Contrato actualizado');
    }

    /**
     * Eliminar un contrato (Web y API)
     */
    public function destroy(Contrato $contrato, Request $request)
    {
        $contrato->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Contrato eliminado'], 204)
            : redirect('/contratos/panel')->with('success', 'Contrato eliminado');
    }
}
