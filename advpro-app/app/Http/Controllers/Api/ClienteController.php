<?php

namespace App\Http\Controllers\Api; // Mantener el namespace si es donde reside el controlador

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente; // Asegúrate de que tu modelo Cliente exista

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de todos los clientes.
     */
    public function index(Request $request)
    {
        $clientes = Cliente::paginate(2); // Esto es correcto para la paginación

        // Laravel resource routes esperan que 'index' se mapee a /clientes
        return $request->wantsJson()
            ? response()->json($clientes, 200)
            // Si la vista para el listado de clientes es 'clientes.panel', la usamos aquí.
            // La URL esperada por resource es '/clientes'
            : view('clientes.panel', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     * Muestra el formulario para crear un nuevo cliente.
     */
    public function create()
    {
        // Este método es invocado por la ruta GET /clientes/create
        // y debería devolver la vista con el formulario para crear un nuevo cliente.
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     * Guarda un nuevo cliente en la base de datos.
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
            // Redirección a la ruta 'index' de clientes, que corresponde a '/clientes'
            : redirect()->route('clientes.index')->with('alert', [
                'type' => 'success',
                'title' => '¡Éxito!',
                'message' => 'Cliente creado correctamente',
                'button' => 'Aceptar'
            ]);
    }

    /**
     * Display the specified resource.
     * Muestra un cliente específico.
     */
    public function show(Cliente $cliente, Request $request)
    {
        // Este método es invocado por la ruta GET /clientes/{cliente}
        return $request->wantsJson()
            ? response()->json($cliente, 200)
            : view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     * Muestra el formulario para editar un cliente específico.
     */
    public function edit(Cliente $cliente)
    {
        // Este método es invocado por la ruta GET /clientes/{cliente}/edit
        // y debería devolver la vista con el formulario para editar un cliente existente.
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     * Actualiza un cliente específico.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Se utiliza 'sometimes' para que los campos no sean requeridos si no se envían
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
            // Redirección a la ruta 'index' de clientes.
            : redirect()->route('clientes.index')->with('success', 'Cliente actualizado');
    }

    /**
     * Remove the specified resource from storage.
     * Elimina un cliente específico.
     */
    public function destroy(Cliente $cliente, Request $request)
    {
        $cliente->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Cliente eliminado'], 204)
            // Redirección a la ruta 'index' de clientes.
            : redirect()->route('clientes.index')->with('success', 'Cliente eliminado');
    }
}