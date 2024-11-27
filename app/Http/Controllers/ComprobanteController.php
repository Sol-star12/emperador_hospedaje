<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use Illuminate\Http\Request;
use App\Http\Requests\ComprobanteRequest; // Validación personalizada

class ComprobanteController extends Controller
{
    /**
     * Muestra una lista de los comprobantes.
     * Permite ordenar y buscar.
     */
    public function index(Request $request)
    {
        // Obtener los parámetros de búsqueda y ordenación desde la solicitud
        $search = $request->get('search', '');
        $orderBy = $request->get('orderBy', 'fecha');
        $direction = $request->get('direction', 'desc');

        // Validación de los parámetros de ordenación
        if (!in_array($orderBy, ['fecha', 'monto', 'tipo_comprobante'])) {
            $orderBy = 'fecha'; // Valor por defecto
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc'; // Valor por defecto
        }

        // Consulta con búsqueda y ordenación
        $comprobantes = Comprobante::query()
            ->where('tipo_comprobante', 'like', "%{$search}%")  // Búsqueda por tipo de comprobante
            ->orWhere('monto', 'like', "%{$search}%")          // Búsqueda por monto
            ->orderBy($orderBy, $direction)                    // Ordenar por los parámetros proporcionados
            ->paginate(10);                                    // Paginación

        // Retornar vista con los resultados
        return view('comprobantes.index', compact('comprobantes'));
    }

    /**
     * Muestra el formulario para crear un nuevo comprobante.
     */
    public function create()
    {
        // Se puede agregar la lógica de asignación de habitaciones u otros datos necesarios
        return view('comprobantes.create');
    }

    /**
     * Almacena un nuevo comprobante en la base de datos.
     */
    public function store(ComprobanteRequest $request)
    {
        // Validación ya realizada por el Form Request 'ComprobanteRequest'
        $data = $request->validated(); // Obtener los datos validados

        // Crear el nuevo comprobante
        Comprobante::create($data);

        // Redirigir a la lista de comprobantes con mensaje de éxito
        return redirect()->route('comprobantes.index')->with('success', 'Comprobante creado con éxito.');
    }

    /**
     * Muestra el comprobante especificado.
     */
    public function show(string $id)
    {
        // Buscar el comprobante por ID
        $comprobante = Comprobante::findOrFail($id);
        
        // Retornar la vista con el comprobante
        return view('comprobantes.show', compact('comprobante'));
    }

    /**
     * Muestra el formulario para editar el comprobante especificado.
     */
    public function edit(string $id)
    {
        // Buscar el comprobante por ID
        $comprobante = Comprobante::findOrFail($id);
        
        // Retornar vista de edición con el comprobante
        return view('comprobantes.edit', compact('comprobante'));
    }

    /**
     * Actualiza el comprobante especificado en la base de datos.
     */
    public function update(ComprobanteRequest $request, string $id)
    {
        // Validación ya realizada por el Form Request 'ComprobanteRequest'
        $data = $request->validated(); // Obtener los datos validados

        // Buscar el comprobante por ID y actualizar
        $comprobante = Comprobante::findOrFail($id);
        $comprobante->update($data);

        // Redirigir a la lista de comprobantes con mensaje de éxito
        return redirect()->route('comprobantes.index')->with('success', 'Comprobante actualizado con éxito.');
    }

    /**
     * Elimina el comprobante especificado.
     */
    public function destroy(string $id)
    {
        // Buscar el comprobante por ID
        $comprobante = Comprobante::findOrFail($id);
        
        // Eliminar el comprobante
        $comprobante->delete();

        // Redirigir a la lista de comprobantes con mensaje de éxito
        return redirect()->route('comprobantes.index')->with('success', 'Comprobante eliminado con éxito.');
    }
}
