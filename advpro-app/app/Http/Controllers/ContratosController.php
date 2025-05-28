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

   
}
