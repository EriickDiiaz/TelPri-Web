<?php

namespace App\Http\Controllers;

use App\Models\Linea;
use App\Models\Localidad;
use App\Models\Campo;
use App\Models\Piso;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class LineaController extends Controller
{
    private function getTotalLineas()
    {
        return [
            'totalAxe' => Linea::where('plataforma', 'Axe')->count(),
            'totalCisco' => Linea::where('plataforma', 'Cisco')->count(),
            'totalEricsson' => Linea::where('plataforma', 'Ericsson')->count(),
            'totalExterno' => Linea::where('plataforma', 'Externo')->count(),
            'totalLineas' => Linea::count(),
        ];
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Linea::query();

            return DataTables::of($query)
                ->addColumn('action', function ($linea) {
                    $actions = '';
                    $actions .= '<a href="' . route('lineas.show', $linea->id) . '" class="btn btn-outline-light btn-sm"><i class="fa-solid fa-list-ul"></i></a>';
                    if (auth()->user()->can('Editar Lineas')) {
                        $actions .= ' <a href="' . route('lineas.edit', $linea->id) . '" class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-phone-volume"></i></a>';
                    }
                    if (auth()->user()->can('Eliminar Lineas')) {
                        $actions .= ' <button class="btn btn-outline-danger btn-sm delete-linea" data-id="' . $linea->id . '"><i class="fa-solid fa-phone-slash"></i></button>';
                    }
                    return $actions;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $totals = $this->getTotalLineas();

        return view('lineas.index', $totals);
    }

    public function create()
    {
        $localidades = Localidad::orderBy('nombre')->get();
        $campos = Campo::orderBy('nombre')->get();
        return view('lineas.create', compact('localidades', 'campos'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateLinea($request);
        $linea = Linea::create($validatedData);

        return redirect()->route('lineas.show', $linea->id)->with('mensaje', 'Línea agregada con éxito.');
    }

    public function show($id)
    {
        $linea = Linea::with(['localidad', 'piso', 'campo'])->findOrFail($id);
        $activities = $linea->activities()->with('causer')->latest()->get();

        return view('lineas.show', compact('linea', 'activities'));
    }

    public function edit($id)
    {
        $localidades = Localidad::orderBy('nombre')->get();
        $campos = Campo::orderBy('nombre')->get();
        $linea = Linea::findOrFail($id);
        $pisos = Piso::where('localidad_id', $linea->localidad_id)->orderBy('nombre')->get();

        return view('lineas.edit', compact('linea', 'localidades', 'campos', 'pisos'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateLinea($request, $id);
        $linea = Linea::findOrFail($id);
        $linea->update($validatedData);

        return redirect()->route('lineas.show', $linea->id)->with('mensaje', 'Línea actualizada con éxito.');
    }

    public function destroy($id)
    {
        $linea = Linea::findOrFail($id);
        $linea->delete();

        return redirect()->route('lineas.index') ->with('mensaje', 'Línea eliminada con éxito.');
        //return response()->json(['mensaje' => 'Línea Telefónica eliminada con éxito.']);
    }

    protected function validateLinea(Request $request, $id = null)
    {
        $rules = [
            'linea' => ['required', 'max:10', $id ? 'unique:lineas,linea,'.$id : 'unique:lineas'],
            'vip' => 'nullable|max:20',
            'inventario' => 'nullable|max:50',
            'serial' => 'nullable|max:50',
            'plataforma' => 'nullable|max:20',
            'estado' => 'required|max:20',
            'titular' => 'nullable|max:100',
            'acceso' => 'nullable|array',
            'acceso.*' => 'string|in:Interno,Local,Nacional,0416,Otras Operadoras,Internacional',
            'localidad_id' => 'nullable|exists:localidades,id',
            'piso_id' => 'nullable|exists:pisos,id',
            'mac' => 'nullable|max:50',
            'campo_id' => 'nullable|exists:campos,id',
            'par' => 'nullable|max:6',
            'directo' => 'nullable|max:50',
            'observacion' => 'nullable|max:255',
            'modificado' => 'nullable|max:50',
        ];

        $messages = [
            'linea.required' => 'Debes colocar la Línea telefónica, es obligatorio.',
            'linea.unique' => 'La Línea telefónica ya está en uso.',
            'linea.max' => 'La Línea telefónica no puede tener más de 10 caracteres.',
            'estado.required' => 'Debes colocar el Estado de la línea, es obligatorio.',
            'titular.max' => 'El nombre del titular no puede tener más de 100 caracteres.',
            'mac.max' => 'El MAC/EQ/LI3 no puede tener más de 50 caracteres.',
            'serial.max' => 'El número de serie no puede tener más de 50 caracteres.',
        ];

        // Aplicar transformaciones antes de la validación
        $input = $request->all();
        $input['titular'] = $request->has('titular') ? Str::title($request->input('titular')) : null;
        $input['mac'] = $request->has('mac') ? Str::upper($request->input('mac')) : null;
        $input['serial'] = $request->has('serial') ? Str::upper($request->input('serial')) : null;

        // Reemplazar los datos de la solicitud con los datos transformados
        $request->replace($input);

        // Realizar la validación
        $validatedData = $request->validate($rules, $messages);

        // Asegurarse de que los campos transformados se incluyan en los datos validados
        $validatedData['titular'] = $input['titular'];
        $validatedData['mac'] = $input['mac'];
        $validatedData['serial'] = $input['serial'];

        return $validatedData;
    }

    public function avanzada(Request $request)
    {
        if ($request->ajax()) {
            $query = Linea::with(['localidad', 'piso', 'campo']);

            // Apply filters
            $filters = ['linea', 'inventario', 'serial', 'plataforma', 'estado', 'titular', 'mac', 'par'];
            foreach ($filters as $filter) {
                if ($request->filled($filter)) {
                    $query->where($filter, 'like', '%' . $request->input($filter) . '%');
                }
            }

            if ($request->filled('localidad_id')) {
                $query->where('localidad_id', $request->localidad_id);
            }
            if ($request->filled('piso_id')) {
                $query->where('piso_id', $request->piso_id);
            }
            if ($request->filled('campo_id')) {
                $query->where('campo_id', $request->campo_id);
            }
            if ($request->filled('vip')) {
                $query->where('vip', $request->vip);
            }

            return DataTables::of($query)
                ->addColumn('linea_with_vip', function ($linea) {
                    $vipIcon = $linea->vip ? '<i class="fa-solid fa-star text-warning"></i> ' : '';
                    return '<a href="' . route('lineas.show', $linea->id) . '">' . $vipIcon . $linea->linea . '</a>';
                })
                ->editColumn('inventario', function ($linea) {
                    return $linea->inventario ?: 'N/A';
                })
                ->editColumn('serial', function ($linea) {
                    return $linea->serial ?: 'N/A';
                })
                ->editColumn('plataforma', function ($linea) {
                    return $linea->plataforma ?: 'N/A';
                })
                ->editColumn('estado', function ($linea) {
                    return $linea->estado ?: 'N/A';
                })
                ->editColumn('titular', function ($linea) {
                    return $linea->titular ?: 'N/A';
                })
                ->editColumn('localidad.nombre', function ($linea) {
                    return $linea->localidad ? $linea->localidad->nombre : 'N/A';
                })
                ->editColumn('piso.nombre', function ($linea) {
                    return $linea->piso ? $linea->piso->nombre : 'N/A';
                })
                ->editColumn('mac', function ($linea) {
                    return $linea->mac ?: 'N/A';
                })
                ->editColumn('campo.nombre', function ($linea) {
                    return $linea->campo ? $linea->campo->nombre : 'N/A';
                })
                ->editColumn('par', function ($linea) {
                    return $linea->par ?: 'N/A';
                })
                ->rawColumns(['linea_with_vip'])
                ->make(true);
        }

        $localidades = Localidad::orderBy('nombre')->get();
        $campos = Campo::orderBy('nombre')->get();

        return view('lineas.avanzada', compact('localidades', 'campos'));
    }

    public function getPisos(Request $request)
    {
        $localidad_id = $request->input('localidad_id');
        $pisos = Piso::where('localidad_id', $localidad_id)->orderBy('nombre')->get();
        return response()->json($pisos);
    }
}