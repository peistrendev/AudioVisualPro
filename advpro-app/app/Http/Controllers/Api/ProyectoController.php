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
            $proyectos = Proyecto::paginate(7);
            $clientes = Cliente::paginate(10);
            $personal = staff::paginate(100);
        
            return $request->wantsJson()
                ? response()->json(['proyectos' => $proyectos, 'clientes' => $clientes, 'personal'=>$personal], 200)
                : view('proyectos.panel', compact('proyectos', 'clientes','personal')); // 🔹 Enviar ambos datos a la vista
        }


    /**
     * Crear un nuevo proyecto (Web y API)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cliente' => 'required|exists:clientes,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'presupuesto' => 'nullable|numeric|min:0',
            'estado' => 'required|string|in:activo,inactivo,completado,pendiente',
            'lugar' => 'nullable|string|max:255',
            'responsable' => 'nullable|string|max:255',
        ]);

        $proyecto = Proyecto::create($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Proyecto creado', 'data' => $proyecto], 201)
            : redirect('/proyectos/panel')->with('success', 'Proyecto creado');
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

    /**
     * Editar un proyecto (Web y API)
     */
    public function edit(Proyecto $proyecto, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($proyecto, 200)
            : view('proyectos.edit', compact('proyecto'));
    }

    /**
     * Actualizar un proyecto (Web y API)
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'cliente' => 'sometimes|required|exists:clientes,id',
            'fecha_inicio' => 'sometimes|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'presupuesto' => 'nullable|numeric|min:0',
            'estado' => 'sometimes|string|in:activo,inactivo,completado,pendiente',
            'lugar' => 'nullable|string|max:255',
            'responsable' => 'nullable|string|max:255',
        ]);

        $proyecto->update($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Proyecto actualizado', 'data' => $proyecto], 200)
            : redirect('/proyectos/panel')->with('success', 'Proyecto actualizado');
    }

    /**
     * Eliminar un proyecto (Web y API)
     */
    public function destroy(Proyecto $proyecto, Request $request)
    {
        $proyecto->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Proyecto eliminado'], 204)
            : redirect('/proyectos/panel')->with('success', 'Proyecto eliminado');
    }
}
