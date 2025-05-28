<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\;


class DashboardController extends Controller
{
    public function index()
    {
        //$inicio= Clientes::paginate(10);
        return view('inicio.dashboard');
    }
   public function store(Request $request){
       
    }
    public function edit($cliente){

    }

    public function update(Request $request, $cliente){

        
        
    
    }

    public function destroy($cliente){
    
    }
}