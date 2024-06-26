<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;



class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slider = Slider::where('status', '=', true)->get();

        return view('pages.sliders.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   

        $request->validate([
            'imagen' => 'required',
            'imagen2' => 'required',
        ]);
    

        $slider = new Slider();

        try {
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $routeImg = 'storage/images/slider/';
                $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

                $this->saveImg($file, $routeImg, $nombreImagen);

                $slider->url_image = $routeImg;
                $slider->name_image = $nombreImagen;
            } else {
                $routeImg = 'images/img/';
                $nombreImagen = 'noimagenslider.jpg';

                $slider->url_image = $routeImg;
                $slider->name_image = $nombreImagen;
            }

            if ($request->hasFile('imagen2')) {
                $file = $request->file('imagen2');
                $routeImg = 'storage/images/slider/';
                $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

                $this->saveImg($file, $routeImg, $nombreImagen);

                $slider->url_image2 = $routeImg;
                $slider->name_image2 = $nombreImagen;
            } else {
                $routeImg = 'images/img/';
                $nombreImagen = 'noimagenslider.jpg';

                $slider->url_image2 = $routeImg;
                $slider->name_image2 = $nombreImagen;
            }

            $slider->subtitle = $request->subtitle;
            $slider->title2 = $request->title2;
            $slider->botontext1 = $request->botontext1;
            $slider->link1 = $request->link1;
            $slider->botontext2 = $request->botontext2;
            $slider->link2 = $request->link2;
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->visible = true;

            $slider->save();

            return redirect()->route('slider.index')->with('success', 'Slider creado exitosamente.');
        } catch (\Throwable $th) {
            return response()->json(['messge' => 'Verifique sus datos '], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('pages.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrfail($id);

        try {
            if ($request->hasFile('imagen')) {
                $file = $request->file('imagen');
                $routeImg = 'storage/images/slider/';
                $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

                if ($slider->url_image !== 'images/img/') {
                    File::delete($slider->url_image . $slider->name_image);
                }

                $this->saveImg($file, $routeImg, $nombreImagen);

                $slider->url_image = $routeImg;
                $slider->name_image = $nombreImagen;
            }

            if ($request->hasFile('imagen2')) {
                $file = $request->file('imagen2');
                $routeImg = 'storage/images/slider/';
                $nombreImagen = Str::random(10) . '_' . $file->getClientOriginalName();

                if ($slider->url_image2 !== 'images/img/') {
                    File::delete($slider->url_image2 . $slider->name_image2);
                }

                $this->saveImg($file, $routeImg, $nombreImagen);

                $slider->url_image2 = $routeImg;
                $slider->name_image2 = $nombreImagen;
            }

            $slider->subtitle = $request->subtitle;
            $slider->title2 = $request->title2;
            $slider->title = $request->title;
            $slider->description = $request->description;
            $slider->botontext1 = $request->botontext1;
            $slider->link1 = $request->link1;
            $slider->botontext2 = $request->botontext2;
            $slider->link2 = $request->link2;

            $slider->update();

            return redirect()->route('slider.index')->with('success', 'Slider modificado exitosamente.');
        } catch (\Throwable $th) {
            return response()->json(['messge' => 'Verifique sus datos '], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        //
    }

    public function saveImg($file, $route, $nombreImagen)
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($file);
        $img->coverDown(672, 700, 'center');
        if (!file_exists($route)) {
            mkdir($route, 0777, true); // Se crea la ruta con permisos de lectura, escritura y ejecución
        }
        $img->save($route . $nombreImagen);
    }

    public function deleteSlider(Request $request)
    {
        //Recupero el id mandado mediante ajax
        $id = $request->id;
        //Busco el servicio con id como parametro
        $service = Slider::findOrfail($id);
        //Modifico el status a false
        $service->status = false;
        //Guardo
        $service->save();

        // Devuelvo una respuesta JSON u otra respuesta según necesites
        return response()->json(['message' => 'Slider eliminado.']);
    }

    public function updateVisible(Request $request)
    {
        $cantidad = $this->contarSliderVisible();

        /* if ($cantidad >= 1 && $request->status == 1) {
            return response()->json(['message' => 'Solo puedes hacer visible 1 slider'], 409);
        } */

        $id = $request->id;
        $field = $request->field;
        $status = $request->status;
        $service = Slider::findOrFail($id);
        $service->$field = $status;
        $service->save();

        $cantidad = $this->contarSliderVisible();

        return response()->json(['message' => 'Slider eliminado', 'cantidad' => $cantidad]);
    }

    public function contarSliderVisible()
    {
        $cantidad = Slider::where('visible', '=', 1)->count();
        return $cantidad;
    }
}
