@extends('components.public.matrix')
@section('title', 'Novedades | ' . config('app.name', 'Laravel'))

@section('css_importados')

@stop


@section('content')



  <main class="bg-bgBlack -mb-12">
    <section class="uppercase italic text-white">
      <div class="w-full md:w-1/2 mx-auto text-center">
        <div class="flex justify-center items-center relative">
          <img src="{{ asset('images/img/anio_24.png') }}" alt="doomine" />

          <div class="absolute flex flex-col justify-center items-center ">
            <h2 class="font-boldItalicDisplay text-text40 md:text-text64 xl:text-text68">
              New Arrivals
            </h2>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="hidden md:block">
        <img src="{{ asset('images/img/colection_1.png') }}" alt="colection" class="w-full h-full" />
      </div>

      <div class="block md:hidden">
        <img src="{{ asset('images/img/colection_2.png') }}" alt="colection" class="w-full h-full" />
      </div>
    </section>

    <section class="w-11/12 mx-auto flex flex-col gap-10 py-12">
      <div class="flex justify-between items-center uppercase">
        {{-- <h3 class="font-boldItalicDisplay text-text24 xl:text-text28 text-textWhite uppercase">
                    @if ($filtro == 0)
                             Todas las colecciones
                    @else
                             {{$collection->description}}
                    @endif
                </h3> --}}
      </div>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-5 text-white pb-5">

        @foreach ($novedades as $item)
          <div class="md:col-span-1 md:row-span-1 flex flex-col gap-5 relative">
            <div class="product_container">
              @foreach ($item->images as $image)
                @if ($image->caratula == 1)
                  <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
                    class="w-full h-full hover:scale-110 transition-all duration-300" />
                @endif
              @endforeach

              <div class="addProduct text-center flex justify-center">
                <a href="{{ route('producto', $item->id) }}"
                  class="leading-none font-mediumDisplay text-text12 md:text-text14 bg-[#000000] px-1 py-2 md:py-2 lg:px-5 flex-initial w-32 md:w-36 lg:py-3 lg:w-52 text-center text-white rounded-3xl xl:text-text20 xl:w-60">
                  Ver producto
                </a>
              </div>
            </div>

            <div class="flex flex-col gap-2">
              <div
                class="flex flex-col lg:flex-row md:justify-between font-boldDisplay text-textWhite gap-2 order-2 lg:order-1">
                <p class="text-text14 md:text-text16 xl:text-text20">
                  {{ $item->producto }}
                </p>
                <div class="flex justify-between font-boldDisplay items-center gap-2">
                  @if ($item->descuento == 0)
                    <p class="text-text14 md:text-text16 xl:text-text20">
                      s/{{ $item->precio }}
                    </p>
                  @else
                    <p class="text-text14 md:text-text16 xl:text-text20">
                      s/{{ $item->descuento }}
                    </p>
                    <p class="text-text10 md:text-text16 line-through text-gray-400 font-mediumDisplay xl:text-text18">
                      s/{{ $item->precio }}
                    </p>
                  @endif
                </div>
              </div>

              <div class="order-1 lg:order-2">
                <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textWhite">
                  @if (!is_null($item->categoria) && !is_null($item->categoria->name))
                    {{ $item->categoria->name }}
                  @else
                    S/C
                  @endif
                </p>
              </div>
            </div>

            <div class="absolute top-[10px] left-[10px] md:top-[20px] md:left-[20px]">
              <div class="flex gap-3 flex-wrap">
                @foreach ($item->tags as $tag)
                  <div class="bg-white  rounded-md py-1 px-2 hidden">
                    <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack ">
                      {{ $tag->name }}
                    </p>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        @endforeach


      </div>

      <div class="flex  justify-center items-center">
        {{-- <a href="#"
                    class="border-[1.5px] border-white rounded-full py-4 px-16 text-white font-mediumDisplay text-text14">Cargar
                    más modelos</a> --}}
        {{ $novedades->links() }}
      </div>
    </section>
  </main>



@section('scripts_importados')
  <script>
    var appUrl = '{{ env('APP_URL') }}';

    // Agrega más variables de entorno aquí según sea necesario
  </script>


  <script src="{{ asset('js/carrito.js') }}"></script>
@stop

@stop
