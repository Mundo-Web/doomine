<?php

namespace App\Http\Controllers;

use App\Helpers\EmailConfig;
use App\Http\Requests\StoreIndexRequest;
use App\Http\Requests\UpdateIndexRequest;
use App\Models\AddressUser;
use App\Models\Attributes;
use App\Models\AttributesValues;
use App\Models\Faqs;
use App\Models\General;
use App\Models\Index;
use App\Models\Message;
use App\Models\Products;
use App\Models\Slider;
use App\Models\Strength;
use App\Models\Testimony;
use App\Models\Category;
use App\Models\Collection;
use App\Models\Combinacion;
use App\Models\DetalleOrden;
use App\Models\ImagenProducto;
use App\Models\Liquidacion;
use App\Models\Ordenes;
use App\Models\PolyticsCondition;
use App\Models\Specifications;
use App\Models\TermsAndCondition;
use App\Models\TypeAttribute;
use App\Models\User;
use App\Models\UserDetails;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\isNull;

class IndexController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // $productos = Products::all();
    $productos = Products::where('status', '=', 1)->with('tags')->get();
    $categorias = Category::all();
    $destacados = Products::where('destacar', '=', 1)->where('status', '=', 1)->where('visible', '=', 1)->with('tags')->with('images')->get();
    // $descuentos = Products::where('descuento', '>', 0)->where('status', '=', 1)
    // ->where('visible', '=', 1)->with('tags')->get();
    $newarrival = Products::where('recomendar', '=', 1)->where('status', '=', 1)->where('visible', '=', 1)->with('tags')->with('images')->get();

    $general = General::all();
    $benefit = Strength::where('status', '=', 1)->get();
    $faqs = Faqs::where('status', '=', 1)->where('visible', '=', 1)->get();
    $testimonie = Testimony::where('status', '=', 1)->where('visible', '=', 1)->get();
    $slider = Slider::where('status', '=', 1)->where('visible', '=', 1)->get();
    $category = Category::where('status', '=', 1)->where('destacar', '=', 1)->get();
    $liquidacion = Liquidacion::where('status', '=', 1)->where('visible', '=', 1)->get();

    return view('public.index', compact('productos', 'destacados', 'newarrival', 'general', 'benefit', 'faqs', 'testimonie', 'slider', 'categorias', 'category', 'liquidacion'));
  }

  public function preguntasFrecuentes()
  {

    $faqs = Faqs::where('status', '=', 1)->where('visible', '=', 1)->get();

    return view('public.faqs', compact('faqs'));
  }

  public function coleccion($filtro)
  {
    try {
      $collections = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();

      if ($filtro == 0) {
        $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->paginate(16);
        $collection = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();
      } else {
        $productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('collection_id', '=', $filtro)->paginate(16);
        $collection = Collection::where('status', '=', 1)->where('visible', '=', 1)->where('id', '=', $filtro)->first();
      }

      return view('public.collection', compact('filtro', 'productos', 'collection', 'collections'));
    } catch (\Throwable $th) {
    }
  }

  public function catalogoFiltroAjax(Request $request)
  {

    $paginado = 0;
    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {

      $paginado = 8;
    } else {

      $paginado = 9;
    }
    $priceOrder = $request->orderPrice;
    
    $productos = Products::obtenerProductos('', $paginado, $priceOrder );
     $page = 0 ;
    if (!empty($productos->nextPageUrl())) {
      $parse_url = parse_url($productos->nextPageUrl());
    

      if (!empty($parse_url['query'])) {
        parse_str($parse_url['query'], $get_array);
        $page = !empty($get_array['page']) ? $get_array['page'] : 0;
      }
    }

    return response()->json(
      [
        'status' => true,
        'page' => $page,
        'success' => view('public._listproduct', [
          'productos' => $productos,
        ])->render(),
      ],
      200,
    );
  }



  public function catalogo($filtro, Request $request)
  {
    $categorias = null;
    $productos = null;
    $paginado = 0;
    $priceOrder = $request->input('priceOrder');
    

    $useragent = $_SERVER['HTTP_USER_AGENT'];
    if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {

      $paginado = 8;
    } else {

      $paginado = 9;
    }

   
    try {
      $general = General::all();
      $faqs = Faqs::where('status', '=', 1)->where('visible', '=', 1)->get();
      $categorias = Category::all();
      $testimonie = Testimony::where('status', '=', 1)->where('visible', '=', 1)->get();
      $atributos = Attributes::with(['typeAttribute', 'attributeValues'])->where('status', '=', 1)->where('visible', '=', 1)->get();
      $colecciones = Collection::where('status', '=', 1)->where('visible', '=', 1)->get();

      if ($filtro == 0) {
        //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->with('tags')->paginate(12);
        $productos = Products::obtenerProductos('', $paginado, $priceOrder);

        $categoria = Category::all();
      } else {
        //$productos = Products::where('status', '=', 1)->where('visible', '=', 1)->where('categoria_id', '=', $filtro)->with('tags')->paginate(12);
        $productos = Products::obtenerProductos($filtro, $paginado,$priceOrder);

        $categoria = Category::findOrFail($filtro);
      }
      

      $page = 0;
      if (!empty($productos->nextPageUrl())) {
        $parse_url = parse_url($productos->nextPageUrl());

        if (!empty($parse_url['query'])) {
          parse_str($parse_url['query'], $get_array);
          $page = !empty($get_array['page']) ? $get_array['page'] : 0;
        }
      }
      $appUrl = $_ENV['APP_URL'];

      return view('public.catalogo') 
      ->with('general', $general)
      ->with('faqs', $faqs)
      ->with('categorias', $categorias)
      ->with('testimonie', $testimonie)
      ->with('filtro', $filtro)
      ->with('categoria', $categoria)
      ->with('atributos', $atributos)
      ->with('colecciones', $colecciones)
      ->with('page', $page);
      
    } catch (\Throwable $th) {
      //throw $th;
      dd($th);
    }
  }

  public function comentario()
  {
    $comentarios = Testimony::where('status', '=', 1)->where('visible', '=', 1)->paginate(15);
    $contarcomentarios = count($comentarios);
    return view('public.comentario', compact('comentarios', 'contarcomentarios'));
  }

  public function hacerComentario(Request $request)
  {
    $user = auth()->user();

    $newComentario = new Testimony();
    if (isset($user)) {
      $alert = null;
      $request->validate(
        [
          'testimonie' => 'required',
        ],
        [
          'testimonie.required' => 'Ingresa tu comentario',
        ],
      );

      $newComentario->name = $user->name;
      $newComentario->testimonie = $request->testimonie;
      $newComentario->visible = 0;
      $newComentario->status = 1;
      $newComentario->email = $user->email;
      $newComentario->save();

      $mensaje = 'Gracias. Tu comentario pasará por una validación y será publicado.';
      $alert = 1;
    } else {
      $alert = 2;
      $mensaje = 'Inicia sesión para hacer un comentario';
    }

    return redirect()
      ->route('comentario')
      ->with(['mensaje' => $mensaje, 'alerta' => $alert]);
  }

  public function contacto()
  {
    $general = General::all();
    return view('public.contact', compact('general'));
  }

  public function carrito()
  {
    //
    $url_env = $_ENV['APP_URL'];
    $departamentos = DB::table('departments')->get();
    return view('public.checkout_carrito', compact('url_env', 'departamentos'));
  }

  public function pago(Request $request)
  {
    //
    $formToken = $request->input('token');
    $codigoCompra = $request->input('codigoCompra');

    $detalleUsuario = [];
    $user = auth()->user();
    $N_orden = Ordenes::where('codigo_orden', '=', $codigoCompra)->get()->toArray();
    /* if (!isNull($user)) {
      $detalleUsuario = UserDetails::where('email', $user->email)->get();
    } */
    $detalleUsuario = UserDetails::where('id', $N_orden[0]['usuario_id'])->get();

    $distritos = DB::select('select * from districts where active = ? order by 3', [1]);
    $provincias = DB::select('select * from provinces where active = ? order by 3', [1]);
    $departamento = DB::select('select * from departments where active = ? order by 2', [1]);

    //consultar n orden
    // traer los datos necesarios para armar el token
    // $formToken =  $this->generateFormTokenIzipay();

    $url_env = $_ENV['APP_URL'];
    return view('public.checkout_pago', compact('url_env', 'distritos', 'provincias', 'departamento', 'detalleUsuario', 'formToken', 'codigoCompra'));
  }

  private function generateFormTokenIzipay($amount, $orderId, $email)
  {
    $clientId = config('services.izipay.client_id');
    $clientSecret = config('services.izipay.client_secret');
    $auth = base64_encode($clientId . ':' . $clientSecret);

    $url = config('services.izipay.url');
    $response = Http::withHeaders([
      'Authorization' => "Basic $auth",
      'Content-Type' => 'application/json',
    ])
      ->post($url, [
        'amount' => $amount * 100,
        'currency' => 'PEN',
        'orderId' => $orderId,
        'customer' => [
          'email' => $email,
        ],
      ])
      ->json();

    $token = $response['answer']['formToken'];
    return $token;
  }

  public function procesarPago(Request $request)
  {
    $codigoCompra = $request->codigoCompra;
    $dataArray = $request->data;
    $result = [];

    $codigoAleatorio = '';
    foreach ($dataArray as $item) {
      $result[$item['name']] = $item['value'];
    }
    $tipoTarjeta = $result['tipo_tarjeta'];

    try {
      $reglasPrimeraCompra = [
        'email' => 'required',
      ];
      $mensajes = [
        'email.required' => 'El campo Email es obligatorio.',
      ];
      // $request->validate($reglasPrimeraCompra, $mensajes);

      $orden = Ordenes::where('codigo_orden', '=', $codigoCompra);

      $orden->update(['tipo_tarjeta' => $tipoTarjeta]);

      $ordenid = $orden->get();
      AddressUser::where('id', $ordenid[0]['address_id'])->update([
        'dir_av_calle' => $result['dir_av_calle'],
        'dir_numero' => $result['dir_numero'],
        'dir_bloq_lote' => $result['dir_bloq_lote']
      ]);


      UserDetails::where('email', '=', $request->email)->update($result);

      return response()->json(['message' => 'Todos los datos estan correctos', 'codigoCompra' => $codigoAleatorio]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => $th], 400);
    }
  }

  private function guardarOrden()
  {
    //almacenar venta, generar orden de pedido , guardar en tabla detalle de compra, li
  }

  private function codigoVentaAleatorio()
  {
    $codigoAleatorio = '';

    // Longitud deseada del código
    $longitudCodigo = 10;

    // Genera un código aleatorio de longitud 10
    for ($i = 0; $i < $longitudCodigo; $i++) {
      $codigoAleatorio .= mt_rand(0, 9); // Agrega un dígito aleatorio al código
    }
    return $codigoAleatorio;
  }

  public function agradecimiento(Request $request)
  {
    $codigoCompra = $request->input('codigoCompra');
    $orden = $this->obtenerOrdenPorCodigo($codigoCompra);

    if ($this->esOrdenNueva($orden)) {
      $detallesOrden = $this->obtenerDetallesOrden($orden->id);
      $this->actualizarStock($detallesOrden);
      $this->marcarOrdenComoProcesada($orden);
    }

    return view('public.checkout_agradecimiento', compact('codigoCompra'));
  }

  private function obtenerOrdenPorCodigo($codigoCompra)
  {
    return Ordenes::where('codigo_orden', $codigoCompra)->first();
  }

  private function esOrdenNueva($orden)
  {
    return $orden && $orden->status_id == 1;
  }

  private function obtenerDetallesOrden($ordenId)
  {
    return DetalleOrden::where('orden_id', $ordenId)->get();
  }

  private function actualizarStock($detallesOrden)
  {
    foreach ($detallesOrden as $detalle) {
      $combinacion = $this->obtenerCombinacion($detalle->combinacion_id);
      if ($combinacion) {
        $this->reducirStock($combinacion, $detalle->cantidad);
      }
    }
  }

  private function obtenerCombinacion($combinacionId)
  {
    return Combinacion::where('id', $combinacionId)->first();
  }

  private function reducirStock($combinacion, $cantidad)
  {
    $nuevoStock = $combinacion->stock - $cantidad;
    $combinacion->update(['stock' => $nuevoStock]);
  }

  private function marcarOrdenComoProcesada($orden)
  {
    $orden->update(['status_id' => 2]);
  }

  public function cambiofoto(Request $request)
  {
    $user = User::findOrFail($request->id);

    if ($request->hasFile('image')) {
      $file = $request->file('image');
      $route = 'storage/images/users/';
      $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

      if (File::exists(storage_path() . '/app/public/' . $user->profile_photo_path)) {
        File::delete(storage_path() . '/app/public/' . $user->profile_photo_path);
      }

      $this->saveImg($file, $route, $nombreImagen);

      $routeforshow = 'images/users/';
      $user->profile_photo_path = $routeforshow . $nombreImagen;

      $user->save();

      return response()->json(['message' => 'La imagen se cargó correctamente.']);
    }
  }

  public function actualizarPerfil(Request $request)
  {
    $name = $request->name;
    $lastname = $request->lastname;
    $email = $request->email;
    $user = User::findOrFail($request->id);

    if ($request->password !== null || $request->newpassword !== null || $request->confirmnewpassword !== null) {
      if (!Hash::check($request->password, $user->password)) {
        $imprimir = 'La contraseña actual no es correcta';
        $alert = 'error';
      } else {
        $user->password = Hash::make($request->newpassword);
        $imprimir = 'Cambio de contraseña exitosa';
        $alert = 'success';
      }
    }

    if ($user->name == $name && $user->lastname == $lastname) {
      $imprimir = 'Sin datos que actualizar';
      $alert = 'question';
    } else {
      $user->name = $name;
      $user->lastname = $lastname;
      $alert = 'success';
      $imprimir = 'Datos actualizados';
    }

    $user->save();
    return response()->json(['message' => $imprimir, 'alert' => $alert]);
  }

  public function micuenta()
  {
    $user = Auth::user();
    return view('public.dashboard', compact('user'));
  }

  public function pedidos()
  {
    $user = Auth::user();

    $detalleUsuario = UserDetails::where('email', $user->email)
      ->get()
      ->toArray();

    $ordenes = Ordenes::where('usuario_id', $detalleUsuario[0]['id'])
      ->with('DetalleOrden')
      ->with('statusOrdenes')
      ->get();

    return view('public.dashboard_order', compact('user', 'ordenes'));
  }


  public function direccionFavorita(Request $request)
  {
    $item = AddressUser::find($request->id);
    if ($item) {

      AddressUser::where('user_id', $item->user_id)->update(['favorite' => 0]);
      $item->favorite = 1;
      $item->save();

      return response()->json(['message' => 'Dirección favorita modificada']);
    }

    return response()->json(['error' => 'Item no encontrado'], 404);
  }

  public function direccion()
  {
    $user = Auth::user();
    $direcciones = AddressUser::where('user_id', $user->id)->get();
    $departamentofiltro = DB::select('select * from departments where active = ? order by 2', [1]);
    $departamento = DB::select('select * from departments where active = ? order by 2', [1]);

    foreach ($direcciones as $direccion) {
      $distrito = DB::table('districts')->where('id', $direccion->distrito_id)->first();
      $provincia = DB::table('provinces')->where('id', $direccion->provincia_id)->first();
      $departamento = DB::table('departments')->where('id', $direccion->departamento_id)->first();



      $direccion->distrito_id = $distrito ? $distrito->description : '';
      $direccion->provincia_id = $provincia ? $provincia->description : '';
      $direccion->departamento_id = $departamento ? $departamento->description : '';
    }


    return view('public.dashboard_direccion', compact('user', 'direcciones', 'departamento', 'departamentofiltro'));
  }

  public function obtenerProvincia($departmentId)
  {
    $provinces = DB::select('select * from provinces where active = ? and department_id = ? order by description', [1, $departmentId]);
    return response()->json($provinces);
  }

  public function obtenerDistritos($provinceId)
  {
    $distritos = DB::select('select * from districts where active = ? and province_id = ? order by description', [1, $provinceId]);
    return response()->json($distritos);
  }

  public function guardarDireccion(Request $request)
  {

    $user = Auth::user();
    $direccion = new AddressUser();

    $direccion->departamento_id = $request->departamento_id;
    $direccion->provincia_id = $request->provincia_id;
    $direccion->distrito_id = $request->distrito_id;
    $direccion->dir_av_calle = $request->nombre_calle;
    $direccion->dir_numero = $request->numero_calle;
    $direccion->dir_bloq_lote = $request->direccion;
    $direccion->user_id = $user->id;
    $direccion->save();

    return response()->json(['message' => 'Dirección guardada exitosamente']);
  }


  public function error()
  {
    //
    return view('public.404');
  }

  public function cambioGaleria(Request $request)
  {
    $colorId = $request->id;
    $productId = $request->idproduct;

    $images =  ImagenProducto::where('color_id', $colorId)->where('product_id', $productId)->get();

    // return response()->json(['images' => $images]);
    // $productos = Products::where('id', '=', $productId)->with('attributes')->with('tags')->get();
    $tallas = Combinacion::where('color_id', $colorId)->where('product_id', $productId)->with('talla')->get();

    return response()->json(
      [
        'status' => true,
        'images' => $images,
        'tallas' => $tallas
      ],
      200,
    );
  }

  public function producto(string $id)
  {
    // $product = Products::where('id', '=', $id)->with('attributes')->with('tags')->get();
    $product = Products::findOrFail($id);
    // $colors = Products::findOrFail($id)
    //           ->with('images')
    //           ->get();

    $colors = DB::table('imagen_productos')->where('product_id', $id)->groupBy('color_id')->join('attributes_values', 'color_id', 'attributes_values.id')->get();

    $productos = Products::where('id', '=', $id)->with('attributes')->with('tags')->get();

    // $especificaciones = Specifications::where('product_id', '=', $id)->get();
    $especificaciones = Specifications::where('product_id', '=', $id)
      ->where(function ($query) {
        $query->whereNotNull('tittle')->orWhereNotNull('specifications');
      })
      ->get();
    $productosConGalerias = DB::select(
      "
            SELECT products.*, galeries.*
            FROM products
            INNER JOIN galeries ON products.id = galeries.product_id
            WHERE products.id = :productId limit 5
        ",
      ['productId' => $id],
    );

    $IdProductosComplementarios = $productos->toArray();
    $IdProductosComplementarios = $IdProductosComplementarios[0]['categoria_id'];

    $ProdComplementarios = Products::where('categoria_id', '=', $IdProductosComplementarios)->get();
    $atributos = Attributes::where('status', '=', true)->get();
    // $atributos = $product->attributes()->get();

    $valorAtributo = AttributesValues::where('status', '=', true)->get();

    $url_env = $_ENV['APP_URL'];

    return view('public.product', compact('product', 'productos', 'atributos', 'valorAtributo', 'ProdComplementarios', 'productosConGalerias', 'especificaciones', 'url_env', 'colors'));
  }

  public function liquidacion()
  {
    try {
      $liquidacion = Products::where('status', '=', 1)->where('visible', '=', 1)->where('liquidacion', '=', 1)->with('tags')->with('images')->paginate(16);

      return view('public.liquidacion', compact('liquidacion'));
    } catch (\Throwable $th) {
    }
  }

  public function novedades()
  {
    try {
      $novedades = Products::where('status', '=', 1)->where('visible', '=', 1)->where('recomendar', '=', 1)->paginate(16);

      return view('public.novedades', compact('novedades'));
    } catch (\Throwable $th) {
    }
  }

  public function searchProduct(Request $request)
  {
    $query = $request->input('query');
    $resultados = Products::where('producto', 'like', "%$query%")
      ->with([
        'images' => function ($query) {
          $query->where('caratula', 1);
        }

      ])->get();

    return response()->json($resultados);
  }

  public function librodereclamaciones()
  {
    $departamentofiltro = DB::select('select * from departments where active = ? order by 2', [1]);
    $general = General::all()->first();
    return view('public.librodereclamaciones', compact('departamentofiltro', 'general'));
  }
  //  --------------------------------------------
  /**
   * Show the form for creating a new resource.
   */
  public function politicaDeCambio()
  {
    // 
    $politicasCambio =  DB::select('select * from politicas_de_cambio  limit 1');
    return view("public.politicadeCambio", compact('politicasCambio'));
  }
  public function pliticaDeEnvio()
  {
    // 
    $politicasEnvio =  DB::select('select * from politicas_de_envio  limit 1');
    return view("public.politicasdeenvio", compact('politicasEnvio'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreIndexRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Index $index)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Index $index)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateIndexRequest $request, Index $index)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Index $index)
  {
    //
  }

  /**
   * Save contact from blade
   */
  public function guardarContacto(Request $request)
  {
    $data = $request->all();
    $data['full_name'] = $request->name . ' ' . $request->last_name;

    try {
      $reglasValidacion = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
      ];
      $mensajes = [
        'name.required' => 'El campo nombre es obligatorio.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo electrónico no es válido.',
        'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
      ];
      $request->validate($reglasValidacion, $mensajes);
      $formlanding = Message::create($data);
      $this->envioCorreo($formlanding);

      return response()->json(['message' => 'Mensaje enviado con exito']);
    } catch (ValidationException $e) {
      return response()->json(['message' => $e->validator->errors()], 400);
    }
  }

  public function guardarContactosLanding(Request $request)
  {
    $data = $request->all();
    
    try {
      $reglasValidacion = [
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
      ];
      $mensajes = [
        'full_name.required' => 'El campo nombre es obligatorio.',
        'email.required' => 'El campo correo electrónico es obligatorio.',
        'email.email' => 'El formato del correo electrónico no es válido.',
        'email.max' => 'El campo correo electrónico no puede tener más de :max caracteres.',
      ];
      $request->validate($reglasValidacion, $mensajes);
      $formlanding = Message::create($data);
      // $this->envioCorreo($formlanding);

      return response()->json(['message' => 'Mensaje enviado con exito']);
    } catch (ValidationException $e) {
      return response()->json(['message' => $e->validator->errors()], 400);
    }
  }

  public function saveImg($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img = $manager->read($file);

    if (!file_exists($route)) {
      mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
    }
    $img->save($route . $nombreImagen);
  }

  private function envioCorreo($data)
  {
    $name = $data['full_name'];
    $mail = EmailConfig::config();
    try {
      $mail->addAddress($data['email']);
      $mail->Body = "Hola $name su mensaje fue enviado con exito. En breve un asesor se comunicara con usted.";
      $mail->isHTML(true);
      $mail->send();
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  private function envioCorreoCompra($data)
  {
    $name = $data['nombre'];
    $mail = EmailConfig::config();
    try {
      $mail->addAddress($data['email']);
      $mail->Body = "Hola $name su pedido fue realizado.";
      $mail->isHTML(true);
      $mail->send();
    } catch (\Throwable $th) {
      //throw $th;
    }
  }

  public function procesarCarrito(Request $request)
  {
    $primeraVez = false;




    try {
      $codigoOrden = $this->codigoVentaAleatorio();
      $jsonMonto = json_decode($request->total, true);
      $montoT = $jsonMonto['total'];
      $subMonto = $jsonMonto['suma'];

      $precioEnvio = $montoT - $subMonto;
      $email = $request->email;


      $usuario = UserDetails::where('email', '=', $email)->get(); // obtenemos usuario para validarlo si no agregarlo

      //si tiene usuario registrad

      if (!$usuario->isNotEmpty()) {
        $usuario = UserDetails::create(['email' => $email]);
        $primeraVez = true;
      }

      $addres = AddressUser::create([
        'departamento_id' => (int)$request->departamento,
        'provincia_id' => (int)$request->provincia,
        'distrito_id' => (int)$request->distrito,
        'user_id' => $usuario[0]['id']
      ]);
      $this->GuardarOrdenAndDetalleOrden($codigoOrden, $montoT, $precioEnvio, $usuario, $request->carrito, $addres);


      $formToken = $this->generateFormTokenIzipay($montoT, $codigoOrden, $email);

      //
      return response()->json(['mensaje' => 'Orden generada correctamente', 'formToken' => $formToken, 'codigoOrden' => $codigoOrden, 'primeraVez' => $primeraVez]);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['mensaje' => "Intente de nuevo mas tarde , estamos trabajando en una solucion , $th"], 400);
    }
  }
  private function GuardarOrdenAndDetalleOrden($codigoOrden, $montoT, $precioEnvio, $usuario, $carrito, $addres)
  {

    $data['codigo_orden'] = $codigoOrden;
    $data['monto'] = $montoT;
    $data['precio_envio'] = $precioEnvio;
    $data['status_id'] = '1';
    $data['usuario_id'] = $usuario[0]['id'];
    $data['address_id'] = $addres['id'];

    $orden = Ordenes::create($data);

    //creamos detalle de orden
    foreach ($carrito as $key => $value) {

      DetalleOrden::create([
        'producto_id' => $value['id'],
        'cantidad' => $value['cantidad'],
        'orden_id' => $orden->id,
        'precio' => $value['precio'],
        'combinacion_id' => $value['combinacionId']
      ]);
    }
  }

  public function politicasDevolucion()
  {
    $politicDev = PolyticsCondition::first();
    return view('public.politicasdevolucion', compact('politicDev'));
  }

  public function TerminosyCondiciones()
  {
    $termsAndCondicitions = TermsAndCondition::first();
    return view('public.terminosycondiciones', compact('termsAndCondicitions'));
  }

  public function landing()
  {
    return view('public.landing.setmadrid');
  }
}
