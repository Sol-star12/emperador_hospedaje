<?php

namespace App\Http\Controllers;
use App\Models\InsumosLimpieza;
use App\Models\Categorium;
use Illuminate\Http\Request;

class InsumosLimpiezaController extends Controller
{
    public function index(Request $request)
    {
        $categoria_id = $request->input('categoria_id');
        $insumos = InsumosLimpieza::when($categoria_id, function ($query, $categoria_id) {
            return $query->where('idcategoria', $categoria_id);
        })->paginate(10);
        $categorias = Categorium::all();
        return view('habitaciones.limpieza.insumos_limpieza', compact('insumos', 'categorias'));
    }
    public function create()
    {
        $categorias = Categorium::all();
        return view('habitaciones.limpieza.agregarInsumos', compact( 'categorias'));
    }
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'categoria_id' => 'required|integer|exists:categoria,idCategoria',
            'nombre' => ['required', 'string', 'max:50', 'regex:/^[\p{L}\s]+$/u'],
            'descripcion' => ['required', 'string', 'max:255'],
            'stock' => 'required|integer|min:1',
            'unidadMedida' => 'required|string|in:Kilogramos,Litros,Unidades,Paquete',
            'stockMinimo' => 'required|integer|min:1',
        ], [
            'categoria_id.required' => 'La categoría es obligatoria.',
            'nombre.required' => 'El nombre del insumo de limpieza es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'stock.required' => 'El stock es obligatorio.',
            'stock.integer' => 'El stock debe ser un número entero.',
            'unidadMedida.required' => 'La unidad de medida es obligatoria.',
            'stockMinimo.required' => 'El stock mínimo es obligatorio.',
        ]);

        // Guardar los datos en la base de datos
        InsumosLimpieza::create([
            'idcategoria' => $request->input('categoria_id'),
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'stock' => $request->input('stock'),
            'unidadMedida' => $request->input('unidadMedida'),
            'stockMinimo' => $request->input('stockMinimo'),
        ]);

        // Redireccionar o retornar una respuesta
        return redirect()->route('habitaciones.limpieza.agregarInsumos')
            ->with('mensaje', 'Insumo de limpieza creado exitosamente.')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
