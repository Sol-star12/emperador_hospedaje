<?php

namespace App\Http\Controllers;
use App\Models\Categorium;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function conteoCategorias()
    {
        $categorias = Categorium::all(); // Obtén todas las categorías
        return view('habitaciones.limpieza.index', compact('categorias'));
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
