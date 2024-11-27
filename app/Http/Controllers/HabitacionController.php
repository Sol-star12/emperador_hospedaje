<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHabitacionRequest;

class HabitacionController extends Controller
{
    /**
     * Muestra una lista de habitaciones con funcionalidad de búsqueda y ordenación.
     *
     * @param \Illuminate\Http\Request $request Solicitud HTTP entrante.
     * @return \Illuminate\View\View Vista con el listado de habitaciones.
     */
    public function index(Request $request)
    {
        // Capturar criterios de búsqueda y ordenación
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'idHabitacion'); // Ordenar por ID por defecto
        $order = $request->input('order', 'asc'); // Orden ascendente por defecto

        // Consulta de habitaciones con relaciones y filtros
        $habitaciones = Habitacion::with(['detalle', 'tipo_habitacion'])
            ->when($search, function ($query) use ($search) {
                $query->where('estado', 'like', "%$search%")
                    ->orWhere('estadoLimpieza', 'like', "%$search%");
            })
            ->orderBy($sortBy, $order)
            ->paginate(10);

        return view('habitaciones.index', compact('habitaciones', 'search', 'sortBy', 'order'));
    }

    /**
     * Muestra el formulario para crear una nueva habitación.
     *
     * @return \Illuminate\View\View Vista con el formulario de creación.
     */
    public function create()
    {
        return view('habitaciones.create');
    }

    /**
     * Almacena una nueva habitación en la base de datos.
     *
     * @param \App\Http\Requests\StoreHabitacionRequest $request Solicitud validada.
     * @return \Illuminate\Http\RedirectResponse Redirección tras el registro exitoso.
     */
    public function store(StoreHabitacionRequest $request)
    {
        // Crear una nueva habitación con los datos validados
        Habitacion::create($request->validated());

        return redirect()->route('habitaciones.index')->with('success', 'Habitación registrada exitosamente.');
    }

    /**
     * Muestra los detalles de una habitación específica.
     *
     * @param int $idHabitacion ID de la habitación.
     * @return \Illuminate\View\View Vista con los detalles de la habitación.
     */
    public function show($idHabitacion)
    {
        $habitacion = Habitacion::with(['detalle', 'tipo_habitacion', 'alquilers', 'registrolimpiezas'])
            ->findOrFail($idHabitacion);

        return view('habitaciones.show', compact('habitacion'));
    }

    /**
     * Muestra el formulario para editar una habitación existente.
     *
     * @param int $idHabitacion ID de la habitación.
     * @return \Illuminate\View\View Vista con el formulario de edición.
     */
    public function edit($idHabitacion)
    {
        $habitacion = Habitacion::findOrFail($idHabitacion);

        return view('habitaciones.edit', compact('habitacion'));
    }

    /**
     * Actualiza una habitación existente en la base de datos.
     *
     * @param \App\Http\Requests\StoreHabitacionRequest $request Solicitud validada.
     * @param int $idHabitacion ID de la habitación.
     * @return \Illuminate\Http\RedirectResponse Redirección tras la actualización.
     */
    public function update(StoreHabitacionRequest $request, $idHabitacion)
    {
        $habitacion = Habitacion::findOrFail($idHabitacion);

        $habitacion->update($request->validated());

        return redirect()->route('habitaciones.index')->with('success', 'Habitación actualizada exitosamente.');
    }

    /**
     * Elimina una habitación específica de la base de datos.
     *
     * @param int $idHabitacion ID de la habitación.
     * @return \Illuminate\Http\RedirectResponse Redirección tras la eliminación.
     */
    public function destroy($idHabitacion)
    {
        $habitacion = Habitacion::findOrFail($idHabitacion);

        $habitacion->delete();

        return redirect()->route('habitaciones.index')->with('success', 'Habitación eliminada exitosamente.');
    }
}
