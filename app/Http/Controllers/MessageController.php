<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mensajes = Message::where('status' , '=', 1 )->where('source', '!=', 'Landing - Set Madrid')->orderBy('created_at', 'DESC')->get();
        return view('pages.message.index', compact('mensajes'));
    
        
    }

    public function mensajeslanding()
    {
        //
        $mensajes = Message::where('status' , '=', 1 )->where('source' , '=', 'Landing - Set Madrid' )->orderBy('created_at', 'DESC')->get();
        return view('pages.landingmessage.index', compact('mensajes'));
    
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    function storePublic(Request $request)
    {
        $mensaje = new Message();

        $mensaje->full_name = $request-> nombre; 
        $mensaje->email = $request-> email; 
        $mensaje->phone = $request-> telefono; 
        $mensaje->source = $request-> textoSeleccionado; 
        $mensaje->service_product = $request-> textoMeet; 

        $mensaje->save();

        return response()->json(['message' => 'Solicitud enviada Correctamente']);
    }

    /**
     * Display the specified resource.
     */
    //public function show(Message $message)
    public function show($id)
    {
        //
        $message = Message::findOrFail($id);

        $message->is_read = 1; 
        $message->save();

        return view('pages.message.show', compact('message'));
    }


    public function mensajeslandingshow($id)
    {
        //
        $message = Message::findOrFail($id);

        $message->is_read = 1; 
        $message->save();

        return view('pages.landingmessage.show', compact('message'));
    }






    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }


    public function borrar(Request $request)
    {

        $mensaje = Message::find($request->id);
        $mensaje->status = 0; 
        $mensaje->save();

        return response()->json(['success' => true]);

    }
}
