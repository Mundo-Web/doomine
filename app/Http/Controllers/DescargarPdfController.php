<?php

namespace App\Http\Controllers;

use App\Models\AddressUser;
use App\Models\Ordenes;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;

    

class DescargarPdfController extends Controller
{
    //
    public function __invoke( string $id)
    {

        $orders = Ordenes::findOrFail($id);

        $orders = Ordenes::where('id',  $id)->with('usuarioPedido')->with('statusOrdenes')->with('DetalleOrden')->first();
        
        $direccion = AddressUser::where('id', '=', $orders->address_id)->first();
        $departamentos = DB::table('departments')->where('id', '=',$direccion->departamento_id )->get();
        $provincias = DB::table('provinces')->where('id', '=', $direccion->provincia_id)->get();
        $distritos = DB::table('districts')->where('id', '=', $direccion->distrito_id)->get();

        $subtotal = 0;

        foreach ($orders->DetalleOrden as $item) {
            $subtotal += $item->precio * $item->cantidad;
        } 

        $producto = Products::select('products.*', 'imagen_productos.name_imagen')
                        ->join('detalle_ordens' , 'products.id', '=', 'detalle_ordens.producto_id')
                        ->join('imagen_productos', 'products.id' , '=', 'imagen_productos.product_id')
                        ->where('detalle_ordens.orden_id', '=', $id)
                        ->where('imagen_productos.caratula', '=', 1)
                        ->get();

       $pdf =  Pdf::loadView('pages.orders.plantillasPDF.imprimirDetalleOrden', [
            'orders'=> $orders ,
            'direccion' => $direccion ,
            'departamentos'=> $departamentos,
            'provincias'=>$provincias,
            'distritos'=>$distritos,
            'subtotal'=>$subtotal,
            'producto'=>$producto,
            'title' => 'Detalle de orden #'
       ])->setOptions(['defaultFont' => 'sans-serif']);;
           
       return $pdf->stream('orden.pdf');
    }

    
    
}
