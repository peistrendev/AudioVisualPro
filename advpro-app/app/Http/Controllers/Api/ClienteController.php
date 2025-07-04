<?php

namespace App\Http\Controllers\Api; // Mantener el namespace si es donde reside el controlador
use Barryvdh\DomPDF\Facade\Pdf;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente; 

class ClienteController extends Controller
{
    // Aplica los filtros de la solicitud a la consulta de clientes.
    protected function applyClientFilters(Request $request, $query)
    {
        // Filtro por tipo de documento
        if ($request->filled('tipo_documento_filtro') && in_array($request->tipo_documento_filtro, ['V', 'J', 'E', 'G'])) {
            $query->where('tipo_documento', $request->tipo_documento_filtro);
        }

        // Filtro de búsqueda por nombre o documento
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', '%' . $search . '%')
                  ->orWhere('documento', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }

    // Muestra una lista de todos los clientes con opciones de filtrado y paginación.
    public function index(Request $request)
    {
        $query = Cliente::query();

        // Aplicar filtros usando el método auxiliar
        $query = $this->applyClientFilters($request, $query);

        $clientes = $query->paginate(10)->appends($request->query());

        return $request->wantsJson()
            ? response()->json($clientes, 200)
            : view('clientes.panel', compact('clientes'));
    }

    // Genera un reporte PDF de los clientes filtrados.
    public function generarReporte(Request $request)
    {
        $query = Cliente::query();

        // Aplicar filtros usando el método auxiliar
        $query = $this->applyClientFilters($request, $query);
        
        $clientes_para_reporte = $query->get();

        $pdf = Pdf::loadView('clientes.reporte_pdf', compact('clientes_para_reporte'));
        
        return $pdf->download('reporte_clientes_' . date('Y-m-d') . '.pdf');
    }

    // Muestra el formulario para crear un nuevo cliente.
    public function create()
    {
        return view('clientes.create');
    }

    // Guarda un nuevo cliente en la base de datos.
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

    // Muestra los detalles de un cliente específico.
    public function show(Cliente $cliente, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($cliente, 200)
            : view('clientes.show', compact('cliente'));
    }

    // Muestra el formulario para editar un cliente existente.
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    // Actualiza un cliente existente en la base de datos.
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

    // Elimina un cliente de la base de datos.
    public function destroy(Cliente $cliente, Request $request)
    {
        $cliente->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Cliente eliminado'], 204)
            // Redirección a la ruta 'index' de clientes.
            : redirect()->route('clientes.index')->with('success', 'Cliente eliminado');
    }
}