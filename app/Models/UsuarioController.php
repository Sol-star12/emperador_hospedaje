<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Models\Empleado;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        //
    }
    public function indexAdmin()
    {
        return view('admin.index');
    }
    public function conteoEmpleados()
    {
        $userCount = Usuario::where('idrol', '!=', 1)->count();
        return view('admin.index', compact('userCount'));
    }
    public function indexEmpleados()
    {
        $usuarios = Usuario::where('idrol', '!=', 1)->with('empleado')->get();

        // Crear instancia de EmpleadoController
        $empleadoController = new EmpleadoController();

        // Añadir la edad a cada usuario
        foreach ($usuarios as $usuario) {
            $usuario->edad = $empleadoController->calcularEdad(optional($usuario->empleado)->fNacimiento);
        }

        return view('admin.empleados', ['usuario' => $usuarios]);    
    }

    
    public function create()
    {
        return view('admin.createEmpleados');
    }

    public function store(Request $request)
    {
        $datoss = request()->all();
        return response()->json($datoss);
    }

    /**
     * Display the specified resource.
     */
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

    public function __construct()
    {
        $this->middleware(\App\Http\Middleware\CheckRole::class . ':2')->only('indexRecepcionista');
    }

}
