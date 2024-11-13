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
    public function obtenerFechaHoraActual()
    {
        return Carbon::now()->format('d/m/Y H:i');
    }
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


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'idhabitacion' => 'required|integer',
            'idempleado' => 'required|integer',
            'estado' => 'required|string|max:20',
        ]);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
