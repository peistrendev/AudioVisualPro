<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Staff; // Asegúrate de importar el modelo Staff

class EquipoController extends Controller
{
    /**
     * Mostrar todos los equipos (Web y API)
     */
    public function index(Request $request)
    {
        // Carga la relación 'personal' (staff) si necesitas mostrar el nombre del responsable
        $equipos = Equipo::with('personal')->paginate(10);

        // Obtener la lista de personal para el dropdown en la vista (si hay un formulario de creación/edición en esta vista)
        $personal = Staff::all(['id', 'nombre']); // <-- AGREGADO: Obtén los datos del Staff aquí

        return $request->wantsJson()
            ? response()->json($equipos, 200)
            // <-- MODIFICADO: Ahora pasamos $personal a la vista
            : view('equipos.panel', compact('equipos', 'personal'));
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
            'responsable' => 'nullable|exists:staff,id',
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
        // Carga la relación 'personal' (staff) si necesitas mostrar el nombre del responsable
        $equipo->load('personal');
        return $request->wantsJson()
            ? response()->json($equipo, 200)
            : view('equipos.show', compact('equipo'));
    }

    /**
     * Editar equipo (Web y API)
     */
    public function edit(Equipo $equipo, Request $request)
    {
        
        $equipo->load('personal');

       
        $personal = Staff::all(['id', 'nombre']);

        return $request->wantsJson()
            ? response()->json($equipo, 200)
            
            : view('equipos.edit', compact('equipo', 'personal'));
    }

    /**
     * Actualizar equipo (Web y API)
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