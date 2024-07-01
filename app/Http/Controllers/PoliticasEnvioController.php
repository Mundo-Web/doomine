<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliticasEnvioController extends Controller
{
    //

    public function index()
    {
        $politicasEnvio = DB::select('select * from politicas_de_envio  limit 1');
        return view('pages.politicasEnvio.edit', compact('politicasEnvio'));
    }
    public function guardar(Request $request , string $id){
       

        $result = DB::select('select * from politicas_de_envio where id = ? limit 1', [$id]);

        // Verifica si el resultado está vacío
        if (empty($result)) {
            DB::insert('insert into politicas_de_envio (id, content) values (?, ?)', [1, $request->content]);
        }else{
            DB::update('update politicas_de_envio set content = ? where id = ?', [$request->content,1]);
        }

        return redirect()->route('PoliticadeEnvio.index')->with('success', 'politica de cambio actualizad exitosamente.');


    }
}
