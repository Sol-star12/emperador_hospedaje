<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComprobanteRequest; // Request para validaciones

class ComprobanteController extends Controller
{
    /**
     * Muestra una lista de comprobantes con búsqueda y ordenación.
     * 
     * @param \Illuminate\Http\Request $request Datos de la solicitud HTTP.
     * @return \Illuminate\View\View Vista con la lista de comprobantes.
     */
    public function index(Request $request)
    {
        // Capturar criterios de búsqueda y ordenación
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'fecha'); // Ordenar por fecha por defecto
        $order = $request->input('order', 'desc'); // Orden descendente por defecto

        // Consulta base con búsqueda
        $comprobantes = Comprobante::with(['tipo_pago', 'empleado'])
            ->when($search, function ($query) use ($search) {
                $query->where('tipoComprobante', 'like', "%$search%")
                    ->orWhereHas('empleado', function ($subQuery) use ($search) {
                        $subQuery->where('nombre', 'like', "%$search%");
                    });
            })
            ->orderBy($sortBy, $order)
            ->paginate(10);

        return view('comprobantes.index', compact('comprobantes', 'search', 'sortBy', 'order'));
    }

    /**
     * Muestra el formulario para crear un nuevo comprobante.
     * 
     * @return \Illuminate\View\View Vista con el formulario de creación.
     */
    public function create()
    {
        return view('comprobantes.create');
    }

    /**
     * Almacena un nuevo comprobante en la base de datos.
     * 
     * @param \App\Http\Requests\StoreComprobanteRequest $request Solicitud validada.
     * @return \Illuminate\Http\RedirectResponse Redirección tras el registro.
     */
    public function store(StoreComprobanteRequest $request)
    {
        // Crear el comprobante con los datos validados
        Comprobante::create($request->validated());

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante registrado exitosamente.');
    }

    /**
     * Muestra los detalles de un comprobante específico.
     * 
     * @param int $idFactura ID del comprobante.
     * @return \Illuminate\View\View Vista con los detalles del comprobante.
     */
    public function show($idFactura)
    {
        $comprobante = Comprobante::with(['tipo_pago', 'empleado'])->findOrFail($idFactura);

        return view('comprobantes.show', compact('comprobante'));
    }

    /**
     * Muestra el formulario para editar un comprobante existente.
     * 
     * @param int $idFactura ID del comprobante.
     * @return \Illuminate\View\View Vista con el formulario de edición.
     */
    public function edit($idFactura)
    {
        $comprobante = Comprobante::findOrFail($idFactura);

        return view('comprobantes.edit', compact('comprobante'));
    }

    /**
     * Actualiza un comprobante existente en la base de datos.
     * 
     * @param \App\Http\Requests\StoreComprobanteRequest $request Solicitud validada.
     * @param int $idFactura ID del comprobante.
     * @return \Illuminate\Http\RedirectResponse Redirección tras la actualización.
     */
    public function update(StoreComprobanteRequest $request, $idFactura)
    {
        $comprobante = Comprobante::findOrFail($idFactura);

        $comprobante->update($request->validated());

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante actualizado exitosamente.');
    }

    /**
     * Elimina un comprobante específico de la base de datos.
     * 
     * @param int $idFactura ID del comprobante.
     * @return \Illuminate\Http\RedirectResponse Redirección tras la eliminación.
     */
    public function destroy($idFactura)
    {
        $comprobante = Comprobante::findOrFail($idFactura);

        $comprobante->delete();

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante eliminado exitosamente.');
    }
}
