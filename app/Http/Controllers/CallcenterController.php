<?php

namespace App\Http\Controllers;

use App\Models\Callcenter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CallcenterController extends Controller
{
    protected $services = ['CIC', 'CSI', 'HCM', 'CeCom', 'PROV', 'COR'];

    public function index()
    {
        $callcenters = Callcenter::all();
        $totals = $this->calculateTotals();

        return view('callcenters.index', compact('callcenters', 'totals'));
    }

    public function create()
    {
        return view('callcenters.create');
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateCallcenter($request);
        Callcenter::create($validatedData);

        return redirect('callcenters')->with('mensaje', 'Usuario guardado con éxito.');
    }

    public function edit($id)
    {
        $callcenter = Callcenter::findOrFail($id);
        return view('callcenters.edit', compact('callcenter'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateCallcenter($request, $id);
        $callcenter = Callcenter::findOrFail($id);
        $callcenter->update($validatedData);

        return redirect('callcenters')->with('mensaje', 'Usuario actualizado con éxito.');
    }

    public function destroy($id)
    {
        $callcenter = Callcenter::findOrFail($id);
        $callcenter->delete();

        return redirect('callcenters')->with('mensaje', 'Usuario eliminado con éxito.');
    }

    protected function validateCallcenter(Request $request, $id = null)
    {
        $rules = [
            'extension' => ['required', 'max:6', Rule::unique('callcenters')->ignore($id)],
            'nombres' => 'nullable|max:100',
            'usuario' => ['nullable', 'max:20', Rule::unique('callcenters')->ignore($id)],
            'contrasena' => 'nullable|max:10',
            'servicio' => ['nullable', 'max:15', Rule::in($this->services)],
            'acceso' => 'nullable|max:30',
        ];

        $messages = [
            'extension.required' => 'El campo extensión es obligatorio.',
            'extension.unique' => 'La extensión ya está en uso.',
            'extension.max' => 'La extensión no puede tener más de 6 caracteres.',
            'nombres.max' => 'Los nombres no pueden tener más de 100 caracteres.',
            'usuario.max' => 'El usuario no puede tener más de 20 caracteres.',
            'usuario.unique' => 'Este usuario ya está en uso.',
            'servicio.max' => 'El servicio no puede tener más de 15 caracteres.',
            'servicio.in' => 'El servicio seleccionado no es válido.',
            'acceso.max' => 'El acceso no puede tener más de 30 caracteres.',
        ];

        return $request->validate($rules, $messages);
    }

    protected function calculateTotals()
    {
        $totals = [];
        foreach ($this->services as $service) {
            $totals[$service] = Callcenter::where('servicio', $service)->count();
        }
        $totals['total'] = Callcenter::count();
        return $totals;
    }
}