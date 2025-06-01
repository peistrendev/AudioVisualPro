<?php

namespace App\Http\Controllers;
use App\Models\contrato;
use App\Models\Clientes;

use Illuminate\Http\Request;

class ContratosController extends Controller
{
    public function index()
    {
        $contratos = contrato::paginate(10);
        $clientes = Clientes::all();
        return view('contratos.panel',compact('contratos', 'clientes'));
    }

    public function store(Request $request){
        $clientes = new Clientes();
        $clientes->nombre = $request->nombre;
        $clientes->tipo_documento = $request->tipo_documento;
        $clientes->documento = $request->documento;
        $clientes->email = $request->email;
        $clientes->telefono = $request->telefono;
        $clientes->direccion = $request->direccion;
        $clientes->save();
        return redirect('/clientes/panel');
    }
    public function edit($cliente){

        $cliente = Clientes::find($cliente);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $cliente){

        
            $clientes = Clientes::find($cliente);
            $clientes->nombre = $request->nombre;
            $clientes->tipo_documento = $request->tipo_documento;
            $clientes->documento = $request->documento;
            $clientes->email = $request->email;
            $clientes->telefono = $request->telefono;
            $clientes->direccion = $request->direccion;
            $clientes->save();
            return redirect('/clientes/panel');
    
    }

    public function destroy($cliente){
        $clientes = Clientes::find($cliente);
        $clientes->delete();
        return redirect('/clientes/panel');
    }

   
}
