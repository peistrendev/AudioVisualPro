<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Staff;
use Barryvdh\DomPDF\Facade\Pdf; // Importamos la fachada de DOMPDF

class EquipoController extends Controller
{
    /**
     * Muestra una lista de todos los equipos y maneja el filtrado.
     */
    public function index(Request $request)
    {
        // 1. Iniciar la consulta
        $query = Equipo::with('personal');

        // 2. Aplicar filtros si existen en la request
        // Filtrar por estado
        if ($request->filled('estado') && in_array($request->estado, ['Nuevo', 'Usado', 'Reparado'])) {
            $query->where('estado', $request->estado);
        }
        
        // Filtrar por tipo de equipo
        if ($request->filled('tipo_equipo')) {
            $query->where('tipo_equipo', $request->tipo_equipo);
        }

        // --- NUEVO FILTRO POR RESPONSABLE ---
        if ($request->filled('responsable')) {
            $query->where('responsable', $request->responsable); // Asumiendo que la FK se llama 'responsable' en la tabla 'equipos'
        }
        // -------------------------------------

        // Filtrar por fecha (creación)
        if ($request->filled('fecha_creacion')) {
            if ($request->fecha_creacion === 'nuevos') {
                $query->orderBy('created_at', 'desc'); // Ordenar por los más nuevos
            } elseif ($request->fecha_creacion === 'viejos') {
                $query->orderBy('created_at', 'asc'); // Ordenar por los más viejos
            }
        }

        // 3. Ejecutar la consulta y paginar los resultados
        $equipos = $query->paginate(10)->appends($request->query());
        
        // Obtener la lista de personal para el filtro (ya la pasabas)
        $personal = Staff::all(['id', 'nombre']);

        return $request->wantsJson()
            ? response()->json($equipos, 200)
            : view('equipos.panel', compact('equipos', 'personal'));
    }

    /**
     * Genera un reporte PDF de los equipos filtrados.
     */
    public function generarReporte(Request $request)
    {
        // La lógica de filtrado es la misma que en el método index
        $query = Equipo::with('personal');

        if ($request->filled('estado') && in_array($request->estado, ['Nuevo', 'Usado', 'Reparado'])) {
            $query->where('estado', $request->estado);
        }
        
        if ($request->filled('tipo_equipo')) {
            $query->where('tipo_equipo', $request->tipo_equipo);
        }

        // --- NUEVO FILTRO POR RESPONSABLE PARA EL REPORTE ---
        if ($request->filled('responsable')) {
            $query->where('responsable', $request->responsable); // Asumiendo que la FK se llama 'responsable'
        }
        // ----------------------------------------------------

        if ($request->filled('fecha_creacion')) {
            if ($request->fecha_creacion === 'nuevos') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->fecha_creacion === 'viejos') {
                $query->orderBy('created_at', 'asc');
            }
        }

        // Obtener todos los equipos que cumplen con los filtros (sin paginación)
        $equipos_para_reporte = $query->get();

        // Cargar la vista Blade que servirá como plantilla para el PDF
        $pdf = Pdf::loadView('equipos.reporte_pdf', compact('equipos_para_reporte'));
        
        // Descargar el PDF directamente.
        return $pdf->download('reporte_equipos_' . date('Y-m-d') . '.pdf');
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
            'valor' => 'required|numeric|min:0', // Aseguramos que el valor sea un número positivo
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
            'valor' => 'sometimes|numeric|min:0', // Aseguramos que el valor sea un número positivo
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