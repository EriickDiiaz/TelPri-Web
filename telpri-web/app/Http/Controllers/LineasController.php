<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Lineas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LineasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $conteo = Lineas::toBase()
        ->selectRaW("count(case when plataforma = 'AXE' then 1 end) as TotalAxe")
        ->selectRaW("count(case when plataforma = 'Cisco' then 1 end) as TotalCisco")
        ->selectRaW("count(case when plataforma = 'Ericsson' then 1 end) as TotalEricsson")
        ->first();

        $busqueda = $request->busqueda;
        $lineas = Lineas::where('linea', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('vip', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('plataforma', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('inventario', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('campo', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('mac', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('titular', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('estado', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('localidad', 'LIKE', '%'.$busqueda.'%')
                    ->orWhere('piso', 'LIKE', '%'.$busqueda.'%')
                    ->orderBy('linea', 'ASC')
                    ->latest('id')
                    ->paginate(20);                     
                                              
        return view('lineas.index',compact('lineas','busqueda','conteo'));
    }


    /**
    * Funcion para crear PDF y controlar fecha.
    */

    public function pdf(){
        $fecha = Carbon::now()->format('d / m / Y - H:i:s');
        $lineas = Lineas::all();
        $pdf = PDF::LoadView('lineas.pdf', ['lineas'=>$lineas, 'fecha'=>$fecha]);
        return $pdf->stream();
        //return $pdf->stream("archivo.pdf", array("Attachment"=>true));     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lineas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'linea' =>'required|max:10',
            'vip' =>'max:20|nullable',
            'inventario' =>'max:50|nullable',
            'serial' =>'max:50|nullable',
            'plataforma' =>'max:20|nullable',
            'mac' =>'max:50|nullable',
            'campo' =>'max:50|nullable',
            'titular' =>'max:100|nullable',
            'estado' =>'required|max:20',
            'localidad' =>'max:50|nullable',
            'piso' =>'max:5|nullable',
            'observacion' =>'max:255|nullable'            
        ]);

        $linea = new Lineas();
        $linea->linea = $request->input('linea');
        $linea->vip = $request->input('vip');
        $linea->plataforma = $request->input('plataforma');
        $linea->inventario = $request->input('inventario');
        $linea->serial = $request->input('serial');
        $linea->mac = $request->input('mac');
        $linea->campo = $request->input('campo');
        $linea->titular = $request->input('titular');
        $linea->estado = $request->input('estado');
        $linea->localidad = $request->input('localidad');
        $linea->piso = $request->input('piso');
        $linea->observacion = $request->input('observacion');
        $linea->save();

        return redirect ('lineas')->with('mensaje','Línea guardada con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $linea = Lineas::find($id);
        return view('lineas.show',['linea'=>$linea]
    );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $linea = Lineas::find($id);
        return view('lineas.edit',['linea'=>$linea]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'linea' =>'required|max:10',
            'vip' =>'max:20|nullable',
            'plataforma' =>'max:20|nullable',
            'inventario' =>'max:50|nullable',
            'serial' =>'max:50|nullable',
            'mac' =>'max:50|nullable',
            'campo' =>'max:50|nullable',
            'titular' =>'max:100|nullable',
            'estado' =>'required|max:20',
            'localidad' =>'max:50|nullable',
            'piso' =>'max:5|nullable',
            'observacion' =>'max:255|nullable'            
        ]);

        $linea = Lineas::find($id);
        $linea->linea = $request->input('linea');
        $linea->vip = $request->input('vip');
        $linea->plataforma = $request->input('plataforma');
        $linea->inventario = $request->input('inventario');
        $linea->serial = $request->input('serial');
        $linea->mac = $request->input('mac');
        $linea->campo = $request->input('campo');
        $linea->titular = $request->input('titular');
        $linea->estado = $request->input('estado');
        $linea->localidad = $request->input('localidad');
        $linea->piso = $request->input('piso');
        $linea->observacion = $request->input('observacion');
        $linea->save();

        return redirect ('lineas')->with('mensaje','Línea actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $linea = Lineas::find($id);
        $linea->delete();

        return redirect ('lineas')->with('mensaje','La línea '.$linea->linea. ' correspondiente a '.$linea->titular.' se ha eliminado correctamente.');
    }
}
