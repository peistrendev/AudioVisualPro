<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::paginate(7);
        return view('staff.panel', compact('staff'));
    }

    public function store(Request $request)
    {
        $staff = new Staff();
        $staff->nombre = $request->nombre;
        $staff->apellido = $request->apellido;
        $staff->tipo_documento = $request->tipo_documento;
        $staff->documento = $request->documento;
        $staff->email = $request->email;
        $staff->telefono = $request->telefono;
        $staff->direccion = $request->direccion;
        $staff->id_cargo = $request->id_cargo;
        $staff->foto = $request->foto;
        $staff->estado = $request->estado ?? 1;
        $staff->save();

        return redirect('/staff/panel');
    }

    public function edit($staff)
    {
        $staff = Staff::find($staff);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $staff)
    {
        $staff = Staff::find($staff);
        $staff->nombre = $request->nombre;
        $staff->apellido = $request->apellido;
        $staff->tipo_documento = $request->tipo_documento;
        $staff->documento = $request->documento;
        $staff->email = $request->email;
        $staff->telefono = $request->telefono;
        $staff->direccion = $request->direccion;
        $staff->id_cargo = $request->id_cargo;
        $staff->foto = $request->foto;
        $staff->estado = $request->estado ?? 1;
        $staff->save();

        return redirect('/staff/panel');
    }

    public function destroy($staff)
    {
        $staff = Staff::find($staff);
        $staff->delete();

        return redirect('/staff/panel');
    }
}