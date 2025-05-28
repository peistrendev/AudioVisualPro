<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::paginate(7);
        return view('proyectos.panel', compact('proyectos'));
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
        return view('proyectos.edit', compact('proyecto'));
    }

/*
    public function edit($proyecto)
{
    dd(Proyecto::find($proyecto)); // Esto mostrará si Laravel encuentra el registro
}
*/
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
