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
        $usuarios = Usuario::where('idrol', '!=', 1)->with('empleado')->paginate(10); 
        $empleadoController = new EmpleadoController();
        foreach ($usuarios as $usuario) {
            $usuario->edad = $empleadoController->calcularEdad(optional($usuario->empleado)->fNacimiento);
        }
        return view('admin.empleados', ['usuario' => $usuarios]);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $usuarios = Usuario::where('idrol', '!=', 1)
            ->whereHas('empleado', function ($query) use ($search) {
                $query->where('nombre', 'LIKE', "%$search%")
                    ->orWhere('apellido', 'LIKE', "%$search%")
                    ->orWhere('dni', 'LIKE', "%$search%");
            })
            ->with('empleado')
            ->paginate(10);

        // Verificar si la colección está vacía
        if ($usuarios->isEmpty()) {
            // Enviar mensaje a la sesión
            session()->flash('mensaje', 'No se encontraron usuarios');
            session()->flash('icono', 'error');
        }

        // Calcular la edad de los usuarios
        $empleadoController = new EmpleadoController();
        foreach ($usuarios as $usuario) {
            $usuario->edad = $empleadoController->calcularEdad(optional($usuario->empleado)->fNacimiento);
        }

        return view('admin.empleados', [
            'usuario' => $usuarios,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('admin.createEmpleados');
    }
    public function store(Request $request)
    {
        //$datoss = request()->all();
        //return response()->json($datoss);
    }
    public function show($id)
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
