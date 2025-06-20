<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff; // Asegúrate de que esta línea use 'Staff' con 'S' mayúscula

class PersonalController extends Controller
{
    /**
     * Mostrar todos los miembros del personal (Web y API)
     */
    public function index(Request $request)
    {
        $staff = Staff::paginate(10); // Asegúrate de usar 'Staff' con 'S' mayúscula aquí

        return $request->wantsJson()
            ? response()->json($staff, 200)
            : view('personal.panel', compact('staff'));
    }

    /**
     * Mostrar el formulario para crear un nuevo miembro del personal (Web)
     * Este método se usaría si tuvieras una vista 'personal.create', pero como usas modal,
     * la lógica de datos ya se pasa al panel.
     */
    public function create()
    {
        // No se requiere lógica compleja aquí ya que el formulario es un modal en el panel
        return view('personal.create'); // Si tienes una vista específica para crear, si no, puedes eliminar este método si solo usas el modal en el panel.
    }

    /**
     * Guarda un nuevo miembro del personal en la base de datos (Web y API)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_documento' => 'required|string|max:50',
            'documento' => 'required|string|unique:staff,documento|max:20', // Cambiado 'clientes' a 'staff'
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:500',
            'estado' => 'required|string|in:Activo,Inactivo', // 'Desactivo' cambiado a 'Inactivo' para consistencia o si quieres 2 estados
            'cargo' => 'required|string',
        ]);

        $staff = Staff::create($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Personal creado', 'data' => $staff], 201)
            : redirect()->route('personal.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'message' => 'Personal creado correctamente',
                'button' => 'Aceptar'
            ]);
    }

    /**
     * Muestra un miembro del personal específico (Web y API)
     */
    public function show(Staff $personal, Request $request) // Cambiado $staff a $personal para coincidir con la variable de ruta
    {
        return $request->wantsJson()
            ? response()->json($personal, 200)
            : view('personal.show', compact('personal'));
    }

    /**
     * Muestra el formulario para editar un miembro del personal (Web)
     */
    public function edit(Staff $personal) // Cambiado $staff a $personal
    {
        return view('personal.edit', compact('personal')); // Pasa la variable $personal a la vista
    }

    /**
     * Actualiza un miembro del personal específico (Web y API)
     */
    public function update(Request $request, Staff $personal) // Cambiado $staff a $personal
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'tipo_documento' => 'sometimes|string|max:50',
            'documento' => 'sometimes|string|unique:staff,documento,' . $personal->id . '|max:20', // Cambiado 'clientes' a 'staff'
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:500',
            'estado' => 'sometimes|string|in:Activo,Inactivo', // 'Desactivo' cambiado a 'Inactivo'
            'cargo' => 'sometimes|string',
        ]);

        $personal->update($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Personal actualizado', 'data' => $personal], 200)
            : redirect()->route('personal.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Actualizado!',
                'message' => 'Personal actualizado correctamente',
                'button' => 'Aceptar'
            ]);
    }

    /**
     * Cambia el estado de un miembro del personal (Eliminación lógica / Activación/Desactivación) (Web y API)
     */
    public function destroy(Staff $personal, Request $request) // Cambiado $staff a $personal
    {
        // Alternar el estado entre Activo y Inactivo
        $newState = ($personal->estado == 'Activo') ? 'Inactivo' : 'Activo';
        $personal->update(['estado' => $newState]);

        $message = ($newState == 'Activo') ? 'Personal activado' : 'Personal desactivado';

        return $request->wantsJson()
            ? response()->json(['message' => $message], 200) // Cambiado 204 a 200 porque 204 es No Content y no debería llevar body
            : redirect()->route('personal.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Estado cambiado!',
                'message' => $message,
                'button' => 'Aceptar'
            ]);
    }
}