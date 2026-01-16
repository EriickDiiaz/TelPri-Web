<?php

namespace App\Http\Controllers;

use App\Models\Par;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ParController extends Controller
{

    public function index(Request $request)
    {
        $pares = Par::all();

        if ($request->ajax()) {
            // Join with ubicaciones so we can sort/search by ubicaciones.nombre
            $query = Par::select('pares.*', 'ubicaciones.nombre as ubicacion_nombre')
                ->leftJoin('ubicaciones', 'pares.ubicacion_id', '=', 'ubicaciones.id');

            return DataTables::of($query)
                ->addColumn('ubicacion', function ($par) {
                    return $par->ubicacion_nombre ?? ($par->ubicacion?->nombre ?? '');
                })
                ->filterColumn('ubicacion', function ($query, $keyword) {
                    $query->where('ubicaciones.nombre', 'like', "%{$keyword}%");
                })
                ->orderColumn('ubicacion', 'ubicaciones.nombre $1')
                ->addColumn('action', function ($par) {
                    $actions = '';
                    $actions .= '<a href="' . route('pares.show', $par->id) . '" class="btn btn-outline-light btn-sm"><i class="fa-solid fa-list-ul"></i></a>';
                    if (auth()->user()->can('Editar Pares')) {
                        $actions .= ' <a href="' . route('pares.edit', $par->id) . '" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-phone-volume"></i></a>';
                    }
                    if (auth()->user()->can('Eliminar Pares')) {
                        $actions .= ' <button class="btn btn-outline-danger btn-sm delete-par" data-id="' . $par->id . '"><i class="fa-solid fa-phone-slash"></i></button>';
                    }
                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pares.index', compact('pares'));
    }

    public function create()
    {
        $ubicaciones = Ubicacion::all();
        return view('pares.create', compact('ubicaciones'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validatePar($request);
        
        $par = Par::create($validatedData);

        return redirect()->route('pares.show', $par->id)->with('mensaje', 'Par agregado con éxito.');
    }

    public function show($id)
    {
        $par = Par::findOrFail($id);
        $activities = $par->activities()->with('causer')->latest()->get();
        return view('pares.show', compact('par', 'activities'));
    }

    public function edit($id)
    {
        $ubicaciones = Ubicacion::all();
        $par = Par::findOrFail($id);
        return view('pares.edit', compact('par', 'ubicaciones'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validatePar($request, $id);

        $par = Par::findOrFail($id);
        $par->update($validatedData);

        return redirect()->route('pares.show', $par->id)->with('mensaje', 'Par actualizado con éxito.');
    }

    public function destroy($id)
    {
        $par = Par::findOrFail($id);
        $par->delete();

        return redirect()->route('pares.index')->with('mensaje', 'Par eliminado con éxito.');
    }

    protected function validatePar(Request $request, $id = null)
    {
        $rules = [
            'numero' => [
                'required',
                'string',
                'max:4',
                Rule::unique('pares')->where(fn ($q) => $q->where('ubicacion_id', $request->ubicacion_id))->ignore($id),
            ],
            'estado' => 'required|string|max:20',
            'plataforma' => 'nullable|string|max:20',
            'ubicacion_id' => 'required|exists:ubicaciones,id',
            'observaciones' => 'nullable|string|max:255',
        ];

        $messages = [
            'numero.required' => 'Debes colocar el número, es obligatorio.',
            'numero.string' => 'El número debe ser una cadena de texto.',
            'numero.max' => 'El número no puede tener más de 4 caracteres.',
            'numero.unique' => 'Este número ya existe en la ubicación seleccionada.',
            'estado.required' => 'Debes seleccionar el estado, es obligatorio.',
            'estado.string' => 'El estado debe ser una cadena de texto.',
            'estado.max' => 'El estado no puede tener más de 20 caracteres.',
            'plataforma.string' => 'La plataforma debe ser una cadena de texto.',
            'plataforma.max' => 'La plataforma no puede tener más de 20 caracteres.',
            'ubicacion_id.required' => 'Debes seleccionar una ubicación.',
            'ubicacion_id.exists' => 'La ubicación seleccionada no es válida.',
            'observaciones.string' => 'Las observaciones deben ser una cadena de texto.',
            'observaciones.max' => 'Las observaciones no pueden tener más de 255 caracteres.',
        ];

        return $request->validate($rules, $messages);
    }

    public function avanzada(Request $request)
    {
        if ($request->ajax()) {
            $query = Par::with(['ubicacion']);

            // Apply filters
            $filters = ['numero', 'estado', 'plataforma'];
            foreach ($filters as $filter) {
                if ($request->filled($filter)) {
                    $query->where($filter, 'like', '%' . $request->input($filter) . '%');
                }
            }
            if ($request->filled('ubicacion_id')) {
                $query->where('ubicacion_id', $request->ubicacion_id);
            }

            return DataTables::of($query)
                ->addColumn('numero', function ($par) {
                    return '<a href="' . route('pares.show', $par->id) . '">' . $par->numero . '</a>';
                })
                ->editColumn('ubicacion.nombre', function ($par) {
                    return $par->ubicacion ? $par->ubicacion->nombre : 'N/A';
                })
                ->editColumn('estado', function ($par) {
                    return $par->estado ?: 'N/A';
                })
                ->editColumn('plataforma', function ($par) {
                    return $par->plataforma ?: 'N/A';
                })
                ->rawColumns(['numero'])
                ->make(true);
        }

        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        return view('pares.avanzada', compact('ubicaciones'));
    }
}
