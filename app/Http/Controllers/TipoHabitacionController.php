<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoHabitacion;
use Attribute;

class TipoHabitacionController extends Controller
{
    public function index()
    {
        $tiposHabitacion = TipoHabitacion::all();
        return view('habitaciones.tipohabitacion.index', data:compact('tiposHabitacion'));
    }
    public function create()
    {
        return view('habitaciones.tipohabitacion.create');
    }
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate(rules: [
            'tipoHabitacion' => 'required|string|max:30',
        ]);

        // Crear un nuevo tipo de habitación
        $tipoHabitacion = TipoHabitacion::create(attributes:
        [
            'idTipoHabitacion' => $request->idTipoHabitacion,
            'tipoHabitacion' => $request->tipoHabitacion,
        ]);

        return redirect()->route('habitaciones.tipohabitacion.create')->with('success', 'Empleado creado exitosamente');
    }
    public function show(string $id)
    {
        //
    }

    public function edit(TipoHabitacion $tipoHabitacion)
    {
        return view('habitaciones.tipohabitacion.edit', compact('tipoHabitacion'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}