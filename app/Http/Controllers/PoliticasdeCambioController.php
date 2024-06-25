<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliticasdeCambioController extends Controller
{
    //
    public function index(){
      $politicasCambio =  DB::select('select * from politicas_de_cambio  limit 1' );
        return view("pages.politicasCambio.index", compact('politicasCambio'));
    }
    public function guardar(Request $request , string $id){
       

        $result = DB::select('select * from politicas_de_cambio where id = ? limit 1', [$id]);

        // Verifica si el resultado está vacío
        if (empty($result)) {
            DB::insert('insert into politicas_de_cambio (id, content) values (?, ?)', [1, $request->content]);
        }else{
            DB::update('update politicas_de_cambio set content = ? where id = ?', [$request->content,1]);
        }

        return redirect()->route('politicadeCambio.index')->with('success', 'politica de cambio actualizad exitosamente.');


    }
}
