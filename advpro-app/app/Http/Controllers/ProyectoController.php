<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Clientes;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::paginate(7);
        $clientes = Clientes::all();
        return view('proyectos.panel', compact('proyectos','clientes'));
    }

    public function store(Request $request)
    {
        $proyecto = new Proyecto();
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->cliente = $request->cliente;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->presupuesto = $request->presupuesto;
        $proyecto->estado = $request->estado;
        $proyecto->lugar = $request->lugar;
        $proyecto->responsable = $request->responsable;
        $proyecto->save();

        return redirect('/proyectos/panel');
    }

    public function edit($proyecto)
    {
        $proyecto = Proyecto::find($proyecto);
        $clientes = Clientes::all();
        return view('proyectos.edit', compact('proyecto','clientes'));
    }

    public function update(Request $request, $proyecto)
    {
        $proyecto = Proyecto::find($proyecto);
        $proyecto->nombre = $request->nombre;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->cliente = $request->cliente;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->presupuesto = $request->presupuesto;
        $proyecto->estado = $request->estado;
        $proyecto->lugar = $request->lugar;
        $proyecto->responsable = $request->responsable;
        $proyecto->save();

        return redirect('/proyectos/panel');
    }

    
    public function destroy($proyecto)
    {
        $proyecto = Proyecto::find($proyecto);
        $proyecto->delete();
        return redirect('/proyectos/panel');
    }
        
/*
    public function destroy($proyecto)
{
    dd(Proyecto::find($proyecto)); // Así verificamos si el modelo carga correctamente
}
*/

}
