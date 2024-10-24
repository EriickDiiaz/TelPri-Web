<?php

namespace App\Http\Controllers;

use App\Models\Deposito;
use App\Models\Marca;
use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DepositoController extends Controller
{
    public function index()
    {
        $depositos = Deposito::with(['marca', 'modelo'])->get();
        $totalCortijos = Deposito::where('ubicacion', 'Cortijos')->count();
        $totalNea = Deposito::where('ubicacion', 'Nea')->count();
        $totalDeposito = Deposito::count();

        return view('depositos.index', compact('depositos', 'totalCortijos', 'totalNea', 'totalDeposito'));
    }

    public function create()
    {
        $marcas = Marca::orderBy('nombre')->get();
        return view('depositos.create', compact('marcas'));
    }

    public function getModelosByMarca($marca_id)
    {
        $modelos = Modelo::where('marca_id', $marca_id)->orderBy('id')->get();
        return response()->json($modelos);
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateDeposito($request);
        $validatedData['serial'] = Str::upper($validatedData['serial']);
        
        $deposito = Deposito::create($validatedData);

        return redirect()->route('depositos.show', $deposito->id)->with('mensaje', 'Equipo agregado a depósito con éxito.');
    }

    public function show($id)
    {
        $deposito = Deposito::findOrFail($id);
        return view('depositos.show', compact('deposito'));
    }

    public function edit($id)
    {
        $deposito = Deposito::findOrFail($id);
        $marcas = Marca::orderBy('nombre')->get();
        $modelos = Modelo::where('marca_id', $deposito->marca_id)->orderBy('nombre')->get();

        return view('depositos.edit', compact('deposito', 'marcas', 'modelos'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateDeposito($request, $id);
        $validatedData['serial'] = Str::upper($validatedData['serial']);

        $deposito = Deposito::findOrFail($id);
        $deposito->update($validatedData);

        return redirect()->route('depositos.show', $deposito->id)->with('mensaje', 'Equipo actualizado con éxito.');
    }

    public function destroy($id)
    {
        $deposito = Deposito::findOrFail($id);
        $deposito->delete();

        return redirect()->route('depositos.index')->with('mensaje', 'Equipo eliminado de depósito con éxito.');
    }

    protected function validateDeposito(Request $request, $id = null)
    {
        $rules = [
            'inventario' => ['required', 'max:20', Rule::unique('depositos')->ignore($id)],
            'serial' => ['max:50', Rule::unique('depositos')->ignore($id)],
            'marca_id' => 'nullable|exists:marcas,id',
            'modelo_id' => 'nullable|exists:modelos,id',
            'ubicacion' => 'nullable|max:10',
            'estado' => 'required|max:20',
            'observacion' => 'nullable|max:255',
            'modificado' => 'nullable|max:50',
        ];

        $messages = [
            'inventario.unique' => 'Este Código de Inventario ya se encuentra en Depósito.',
            'inventario.required' => 'Debes colocar el Código de Inventario, es obligatorio.',
            'inventario.max' => 'El Código de Inventario no puede tener más de 20 caracteres.',
            'serial.max' => 'El Serial no puede tener más de 50 caracteres.',
            'serial.unique' => 'Este Serial ya se encuentra en Depósito.',
            'ubicacion.max' => 'La Ubicación no puede tener más de 10 caracteres.',
            'estado.required' => 'Debes seleccionar el estado, es obligatorio.',
            'estado.max' => 'El Estado no puede tener más de 20 caracteres.',
            'observacion.max' => 'Las observaciones no pueden tener más de 255 caracteres.'
        ];

        return $request->validate($rules, $messages);
    }
}