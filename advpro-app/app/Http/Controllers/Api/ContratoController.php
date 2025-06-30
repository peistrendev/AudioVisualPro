<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Contrato;
use App\Models\Cliente;
use App\Models\Proyecto;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContratoController extends Controller
{
    public function index(Request $request)
{
    $contratos = Contrato::with(['cliente', 'proyecto', 'responsable'])->paginate(10);
    $clientes = Cliente::all();
    $proyectos = Proyecto::all();
    $staff = Staff::all();

    return $request->wantsJson()
        ? response()->json($contratos, 200)
        : view('contratos.panel', compact('contratos', 'clientes', 'proyectos', 'staff'));
}
    public function create()
    {
        $clientes = Cliente::all();
        $proyectos = Proyecto::all();
        $staff = Staff::all();

        return view('contratos.create', compact('clientes', 'proyectos', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_cliente' => 'required|exists:clientes,id',
            'id_proyecto' => 'required|exists:proyectos,id',
            'id_responsable' => 'required|exists:staff,id',
            'fecha_contrato' => 'required|date',
            'tipo_contrato' => 'required|string|max:100',
            'tiempo_contrato' => 'nullable|string|max:50',
            'estado' => 'required|string|in:activo,inactivo,finalizado,pendiente',
            'observaciones' => 'nullable|string|max:1000',
            'documento' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('documento')) {
            $validated['documento'] = $request->file('documento')->store('documentos');
        }

        $contrato = Contrato::create($validated);

        return $request->wantsJson()
            ? response()->json(['message' => 'Contrato creado', 'data' => $contrato], 201)
            : redirect()->route('contratos.index')->with('success', 'Contrato creado correctamente');
    }

    public function show(Contrato $contrato, Request $request)
    {
        $contrato->load(['cliente', 'proyecto', 'responsable']);

        return $request->wantsJson()
            ? response()->json($contrato, 200)
            : view('contratos.show', compact('contrato'));
    }

    public function edit(Contrato $contrato)
    {
        $clientes = Cliente::all();
        $proyectos = Proyecto::all();
        $staff = Staff::all();

        return view('contratos.edit', compact('contrato', 'clientes', 'proyectos', 'staff'));
    }

    public function update(Request $request, Contrato $contrato)
    {
        $validated = $request->validate([
            'id_cliente' => 'sometimes|required|exists:clientes,id',
            'id_proyecto' => 'sometimes|required|exists:proyectos,id',
            'id_responsable' => 'sometimes|required|exists:staff,id',
            'fecha_contrato' => 'sometimes|date',
            'tipo_contrato' => 'sometimes|string|max:100',
            'tiempo_contrato' => 'nullable|string|max:50',
            'estado' => 'sometimes|string|in:activo,inactivo,finalizado,pendiente',
            'observaciones' => 'nullable|string|max:1000',
            'documento' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('documento')) {
            // Borra el anterior si existe
            if ($contrato->documento) {
                Storage::delete($contrato->documento);
            }
            $validated['documento'] = $request->file('documento')->store('documentos');
        }

        $contrato->update($validated);

        return $request->wantsJson()
            ? response()->json(['message' => 'Contrato actualizado', 'data' => $contrato], 200)
            : redirect()->route('contratos.index')->with('success', 'Contrato actualizado correctamente');
    }

    public function destroy(Contrato $contrato, Request $request)
    {
        if ($contrato->documento) {
            Storage::delete($contrato->documento);
        }

        $contrato->delete();

        return $request->wantsJson()
            ? response()->json(['message' => 'Contrato eliminado'], 204)
            : redirect()->route('contratos.index')->with('success', 'Contrato eliminado correctamente');
    }
}