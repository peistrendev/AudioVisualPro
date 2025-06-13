<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Mostrar todos los clientes (Web y API)
     */
    public function index(Request $request)
    {
        $clientes = Cliente::paginate(10);

        return $request->wantsJson()
            ? response()->json($clientes, 200)
            : view('clientes.panel', compact('clientes'));
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
        ]);

        $cliente = Cliente::create($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Cliente creado', 'data' => $cliente], 201)
            : redirect('/clientes/panel')->with('alert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'message' => 'Cliente creado correctamente',
                'button' => 'Aceptar'
            ]);
}

    /**
     * Mostrar un cliente específico (Web y API)
     */
    public function show(Cliente $cliente, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($cliente, 200)
            : view('clientes.show', compact('cliente'));
    }

    /**
     * Editar cliente (Web y API)
     */
    public function edit(Cliente $cliente, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($cliente, 200)
            : view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar cliente (Web y API)
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'tipo_documento' => 'sometimes|string|max:50',
            'documento' => 'sometimes|string|unique:clientes,documento,' . $cliente->id . '|max:20',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:500',
        ]);

        $cliente->update($validatedData);

        return $request->wantsJson()
            ? response()->json(['message' => 'Cliente actualizado', 'data' => $cliente], 200)
            : redirect('/clientes/panel')->with('success', 'Cliente actualizado');
    }

    /**
     * Eliminar cliente (Web y API)
     */
    public function destroy(Cliente $cliente, Request $request)
    {
        $cliente->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Cliente eliminado'], 204)
            : redirect('/clientes/panel')->with('success', 'Cliente eliminado');
    }
}
