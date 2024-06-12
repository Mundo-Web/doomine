@extends('components.public.matrix')

@section('css_importados')

@stop


@section('content')

  <main class="flex flex-col gap-12">
    <!------Slider Header ------>
    @if ($slider->isEmpty())
      {{-- <div class="w-full flex flex-row justify-center items-center">
                <div class="p-5 text-xl font-bold">No tienes sliders visibles</div>
            </div> --}}
    @else
      @foreach ($slider as $item)
        <section>
          <div class="w-full md:w-11/12 mx-auto relative z-0">
            <div class="grid grid-cols-1 md:grid-cols-2">
              <div class="flex justify-center items-center">
                <img src="{{ asset($item->url_image . $item->name_image) }}" alt="domine summer" class="w-full h-full" />
              </div>

              <div class="hidden md:flex justify-center items-center">
                <img src="{{ asset($item->url_image2 . $item->name_image2) }}" alt="domine summer" class="w-full h-full" />
              </div>
            </div>

            <div class="absolute inset-0 flex items-center justify-center text-textWhite">
              <div class="flex flex-col w-full md:w-2/3 lg:w-1/2">
                <p
                  class="font-mediumDisplay text-text16 md:text-text20 lg:text-text24 xl:text-text36 italic leading-none w-5/6 mx-auto md:w-full md:mx-0">
                  {{ $item->subtitle }}
                </p>
                <p
                  class="uppercase font-regularDisplay text-text40 md:text-text48 lg:text-text60 xl:text-text80 italic leading-none w-full md:w-5/6 mx-auto lg:w-full md:mx-0 text-center md:text-left">
                  {{ $item->title2 }}
                </p>
                <div class="w-5/6 mx-auto text-center md:text-left flex flex-col gap-5 lg:gap-10">
                  <h1
                    class="font-boldDisplay text-text68 md:text-text80 lg:text-text100 xl:text-text135 italic leading-none uppercase">
                    {{ $item->title }}
                  </h1>

                  <div class="lg:w-10/12 mx-auto text-center">
                    <p class="font-regularDisplay text-text16 xl:text-text20">
                      {{ $item->description }}
                    </p>
                  </div>
                </div>

                <div class="text-center mt-5 lg:mt-10">
                  @if (!empty($item->botontext1))
                    <a href="{{ $item->link1 }}"
                      class="font-boldDisplay text-text16 xl:text-text24 italic inline-flex justify-center items-center py-2 px-5 border-2 border-white rounded-3xl max-w-xs gap-5 group hover:bg-bgWhite hover:text-textBlack md:duration-500">
                      <span>{{ $item->botontext1 }}</span>
                      <div>
                        <svg width="40" height="40" viewBox="0 0 32 32" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <circle cx="16.0004" cy="16" r="15.1928" transform="rotate(3.13121 16.0004 16)"
                            fill="white" class="group-hover:fill-bgBlack md:duration-500" />
                          <path
                            d="M16.8349 12.6311L19.8902 16.2119M19.8902 16.2119L16.4626 19.4382M19.8902 16.2119L12.1107 15.7864"
                            stroke="black" stroke-width="1.55824" stroke-linecap="round" stroke-linejoin="round"
                            class="group-hover:stroke-strokeWithe md:duration-500" />
                        </svg>
                      </div>
                    </a>
                  @endif
                </div>
              </div>
            </div>
          </div>
        </section>
      @endforeach
    @endif

    @if ($category->isEmpty())
      {{-- <div class="w-full flex flex-row justify-center items-center">
                <div class="p-5 text-xl font-bold">No tienes categorías visibles</div>
            </div> --}}
    @else
      <section class="w-11/12 mx-auto flex flex-col gap-10">
        <div class="flex justify-between items-center uppercase">
          <h3 class="font-boldItalicDisplay text-text18 md:text-text24 xl:text-text28">
            Categorías
          </h3>
          <div>
            <a href="{{ route('catalogo', 0) }}"
              class="font-boldItalicDisplay text-text18 md:text-text24 xl:text-text28 uppercase">/ Ver Todo
              /</a>
          </div>
        </div>

        @if (count($category->take(4)) == 1)
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach ($category->take(1) as $index => $item)
              <div class="col-span-1 md:col-span-2 row-span-1  flex flex-col justify-between">
                <div class="product_container">
                  @if ($item->name_image)
                    <img src="{{ asset($item->url_image . $item->name_image) }}" alt="{{ $item->name }}"
                      class="w-full h-[270px] md:h-[500px] object-cover" />
                  @else
                    <img src="{{ asset('images/img/noimagen.jpg') }}" alt="imagen_alternativa"
                      class="w-full h-[270px] md:h-[500px] object-cover" />
                  @endif
                  <div class="addProduct text-center flex justify-center">
                    <a href="{{ route('catalogo', $item->id) }}"
                      class="leading-none font-mediumDisplay text-text12 md:text-text14 bg-[#000000] px-1 py-2 md:py-2 2lg:px-5 flex-initial w-32 md:w-36 2lg:py-3 2lg:w-52 text-center text-white rounded-3xl xl:text-text20 xl:w-60">
                      Ver Categoria
                    </a>
                  </div>
                </div>
                <div class="flex flex-col justify-center text-black italic">
                  <h3 class="font-mediumItalicDisplay text-text16 xl:text-text20">
                    Categoría
                  </h3>
                  <a href="{{ route('catalogo', $item->id) }}">
                    <p class="font-boldItalicDisplay text-text24 md:text-text28 uppercase xl:text-text32">
                      {{ $item->name }}
                    </p>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        @elseif(count($category->take(4)) == 2)
          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            @foreach ($category->take(2) as $index => $item)
              <div class="col-span-1 row-span-1  flex flex-col justify-between">
                <div class="product_container">
                  @if ($item->name_image)
                    <img src="{{ asset($item->url_image . $item->name_image) }}" alt="{{ $item->name }}"
                      class="w-full h-[270px] md:h-[500px] object-cover" />
                  @else
                    <img src="{{ asset('images/img/noimagen.jpg') }}" alt="imagen_alternativa"
                      class="w-full h-[270px] md:h-[500px] object-cover" />
                  @endif
                  <div class="addProduct text-center flex justify-center">
                    <a href="{{ route('catalogo', $item->id) }}"
                      class="leading-none font-mediumDisplay text-text12 md:text-text14 bg-[#000000] px-1 py-2 md:py-2 2lg:px-5 flex-initial w-32 md:w-36 2lg:py-3 2lg:w-52 text-center text-white rounded-3xl xl:text-text20 xl:w-60">
                      Ver Categoria
                    </a>
                  </div>
                </div>
                <div class="flex flex-col justify-center text-black italic">
                  <h3 class="font-mediumItalicDisplay text-text16 xl:text-text20">
                    Categoría
                  </h3>
                  <a href="{{ route('catalogo', $item->id) }}">
                    <p class="font-boldItalicDisplay text-text24 md:text-text28 uppercase xl:text-text32">
                      {{ $item->name }}
                    </p>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        @elseif(count($category->take(4)) == 3)
          <div class="grid grid-cols-1 md:grid-cols-2 md:grid-rows-2 gap-5">
            @foreach ($category->take(3) as $index => $item)
              <div
                class="col-span-1 @if ($loop->iteration == 2) row-span-2 @else row-span-1 @endif flex flex-col justify-between">
                <div class="product_container">
                  @if ($item->name_image)
                    <img src="{{ asset($item->url_image . $item->name_image) }}" alt="{{ $item->name }}"
                      class="w-full h-[270px]  @if ($loop->iteration == 2) md:h-full @else md:h-[500px] @endif object-cover object-top" />
                  @else
                    <img src="{{ asset('images/img/noimagen.jpg') }}" alt="imagen_alternativa"
                      class="w-full h-[270px]  @if ($loop->iteration == 2) md:h-full @else md:h-[500px] @endif object-cover object-top" />
                  @endif
                  <div class="addProduct text-center flex justify-center">
                    <a href="{{ route('catalogo', $item->id) }}"
                      class="leading-none font-mediumDisplay text-text12 md:text-text14 bg-[#000000] px-1 py-2 md:py-2 2lg:px-5 flex-initial w-32 md:w-36 2lg:py-3 2lg:w-52 text-center text-white rounded-3xl xl:text-text20 xl:w-60">
                      Ver Categoria
                    </a>
                  </div>
                </div>
                <div class="flex flex-col justify-center text-black italic">
                  <h3 class="font-mediumItalicDisplay text-text16 xl:text-text20">
                    Categoría
                  </h3>
                  <a href="{{ route('catalogo', $item->id) }}">
                    <p class="font-boldItalicDisplay text-text24 md:text-text28 uppercase xl:text-text32">
                      {{ $item->name }}
                    </p>
                  </a>
                </div>
              </div>
            @endforeach
          </div>

        @endif
      </section>
    @endif

    @if ($newarrival->isEmpty())
      {{-- <div class="w-full flex flex-row justify-center items-center">
                <div class="p-5 text-xl font-bold">No tienes productos visibles</div>
            </div> --}}
    @else
      <section class="w-11/12 mx-auto flex flex-col gap-10" id="new_arrivals">
        <div class="flex justify-between items-center uppercase">
          <h3 class="font-boldItalicDisplay text-text18 md:text-text24 xl:text-text28 uppercase">
            New Arrivals
          </h3>
          <div>
            <a href="{{ route('novedades', 0) }}"
              class="font-boldItalicDisplay text-text18 md:text-text24 xl:text-text28 uppercase">/ Ver Todo
              /</a>
          </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
          @foreach ($newarrival->take(4) as $item)
            <div class="md:col-span-1 md:row-span-1 flex flex-col gap-5 relative">
              <div class="product_container">
                {{-- <img src="{{ asset($item->imagen) }}" alt="{{ $item->name }}" class="w-full h-full" /> --}}
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
                  class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                  <a href="{{ route('producto', $item->id) }}" class="text-text14 md:text-text16 xl:text-text20">
                    {{ $item->producto }}
                  </a>
                  <div class="flex font-boldDisplay text-black items-center gap-2">
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
                  <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
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
                  @if (!is_null($item->tags))
                    @foreach ($item->tags as $tag)
                      <div class="bg-white  rounded-md py-1 px-2">
                        <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack ">
                          {{ $tag->name }}
                        </p>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </section>
    @endif
    @if ($liquidacion->isEmpty())
    @else
      @foreach ($liquidacion as $item)
        <section class="w-11/12 mx-auto flex flex-col gap-10">
          <div class="relative">
            <img src="{{ asset($item->url_image . $item->name_image) }}" alt="{{ $item->name_image }}"
              class="w-full h-full hidden md:block" />

            <img src="{{ asset($item->url_image . $item->name_image) }}" alt="{{ $item->name_image }}"
              class="w-full h-full block md:hidden" />
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-textWhite w-[80%]">
              <div class="w-11/12 mx-auto">
                <h3
                  class="font-boldItalicDisplay text-text32 md:text-text64 uppercase xl:text-text68 leading-none md:leading-tight text-center">
                  {{ $item->title }}
                </h3>
                <p class="font-regularDisplay text-text14 xl:text-text20 text-center w-full md:w-2/3 mx-auto">
                  {{ $item->description }}
                </p>

                <div class="flex justify-center items-center pt-10">
                  <a href="{{ route('liquidacion') }}"
                    class="font-boldItalicDisplay text-text16 md:text-text24 xl:text-text32 uppercase">/
                    {{ $item->botontext1 }} /</a>
                </div>
              </div>
            </div>
          </div>
        </section>
      @endforeach
    @endif


    @if ($destacados->isEmpty())
      {{-- <div class="w-full flex flex-row justify-center items-center">
               <div class="p-5 text-xl font-bold">No tienes productos visibles</div>
           </div> --}}
    @else
      <section class="w-11/12 mx-auto flex flex-col gap-10">
        <div class="flex justify-between items-center uppercase">
          <h3 class="font-boldItalicDisplay text-text18 md:text-text24 xl:text-text28 uppercase">
            Lo más pedido
          </h3>
          {{-- <div>
            <a href="{{ route('catalogo', 0) }}"
              class="font-boldItalicDisplay text-text18 md:text-text24 xl:text-text28 uppercase">/ Ver Todo
              /</a>
          </div> --}}
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4  gap-5">
          @foreach ($destacados->take(4) as $item)
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
                  class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                  <a href="{{ route('producto', $item->id) }}" class="text-text14 md:text-text16 xl:text-text20">
                    {{ $item->producto }}
                  </a>
                  <div class="flex font-boldDisplay text-black items-center gap-2">
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
                  <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
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
                    <div class="bg-white  rounded-md py-1 px-2">
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
      </section>
    @endif
  </main>

@section('scripts_importados')
  <script></script>
  <script>
    var appUrl = '{{ env('APP_URL') }}';

    // Agrega más variables de entorno aquí según sea necesario
  </script>


  <script src="{{ asset('js/carrito.js') }}"></script>
@stop

@stop
