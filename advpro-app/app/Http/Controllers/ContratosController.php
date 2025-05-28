<?php

namespace App\Http\Controllers;
use App\Models\contrato;

use Illuminate\Http\Request;

class ContratosController extends Controller
{
    public function index()
    {
        $contratos = contrato::paginate(10);
        return view('contratos.panel',compact('contratos'));
    }

   
}
