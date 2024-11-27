<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Habitacion;
class RegistroLimpiezaController extends Controller
{
    /**
     * Obtiene la fecha y hora actual en el formato d/m/Y H:i.
     */
    public function obtenerFechaHoraActual()
    {
        return Carbon::now()->format('d/m/Y H:i'); /**tring Fecha y hora actual.
     */
    }
    /**
     * Muestra la página principal del registro de limpieza.
     * 
     * - Obtiene la fecha y hora actual.
     * - Recupera el usuario autenticado y su rol.
     * - Define variables dependiendo del rol (administrador o empleado).
     * - Recupera habitaciones con estado de limpieza "Sucio".
     */
    public function index()
{
    // Obtener la fecha y hora actual
    $fechaHoraActual = $this->obtenerFechaHoraActual();

    // Obtener el usuario autenticado con sus relaciones necesarias
    $usuarioAutenticado = Usuario::with('empleado')->find(Auth::id());

    // Inicializar las variables de acuerdo al rol
    $admin = null;
    $empleados = [];

    if ($usuarioAutenticado->idrol == 1) {
        // Usuario autenticado es un administrador, definir $admin y obtener empleados
        $admin = $usuarioAutenticado;
        $empleados = Usuario::where('idrol', 3)
            ->with('empleado')
            ->get();
    } elseif ($usuarioAutenticado->idrol == 3) {
        // Usuario autenticado es un empleado
        $empleados = [$usuarioAutenticado];
    }

    // Obtener habitaciones sucias
    $habitacionesSucias = Habitacion::where('estadoLimpieza', 'Sucio')->get();

    // Pasar todas las variables a la vista
    return view('habitaciones.limpieza.index', compact('fechaHoraActual', 'empleados', 'usuarioAutenticado', 'habitacionesSucias'));
}

 /**
     * Valida los datos enviados para el registro de limpieza.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'idhabitacion' => 'required|integer',
            'idempleado' => 'required|integer',
            'estado' => 'required|string|max:20',
        ]);
        /**
     * Muestra el formulario para crear un nuevo registro de limpieza.
     */
    }
    public function create()
    {
        //
    }
 /**
     * Almacena un nuevo registro de limpieza en la base de datos.
     */
    public function store(Request $request)
    {
        //
    }
 /**
     * Muestra los detalles de un registro de limpieza específico.
     */
    public function show(string $id)
    {
        //
    }
/**
     * Muestra el formulario para editar un registro de limpieza.
     */
    public function edit(string $id)
    {
        //
    }
/**
     * Actualiza un registro de limpieza específico en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        //
    }
 /**
     * Elimina un registro de limpieza de la base de datos.
     */
    public function destroy(string $id)
    {
        //
    }
}
