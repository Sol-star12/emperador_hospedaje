<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use Illuminate\Http\Request;
use App\Http\Requests\ComprobanteRequest; 

class ComprobanteController extends Controller
{
   
    public function index(Request $request)
    {

        $search = $request->get('search', '');
        $orderBy = $request->get('orderBy', 'fecha');
        $direction = $request->get('direction', 'desc');

        if (!in_array($orderBy, ['fecha', 'monto', 'tipo_comprobante'])) {
            $orderBy = 'fecha'; // Valor por defecto
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc'; // Valor por defecto
        }

        $comprobantes = Comprobante::query()
            ->where('tipo_comprobante', 'like', "%{$search}%")  // Búsqueda por tipo de comprobante
            ->orWhere('monto', 'like', "%{$search}%")          // Búsqueda por monto
            ->orderBy($orderBy, $direction)                    // Ordenar por los parámetros proporcionados
            ->paginate(10);                                    // Paginación

      
        return view('comprobantes.index', compact('comprobantes'));
    }

   
    public function create()
    {
       
        return view('comprobantes.create');
    }

   
    public function store(ComprobanteRequest $request)
    {
  
        $data = $request->validated(); 

       
        Comprobante::create($data);

      
        return redirect()->route('comprobantes.index')->with('success', 'Comprobante creado con éxito.');
    }

   
    public function show(string $id)
    {
      
        $comprobante = Comprobante::findOrFail($id);
        

        return view('comprobantes.show', compact('comprobante'));
    }


    public function edit(string $id)
    {
  
        $comprobante = Comprobante::findOrFail($id);
        

        return view('comprobantes.edit', compact('comprobante'));
    }

   
    public function update(ComprobanteRequest $request, string $id)
    {
        $data = $request->validated();

  
        $comprobante = Comprobante::findOrFail($id);
        $comprobante->update($data);

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante actualizado con éxito.');
    }

 
    public function destroy(string $id)
    {
        $comprobante = Comprobante::findOrFail($id);
        
        $comprobante->delete();

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante eliminado con éxito.');
    }
}

