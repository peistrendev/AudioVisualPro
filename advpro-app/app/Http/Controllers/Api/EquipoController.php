<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
    /**
     * Mostrar todos los equipos (Web y API)
     */
    public function index(Request $request)
    {
        $equipos = Equipo::paginate(10);

        return $request->wantsJson()
            ? response()->json($equipos, 200)
            : view('equipos.panel', compact('equipos'));
    }

    /**
     * Crear un nuevo equipo (Web y API)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'marca' => 'required|string|max:255',
            'tipo_equipo' => 'required|string|max:255',
            'estado' => 'required|string|in:Nuevo,Usado,Reparado',
            'ubicacion' => 'required|string|max:255',
            'responsable' => 'required|string|max:255',
        ]);

        $equipo = Equipo::create($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Equipo creado', 'data' => $equipo], 201)
            : redirect('/equipos/panel')->with('success', 'Equipo creado');
    }

    /**
     * Mostrar un equipo específico (Web y API)
     */
    public function show(Equipo $equipo, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($equipo, 200)
            : view('equipos.show', compact('equipo'));
    }

    /**
     * Editar equipo (Web y API)
     */
    public function edit(Equipo $equipo, Request $request)
{
    return $request->wantsJson()
        ? response()->json($equipo, 200)
        : view('equipos.edit', compact('equipo'));
}

    /**
     * Actualizar equipo (Web y API)
     */
    public function update(Request $request, Equipo $equipo)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'marca' => 'sometimes|string|max:255',
            'tipo_equipo' => 'sometimes|string|max:255',
            'estado' => 'sometimes|string|in:Nuevo,Usado,Reparado',
            'ubicacion' => 'sometimes|string|max:255',
            'responsable' => 'sometimes|string|max:255',
        ]);

        $equipo->update($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Equipo actualizado', 'data' => $equipo], 200)
            : redirect('/equipos/panel')->with('success', 'Equipo actualizado');
    }

    /**
     * Eliminar equipo (Web y API)
     */
    public function destroy(Equipo $equipo, Request $request)
    {
        $equipo->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Equipo eliminado'], 204)
            : redirect('/equipos/panel')->with('success', 'Equipo eliminado');
    }
}