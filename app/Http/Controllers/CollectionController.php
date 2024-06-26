<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $collection = Collection::where('status', '=', true)->get();

        return view('pages.collection.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.collection.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function saveImg($file, $route, $nombreImagen)
     {
         $manager = new ImageManager(new Driver());
         $img = $manager->read($file);
         $img->coverDown(1344, 487, 'center');
         if (!file_exists($route)) {
             mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
         }
         $img->save($route . $nombreImagen);
     }


     public function saveImg2($file, $route, $nombreImagen)
     {
         $manager = new ImageManager(new Driver());
         $img = $manager->read($file);
         $img->coverDown(343, 495, 'center');
         if (!file_exists($route)) {
             mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
         }
         $img->save($route . $nombreImagen);
     }


    public function store(Request $request)
    {
        $collection = new Collection();

        if ($request->hasFile('imagen')) {
           
            $file = $request->file('imagen');
            $routeImg = 'storage/images/collection/';
            $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

            $this->saveImg($file, $routeImg, $nombreImagen);

            $collection->url_image = $routeImg;
            $collection->name_image = $nombreImagen;
        }else {
            $routeImg = 'images/img/';
            $nombreImagen = 'noimagencoleccion.jpg';

            $collection->url_image = $routeImg;
            $collection->name_image = $nombreImagen;
        }

        if ($request->hasFile('imagen2')) {
           
            $file = $request->file('imagen2');
            $routeImg = 'storage/images/collection/';
            $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

            $this->saveImg2($file, $routeImg, $nombreImagen);

            $collection->url_image2 = $routeImg;
            $collection->name_image2 = $nombreImagen;
        }else {
            $routeImg = 'images/img/';
            $nombreImagen = 'noimagencoleccion.jpg';

            $collection->url_image2 = $routeImg;
            $collection->name_image2 = $nombreImagen;
        }

        $slug = strtolower(str_replace(' ', '-', $request->name));

        if (Collection::where('slug', $slug)->exists()) {
            $slug .= '-' . rand(1, 1000);
        }

        $collection->name = $request->name;
        $collection->description = $request->description;
        $collection->slug = $slug;
        $collection->number = $request->number;
        $collection->status = 1;
        $collection->visible = 1;

        $collection->save();

        return redirect()->route('colecciones.index')->with('success', 'Colección creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection, $id)
    {
        $collection = Collection::findOrfail($id);

        return view('pages.collection.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $collection = Collection::findOrfail($id);

        if ($request->hasFile('imagen')) {
           
            $file = $request->file('imagen');
            $routeImg = 'storage/images/categories/';
            $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

            if ($collection->url_image !== 'images/img/') {
                File::delete($collection->url_image . $collection->name_image);
            }    
          
            $this->saveImg($file, $routeImg, $nombreImagen);

            $collection->url_image = $routeImg;
            $collection->name_image = $nombreImagen;
        }


        if ($request->hasFile('imagen2')) {
           
            $file = $request->file('imagen2');
            $routeImg = 'storage/images/categories/';
            $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

            if ($collection->url_image !== 'images/img/') {
                File::delete($collection->url_image2 . $collection->name_image2);
            }    
          
            $this->saveImg2($file, $routeImg, $nombreImagen);

            $collection->url_image2 = $routeImg;
            $collection->name_image2 = $nombreImagen;
        }

        $slug = strtolower(str_replace(' ', '-', $request->name));

        if (Collection::where('slug', $slug)->exists()) {
            $slug .= '-' . rand(1, 1000); 
        }

        $collection->name = $request->name;
        $collection->description = $request->description;
        $collection->slug = $slug;
       
        $collection->number = $request->number;


        $collection->save();

        return redirect()->route('colecciones.index')->with('success', 'Colección modificada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        //
    }



    public function deleteCollection(Request $request)
    {
        $id = $request->id;
       
        $category = Collection::findOrfail($id); 
       
        $category->status = false;
       
        $category->save();

        return response()->json(['message' => 'Colección eliminada']);
    }


    
    public function updateVisible(Request $request)
    {
 
        $id = $request->id;

        $field = $request->field;

        $status = $request->status;

        // Actualizar el estado de la categoría
        $category = Collection::findOrFail($id);

        $category->$field = $status;

        $category->save();
        
        return response()->json(['message' => 'Colección modificada']);
    
    }
}
