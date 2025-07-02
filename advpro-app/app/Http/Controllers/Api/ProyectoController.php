<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Cliente;
use App\Models\Staff;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener esto importado
use Carbon\Carbon; // Asegúrate de tener esto importado para manejar fechas

class ProyectoController extends Controller
{
    /**
     * Muestra una lista de proyectos, con opciones de filtrado y paginación.
     * También carga clientes y personal para los selectores de filtro.
     */
    public function index(Request $request)
    {
        // Obtener todos los clientes y personal para los selectores de los formularios (crear y filtrar)
        $clientes = Cliente::all();
        $personal = Staff::all();

        // Iniciar la consulta Eloquent con las relaciones necesarias
        $query = Proyecto::with(['cliente', 'responsable']);

        // Aplicar filtros basados en los parámetros de la solicitud (GET)
        
        // Filtro por Cliente (por ID o por documento, usando el ID para la consulta)
        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->input('cliente_id'));
        } elseif ($request->filled('cliente_documento')) { // Si se busca por documento
            $cliente = Cliente::where('documento', $request->input('cliente_documento'))->first();
            if ($cliente) {
                $query->where('cliente_id', $cliente->id);
            } else {
                // Si el cliente no existe, asegurar que no se devuelvan proyectos
                $query->whereNull('cliente_id'); 
            }
        }
        
        // Filtro por Responsable (por ID del select)
        if ($request->filled('responsable_id')) {
            $query->where('responsable_id', $request->input('responsable_id'));
        }
        
        // Filtro por Estado del proyecto
        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }
        
        // Filtro por Fecha de Inicio (usando un solo campo como "desde")
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_inicio', '>=', $request->input('fecha_inicio'));
        }
        
        // Filtro por Fecha de Fin (usando un solo campo como "hasta")
        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_fin', '<=', $request->input('fecha_fin'));
        }

        // Filtro por rango de Presupuesto
        if ($request->filled('presupuesto_min')) {
            $query->where('presupuesto', '>=', $request->input('presupuesto_min'));
        }
        if ($request->filled('presupuesto_max')) {
            $query->where('presupuesto', '<=', $request->input('presupuesto_max'));
        }
        
        // Obtener los proyectos filtrados y paginados, manteniendo los parámetros de consulta en la paginación
        $proyectos = $query->paginate(7)->withQueryString();

        // Guardar los valores de los filtros actuales para que el formulario los recuerde
        $filter_values = $request->query();

        // Devolver la respuesta en JSON si es una petición API, o la vista si es web
        return $request->wantsJson()
            ? response()->json(['proyectos' => $proyectos, 'clientes' => $clientes, 'personal' => $personal], 200)
            : view('proyectos.panel', compact('proyectos', 'clientes', 'personal', 'filter_values'));
    }

    /**
     * Almacena un nuevo proyecto en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'cliente_id' => 'required|exists:clientes,id', 
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
     * Muestra los detalles de un proyecto específico.
     */
    public function show(Proyecto $proyecto, Request $request)
    {
        return $request->wantsJson()
            ? response()->json($proyecto, 200)
            : view('proyectos.show', compact('proyecto'));
    }

    /**
     * Muestra el formulario para editar un proyecto existente.
     */
    public function edit(Proyecto $proyecto, Request $request)
    {
        $clientes = Cliente::all();
        $personal = Staff::all();

        return $request->wantsJson()
            ? response()->json($proyecto, 200)
            : view('proyectos.edit', compact('proyecto', 'clientes', 'personal'));
    }

    /**
     * Actualiza un proyecto existente en la base de datos.
     */
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
     * Elimina un proyecto de la base de datos.
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

    /**
     * Exporta los proyectos filtrados a un archivo PDF usando Dompdf.
     */
    public function exportarPdf(Request $request)
    {
        // Reutilizar la lógica de filtrado del método index para obtener los datos
        $query = Proyecto::with(['cliente', 'responsable']);

        // Filtro por Cliente (por ID o por documento, usando el ID para la consulta)
        if ($request->filled('cliente_id')) {
            $query->where('cliente_id', $request->input('cliente_id'));
        } elseif ($request->filled('cliente_documento')) { // Si se busca por documento
            $cliente = Cliente::where('documento', $request->input('cliente_documento'))->first();
            if ($cliente) {
                $query->where('cliente_id', $cliente->id);
            } else {
                // Si el cliente no existe, asegurar que no se devuelvan proyectos
                $query->whereNull('cliente_id'); 
            }
        }
        
        // Filtro por Responsable (por ID del select)
        if ($request->filled('responsable_id')) {
            $query->where('responsable_id', $request->input('responsable_id'));
        }
        
        // Filtro por Estado del proyecto
        if ($request->filled('estado')) {
            $query->where('estado', $request->input('estado'));
        }
        
        // Filtro por Fecha de Inicio (usando un solo campo como "desde")
        if ($request->filled('fecha_inicio')) {
            $query->whereDate('fecha_inicio', '>=', $request->input('fecha_inicio'));
        }
        
        // Filtro por Fecha de Fin (usando un solo campo como "hasta")
        if ($request->filled('fecha_fin')) {
            $query->whereDate('fecha_fin', '<=', $request->input('fecha_fin'));
        }

        // Filtro por rango de Presupuesto
        if ($request->filled('presupuesto_min')) {
            $query->where('presupuesto', '>=', $request->input('presupuesto_min'));
        }
        if ($request->filled('presupuesto_max')) {
            $query->where('presupuesto', '<=', $request->input('presupuesto_max'));
        }

        // Obtener todos los proyectos que cumplen con los filtros (sin paginar para el PDF)
        $proyectos = $query->get();

        // Cargar la vista específica para el PDF con los datos filtrados
        $pdf = Pdf::loadView('proyectos.pdf', compact('proyectos'));

        // Retornar el PDF para su descarga
        return $pdf->stream('reporte_proyectos_filtrados.pdf');
    }
}
