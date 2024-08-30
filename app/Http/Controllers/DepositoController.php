<?php

namespace App\Http\Controllers;

use App\Models\Deposito;
use Illuminate\Http\Request;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Support\Str;

class DepositoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $depositos = Deposito::all();

        return view('depositos.index',compact('depositos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::orderBy('nombre')->get();
        return view('depositos.create',compact('marcas'));
    }

    public function getModelosByMarca($marca_id)
    {
        $modelos = Modelo::where('marca_id', $marca_id)->orderBy('id')->get();
        return response()->json($modelos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $errors = [
            'inventario.unique' => 'Este Código de Inventario ya se encuentra en Depósito.',
            'inventario.required' => 'Debes colocar el Código de Inventario, es obligatorio.',
            'inventario.max' => 'La extensión no puede tener más de 20 caracteres.',
            'serial.max' => 'El Serial no puede tener más de 50 caracteres.',
            'marca_id.max' => 'La Marca no puede tener más de 15 caracteres.',
            'modelo_id.max' => 'El Modelo no puede tener más de 10 caracteres.',
            'ubicacion.max' => 'La Ubicación no puede tener más de 10 caracteres.',
            'estado.required' => 'Debes seleccionar el estado, es obligatorio.',
            'estado.max' => 'El Estado no puede tener más de 20 caracteres.',
            'observacion.max' => 'Las observaciones no puede tener más de 255 caracteres.'
        ];

        $request->validate([
            'inventario' =>'required|unique:depositos|max:20',
            'serial' =>'max:50|nullable',
            'marca_id' =>'max:15|nullable',
            'modelo_id' =>'max:10|nullable',
            'ubicacion' =>'max:10|nullable',
            'estado' => 'required|max:20',
            'observacion' => 'max:255|nullable',
            'modificado' => 'max:50|nullable',
        ],$errors);

        $deposito = new Deposito();
        $deposito->inventario = $request->input('inventario');
        $deposito->serial = Str::upper($request->input('serial'));
        $deposito->marca_id = $request->input('marca_id');
        $deposito->modelo_id = $request->input('modelo_id');
        $deposito->ubicacion = $request->input('ubicacion');
        $deposito->estado = $request->input('estado');
        $deposito->observacion = $request->input('observacion');
        $deposito->modificado = $request->input('modificado');
        
        $deposito->save();

        return redirect()->route('depositos.show', $deposito->id)->with('mensaje', 'Equipos agregado a depósito con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $deposito = Deposito::find($id);
        return view('depositos.show', compact('deposito'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $marcas = Marca::orderBy('nombre')->get();
        $deposito = Deposito::find($id);
        $modelos = Modelo::where('marca_id', $deposito->marca_id)->orderBy('nombre')->get();

        return view('depositos.edit', compact('deposito', 'marcas', 'modelos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $errors = [
            'inventario.unique' => 'Este Código de Inventario ya se encuentra en Depósito.',
            'inventario.required' => 'Debes colocar el Código de Inventario, es obligatorio.',
            'inventario.max' => 'La extensión no puede tener más de 20 caracteres.',
            'serial.max' => 'El Serial no puede tener más de 50 caracteres.',
            'marca_id.max' => 'La Marca no puede tener más de 15 caracteres.',
            'modelo_id.max' => 'El Modelo no puede tener más de 10 caracteres.',
            'ubicacion.max' => 'La Ubicación no puede tener más de 10 caracteres.',
            'estado.required' => 'Debes seleccionar el estado, es obligatorio.',
            'estado.max' => 'El Estado no puede tener más de 20 caracteres.',
            'observacion.max' => 'Las observaciones no puede tener más de 255 caracteres.'
        ];
        
        $request->validate([
            'inventario' =>'required|max:20|unique:depositos,inventario,'.$id,
            'serial' =>'max:50|nullable',
            'marca_id' =>'max:15|nullable',
            'modelo_id' =>'max:10|nullable',
            'ubicacion' =>'max:10|nullable',
            'estado' => 'required|max:20',
            'observacion' => 'max:255|nullable',
            'modificado' => 'max:50|nullable',
        ],$errors);
        
        $deposito = Deposito::find($id);        
        $deposito->inventario = $request->input('inventario');
        $deposito->serial = Str::upper($request->input('serial'));
        $deposito->marca_id = $request->input('marca_id');
        $deposito->modelo_id = $request->input('modelo_id');
        $deposito->ubicacion = $request->input('ubicacion');
        $deposito->estado = $request->input('estado');
        $deposito->observacion = $request->input('observacion');
        $deposito->modificado = $request->input('modificado');
        $deposito->save();

        return redirect()->route('depositos.show', $deposito->id)->with('mensaje', 'Equipo actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deposito = Deposito::find($id);
        $deposito->delete();

        return redirect('depositos')->with('mensaje','Equipo eliminado de deposito con exito.');
    }

}
