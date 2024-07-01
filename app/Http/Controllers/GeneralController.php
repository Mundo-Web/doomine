<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneralRequest;
use App\Http\Requests\UpdateGeneralRequest;
use App\Models\General;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;


class GeneralController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //llames a los registros para mostrarlos en tabla


  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //El formjulario para crear
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreGeneralRequest $request)
  {
    //este es el proceso que crea
  }

  /**
   * Display the specified resource.
   */
  public function show(General $general)
  {
    //este es el que muestra
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(General $general)
  {
    //El que muestra el form para editar
    //return "mostrar el unico registro";

    $general = General::find(1);

    // if (!$general) {
    //     return redirect()->back()->with('error', 'El registro no existe');
    // }


    return view('pages.general.edit', compact('general'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, $id)
  {
    $data = $request->all();
    dump($data);
    try {
      if ($request->hasFile("img_login")) {
        $file = $request->file('img_login');
        $routeImg = 'storage/images/productos/';
        $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

        $this->saveImg($file, $routeImg, $nombreImagen);

        $data['img_login'] = $routeImg . $nombreImagen;
        // $AboutUs->name_image = $nombreImagen;
      }

      if (isset($data['is_active_discount'])) {
        if ($data['is_active_discount'] == 'on') {
          $data['is_active_discount'] = true;
        }
      } else {
        $data['is_active_discount'] = false;
      }

      $general = General::findOrfail($id);


      // Actualizar los campos del registro con los datos del formulario
      $general->update($data);

      // Guardar 
      $general->save();

      return back()->with('success', 'Registro actualizado correctamente');
    } catch (\Throwable $th) {
      //throw $th;
      dump ($th) ; 
    }
  }
  public function saveImg($file, $route, $nombreImagen)
  {
    $manager = new ImageManager(new Driver());
    $img =  $manager->read($file);
    $img->coverDown(900, 900, 'center');

    if (!file_exists($route)) {
      mkdir($route, 0777, true);
    }

    $img->save($route . $nombreImagen);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(General $general)
  {
    //Este es el proceso que borra
  }

  public function updateJson(Request $request)
  {
    try {
      // Ruta del archivo JSON
      $route = resource_path('views/pages/general/newArrials.json');

      // Leer el contenido del archivo
      $file = File::get($route);
      $archivoArray = json_decode($file, true);

      // Actualizar valores json 
      $archivoArray['newArribals']['FondoNum'] = $request->numFondo;
      $archivoArray['newArribals']['titulo'] = $request->textoPrincipal;


      // Guardar los cambios en el archivo JSON

      File::put($route, json_encode($archivoArray, JSON_PRETTY_PRINT));

      return response()->json(['message' => 'Json Actualizado']);
    } catch (\Throwable $th) {
      //throw $th;
      return response()->json(['message' => $th], 400);
    }
  }
}
