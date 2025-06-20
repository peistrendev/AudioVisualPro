<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\cargo;
use Illuminate\Http\Request;
use App\Models\Staff;
class PersonalController extends Controller
{
    /**
     * Mostrar todos los clientes (Web y API)
     */
    public function index(Request $request)
    {

        $staff = staff::paginate(10);

        return $request->wantsJson()
            ? response()->json($staff, 200)
            : view('personal.panel', compact('staff'));

    }

    /**
     * Crear un nuevo cliente (Web y API)
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_documento' => 'required|string|max:50',
            'documento' => 'required|string|unique:clientes,documento|max:20',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:500',
            'estado' => 'string|in:Activo,Desactivo',
            'cargo' => 'required|string'

        ]);

        $staff = Staff::create($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Personal creado', 'data' => $staff], 201)
            : redirect('/personal/panel')->with('alert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'message' => 'Personal creado con ¡Éxito!',
                'button' => 'Aceptar'
            ]);
}

    /**
     * Mostrar un cliente específico (Web y API)
     */
    public function show(Staff $staff, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($staff, 200)
            : view('personal.show', compact('staff'));
    }

    /**
     * Editar cliente (Web y API)
     */
    public function edit(Staff $staff, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($staff, 200)
            : view('personal.edit', compact('staff'));
    }

    /**
     * Actualizar cliente (Web y API)
     */
    public function update(Request $request, Staff $staff)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo_documento' => 'sometimes|string|max:50',
            'documento' => 'sometimes|string|unique:clientes,documento,' . $staff->id . '|max:20',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:500',
            'estado' => 'string|in:Activo,Desactivo',
            'cargo' => 'required|string'
        ]);

        $staff->update($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Personal actualizado', 'data' => $staff], 200)
            : redirect('/personal/panel')->with('success', 'Personal actualizado');
    }

    /**
     * Eliminar cliente (Web y API)
     */
    public function destroy(Staff $staff, Request $request)
    {
        $message = ($staff->estado == 'Activo') ? 'Desactivo' : 'Activo';
        $staff->update(['estado' => $message]);

        $message = ($staff->estado == 'Activo') ? 'Personal activado' : 'Personal desactivado';

        return $request->wantsJson()
            ? response()->json(['message' => $message], 200)
            : back()->with('success', $message); // Redirige a la página anterior
    }
}
