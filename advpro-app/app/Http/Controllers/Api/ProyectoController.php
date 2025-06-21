<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Cliente;
use App\Models\Staff;

class ProyectoController extends Controller
{
    /**
     * Mostrar todos los proyectos (Web y API)
     */
    public function index(Request $request)
    {
        $clientes = Cliente::all();
        $personal = Staff::all();

        // 🔹 CAMBIO AQUÍ: Usamos 'cliente' en lugar de 'clienteRelation' para eager loading
        $proyectos = Proyecto::with(['cliente', 'responsable'])->paginate(7);


        return $request->wantsJson()
            ? response()->json(['proyectos' => $proyectos, 'clientes' => $clientes, 'personal' => $personal], 200)
            : view('proyectos.panel', compact('proyectos', 'clientes', 'personal'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cliente_id' => 'required|exists:clientes,id', // Debe ser un ID válido de la tabla clientes
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'presupuesto' => 'nullable|numeric|min:0',
            'estado' => 'required|string|in:En espera,En proceso,Realizado',
            'lugar' => 'nullable|string|max:255',
           'responsable_id' => 'nullable|exists:staff,id',

        ]);

        $proyecto = Proyecto::create($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Proyecto creado', 'data' => $proyecto], 201)
            : redirect()->route('proyectos.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'message' => 'Proyecto creado correctamente.',
                'button' => 'Aceptar'
            ]);
    }

    /**
     * Mostrar un proyecto específico (Web y API)
     */
    public function show(Proyecto $proyecto, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($proyecto, 200)
            : view('proyectos.show', compact('proyecto'));
    }


    public function edit(Proyecto $proyecto, Request $request)
    {
        $clientes = Cliente::all();
        $personal = Staff::all();

        return $request->wantsJson()
            ? response()->json($proyecto, 200)
            : view('proyectos.edit', compact('proyecto', 'clientes', 'personal'));
    }

  
    public function update(Request $request, Proyecto $proyecto)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'cliente_id' => 'sometimes|required|exists:clientes,id',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'presupuesto' => 'nullable|numeric|min:0',
            'estado' => 'sometimes|string|in:En espera,En proceso,Realizado',
            'lugar' => 'nullable|string|max:255',
            'responsable_id' => 'nullable|exists:staff,id',
        ]);

        $proyecto->update($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Proyecto actualizado', 'data' => $proyecto], 200)
            : redirect()->route('proyectos.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'message' => 'Proyecto actualizado correctamente.',
                'button' => 'Aceptar'
            ]);
    }

    /**
     * Eliminar un proyecto (Web y API)
     */
    public function destroy(Proyecto $proyecto, Request $request)
    {
        $proyecto->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Proyecto eliminado'], 204)
            : redirect()->route('proyectos.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'message' => 'Proyecto eliminado correctamente.',
                'button' => 'Aceptar'
            ]);
    }
}