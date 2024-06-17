<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Models\Price;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $precios = Price::where("status", "=", true)->get();
        
        $departamentos = DB::table('departments')->get();
        $provincias = DB::table('provinces')->get();
        $distritos = DB::table('districts')->get();
       
        return view('pages.prices.index', compact('precios', 'departamentos', 'provincias', 'distritos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //traemos las provincias de la tabla
        $departamentos = DB::table('departments')->get();
        return view('pages.prices.create', compact('departamentos'));
    }

    public function getProvincias(Request $request)
    {
        //
        //traemos las provincias de la tabla
        
        $provincias = DB::table('provinces')
                    ->where('department_id', '=', $request->id)
                    ->get();

        return response()->json($provincias);
    }

    public function getDistrito(Request $request)
    {
        //
        //traemos las provincias de la tabla
        
        $distritos = DB::table('districts')
                    ->where('province_id', '=', $request->id)
                    ->get();

        return response()->json($distritos);
    }
    public function calculeEnvio(Request $request){
        
       $LocalidadParaEnvio = Price::where('distrito_id',$request->id)->get();
        return response()->json(['message'=> 'LLegando Correctamente', 'LocalidadParaEnvio'=> $LocalidadParaEnvio]);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
           'price' => 'required' 
        ]);
        $price = new Price();

        $price->distrito_id = $request->distrito_id;
        $price->price = $request->price;
        $price->status = 1;
        $price->visble = 1;

        //preguntamos si es lima o no ID=15
        if($request->departamento_id == 15){
            if($request->provincia_id == 1501){
                $price->local = 1;
            }else{
                $price->local = 0;
            }
            
        }

        $price->save();

        return redirect()->route('prices.index')->with('success', 'Servicio creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Price $price)
    {
        //
        
        // $price = Price::where('id', = , 'prioce')
        $departamentos = DB::table('departments')->get() ;
       $distritos = DB::table('districts')
        ->where('id', '=', $price->distrito_id)
        ->get();
        //distrito

        return view('pages.prices.edit', compact('price', 'departamentos', 'distritos'));
    }

    /**update
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        Price::find($id)->update($request->all());
        return redirect()->route('prices.index')->with('success', 'Servicio creado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Price $price)
    {
        //
    }
}
