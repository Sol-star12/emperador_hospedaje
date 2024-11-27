<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComprobanteRequest;
use App\Models\Comprobante;
use Illuminate\Http\Request;

class ComprobanteController extends Controller
{
    /**
     * Muestra una lista de comprobantes con soporte para búsqueda y ordenación.
     */
    public function index(Request $request)
    {
        $query = Comprobante::query();

        // Filtrar por términos de búsqueda
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('numero', 'like', "%$search%")
                  ->orWhere('descripcion', 'like', "%$search%");
        }

        // Ordenar resultados por un campo y dirección
        $sortBy = $request->input('sort_by', 'id'); // Campo por defecto: 'id'
        $sortOrder = $request->input('sort_order', 'asc'); // Dirección por defecto: 'asc'

        $comprobantes = $query->orderBy($sortBy, $sortOrder)->paginate(10);

        return view('comprobantes.index', compact('comprobantes'));
    }

    /**
     * Muestra el formulario para crear un nuevo comprobante.
     */
    public function create()
    {
        return view('comprobantes.create');
    }

    /**
     * Almacena un nuevo comprobante en la base de datos.
     */
    public function store(ComprobanteRequest $request)
    {
        Comprobante::create($request->validated());

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante creado exitosamente.');
    }

    /**
     * Muestra un comprobante específico.
     */
    public function show(Comprobante $comprobante)
    {
        return view('comprobantes.show', compact('comprobante'));
    }

    /**
     * Muestra el formulario para editar un comprobante existente.
     */
    public function edit(Comprobante $comprobante)
    {
        return view('comprobantes.edit', compact('comprobante'));
    }

    /**
     * Actualiza un comprobante existente en la base de datos.
     */
    public function update(ComprobanteRequest $request, Comprobante $comprobante)
    {
        $comprobante->update($request->validated());

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante actualizado exitosamente.');
    }

    /**
     * Elimina un comprobante de la base de datos.
     */
    public function destroy(Comprobante $comprobante)
    {
        $comprobante->delete();

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante eliminado exitosamente.');
    }
}
