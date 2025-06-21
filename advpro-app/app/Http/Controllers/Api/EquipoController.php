<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Staff;

class EquipoController extends Controller
{
    /**
     * Muestra una lista de todos los equipos.
     */
    public function index(Request $request)
    {
        $equipos = Equipo::with('personal')->paginate(10);
        $personal = Staff::all(['id', 'nombre']);

        return $request->wantsJson()
            ? response()->json($equipos, 200)
            : view('equipos.panel', compact('equipos', 'personal'));
    }

    /**
     * Muestra el formulario para crear un nuevo equipo.
     */
    public function create()
    {
        $personal = Staff::all(['id', 'nombre']);
        return view('equipos.create', compact('personal'));
    }

    /**
     * Guarda un nuevo equipo en la base de datos.
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
            'responsable' => 'nullable|exists:staff,id',
        ]);

        $equipo = Equipo::create($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Equipo creado', 'data' => $equipo], 201)
            : redirect()->route('equipos.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'message' => 'Equipo creado correctamente',
                'button' => 'Aceptar'
            ]);
    }

    /**
     * Muestra un equipo específico.
     */
    public function show(Equipo $equipo, Request $request)
    {
        $equipo->load('personal');

        return $request->wantsJson()
            ? response()->json($equipo, 200)
            : view('equipos.show', compact('equipo'));
    }

    /**
     * Muestra el formulario para editar un equipo.
     */
    public function edit(Equipo $equipo)
    {
        $equipo->load('personal');
        $personal = Staff::all(['id', 'nombre']);

        return view('equipos.edit', compact('equipo', 'personal'));
    }

    /**
     * Actualiza un equipo específico.
     */
    public function update(Request $request, Equipo $equipo)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'nullable|string',
            'marca' => 'sometimes|string|max:255',
            'tipo_equipo' => 'sometimes|string|max:255',
            'estado' => 'sometimes|string|in:Nuevo,Usado,Reparado',
            'ubicacion' => 'sometimes|string|max:255',
            'responsable' => 'nullable|exists:staff,id',
        ]);

        $equipo->update($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Equipo actualizado', 'data' => $equipo], 200)
            : redirect()->route('equipos.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Actualizado!',
                'message' => 'Equipo actualizado correctamente',
                'button' => 'Aceptar'
            ]);
    }

    /**
     * Elimina un equipo específico.
     */
    public function destroy(Equipo $equipo, Request $request)
    {
        $equipo->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Equipo eliminado'], 204)
            : redirect()->route('equipos.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Eliminado!',
                'message' => 'Equipo eliminado correctamente',
                'button' => 'Aceptar'
            ]);
    }
}