@extends('components.public.matrix')
@section('title', 'Productos Detalle | ' . config('app.name', 'Laravel'))
@section('css_importados')
@stop
@section('content')
  <?php
  
  function capitalizeFirstLetter($string)
  {
      return ucfirst($string);
  }
  ?>

  <main class="flex flex-col gap-12 mt-12">
    {{-- <section class="flex gap-2 items-center w-11/12 mx-auto">
            <a href="#" class="font-regularDisplay text-text14 md:text-text24 text-gray-500">Home</a>
            <div>
                <img src="{{asset('images/svg/flecha.svg')}}" alt="doomine" />
            </div>

            <a href="#" class="font-regularDisplay text-text14 md:text-text24 text-gray-500">Categorías</a>
            <div>
                <img src="{{asset('images/svg/flecha.svg')}}" alt="doomine" />
            </div>

            <a href="#" class="font-regularDisplay text-text14 md:text-text24 text-gray-500">Vestidos</a>
            <div>
                <img src="{{asset('images/svg/flecha.svg')}}" alt="doomine" />
            </div>
            <a href="#" class="font-mediumDisplay text-text14 md:text-text24 text-black">Vestido Kim</a>
        </section> --}}

    <section class="w-11/12 mx-auto">
      <div class="flex flex-col gap-12 lg:flex-row md:gap-32">
        <div class="basis-3/6 grid grid-cols-1 gap-5 " id="imageContainer_uno">

        </div>
        <div class="basis-3/6 grid grid-cols-2 gap-5 " id="imageContainer">
          {{-- <div class="flex flex-col gap-5 relative">
                     
                        @foreach ($productos[0]->images as $image)
                            @if ($image->caratula == 1)
                                <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
                                    class="w-full object-cover " />
                            @endif
                        @endforeach

                        <div class="absolute top-[10px] left-[10px] md:top-[20px] md:left-[20px]">
                            <div class="flex gap-3 flex-wrap">
                                @foreach ($productos[0]->tags as $tag)
                                    <div class="bg-white  rounded-md py-1 px-2">
                                        <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack ">
                                            {{ $tag->name }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                    @foreach ($productos[0]->images as $image)
                        @if ($image->caratula == 0 && $image->color_id == 1)
                            <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
                                class="w-full object-cover " />
                        @endif
                    @endforeach --}}

        </div>

        <div class="basis-3/6 text-textBlack flex flex-col gap-10">
          <div class="flex flex-col gap-1">
            <p class="font-mediumDisplay text-text16 md:text-text18">
              Categoría: @if (!is_null($productos[0]->categoria) && !is_null($productos[0]->categoria->name))
                {{ $productos[0]->categoria->name }}
              @else
                S/C
              @endif
            </p>
            <div class="flex justify-between">
              <h3 class="font-mediumDisplay text-text32 md:text-text36">
                {{ $productos[0]->producto }}
              </h3>
              <div class="flex justify-between text-black items-center gap-2">
                @if ($productos[0]->descuento == 0)
                  <p class="text-text14 md:text-text20 font-boldDisplay">
                    s/{{ $productos[0]->precio }}
                  </p>
                @else
                  <p class="text-text14 md:text-text20 font-boldDisplay">
                    s/{{ $productos[0]->descuento }}
                  </p>
                  <p class="text-text10 md:text-text16 line-through text-gray-400 font-mediumDisplay">
                    s/{{ $productos[0]->precio }}
                  </p>
                @endif
              </div>
            </div>
          </div>

          <div class="flex flex-col gap-3">
            @if ($colors->isNotEmpty())
              <p class="font-mediumDisplay text-text16 md:text-text20 pb-4">
                Selecciona color:
              </p>
              <div class="flex gap-5 justify-start items-center">
                {{-- @foreach ($colors as $item) --}}
                @foreach ($colors as $index => $item)
                  <div id="colorItem" style="background-color: {{ $item->color }}"
                    class="colors w-14 h-14 rounded-[50%] cursor-pointer transition {{ $index == 0 ? 'color' : '' }}"
                    data-id="{{ $item->id }}" data-productid="{{ $item->product_id }}"></div>
                @endforeach
              </div>
            @endif



            <div>


              <p class="font-mediumDisplay text-text16 md:text-text20 pb-4" id="textoseleccionartalla">
                Selecciona talla:
              </p>

              <div class="grid grid-cols-3 place-items-center font-regularDisplay text-text14 md:text-text20 gap-2"
                id="llenadoTallas">

              </div>

            </div>

            <div>
              <p class="font-mediumDisplay text-text16 md:text-text20 pb-4 font-bold" id="textoStock">

              </p>

            </div>



          </div>


          <div class="flex flex-col gap-3">

            <div class="flex justify-between items-center">
              <!-- Corregir -->
              <div class="flex">
                <div id=disminuir
                  class="w-14 h-14 flex justify-center items-center bg-[#F5F5F5] cursor-pointer rounded-l-3xl">
                  <span class="text-[30px]">-</span>
                </div>
                <div id=cantidadSpan class="w-14 h-14 flex justify-center items-center bg-[#F5F5F5]">
                  <span class="text-[20px] font-mediumDisplay">1</span>
                </div>
                <div id=aumentar
                  class="w-14 h-14 flex justify-center items-center bg-[#F5F5F5] cursor-pointer rounded-r-3xl">
                  <span class="text-[30px]">+</span>
                </div>
              </div>

              <div class="flex justify-center items-center">
                <button href="#" id='btnAgregarCarrito'
                  class="text-white py-3 px-5 md:px-12 xl:px-16 border-2 border-gray-700 rounded-3xl w-full text-center font-mediumDisplay text-text16 h-full bg-black hover:bg-white hover:text-black md:duration-500">
                  Agregar al carrito
                </button>
              </div>
            </div>
          </div>

          <p class="italic font-mediumItalicDisplay text-text18">
            SKU: {{ $productos[0]->sku }}
          </p>

          <div>
            <div class="relative">
              <div class="mx-auto">
                <div class="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                  <div class="py-5">
                    <details class="group" open>
                      <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                        <span class="font-boldDisplay text-text20 md:text-text24 text-[#151515]">
                          Detalles de producto
                        </span>
                        <span class="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <div class="group-open:animate-fadeIn mt-3 text-[#000000]">
                        <div class="flex flex-col gap-5 ">
                          @if (is_null($productos[0]->description))
                          @else
                            <div class="flex flex-col gap-2">
                              <p class="font-mediumDisplay text-text16 md:text-text20">
                                Descripción de producto
                              </p>
                              <p class="font-regularDisplay text-text16 md:text-text20 text-gray-600">
                                {!! $productos[0]->description !!}
                              </p>
                            </div>
                          @endif

                          @if ($especificaciones->isEmpty())
                          @else
                            <div class="flex flex-col gap-5">
                              <p class="font-mediumDisplay text-text16 md:text-text20">
                                Información adicional
                              </p>

                              <table class="border-collapse w-full">
                                <tbody>
                                  @foreach ($especificaciones as $item)
                                    <tr>
                                      <td
                                        class="border w-1/5 border-gray-400 px-3 py-2 font-semibold text-[16px] text-gray-900">
                                        {{ capitalizeFirstLetter($item->tittle) }}:
                                      </td>
                                      <td class="border w-4/5 border-gray-400 px-3 py-2 font-normal text-[15px]">
                                        {{ capitalizeFirstLetter($item->specifications) }}
                                      </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          @endif
                        </div>
                      </div>
                    </details>
                  </div>
                  {{-- <div class="py-5">
                                        <details class="group">
                                            <summary
                                                class="flex cursor-pointer list-none items-center justify-between font-medium">
                                                <div class="flex gap-2 items-center">
                                                    <span
                                                        class="font-boldDisplay text-text20 md:text-text24 text-[#151515]">
                                                        Comentarios
                                                    </span>
                                                    <div class="flex">
                                                        <img src="{{ asset('images/svg/start.svg') }}" alt="doomine" />
                                                        <img src="{{ asset('images/svg/start.svg') }}" alt="doomine" />
                                                        <img src="{{ asset('images/svg/start.svg') }}" alt="doomine" />
                                                        <img src="{{ asset('images/svg/start.svg') }}" alt="doomine" />
                                                        <img src="{{ asset('images/svg/start_middle.svg') }}"
                                                            alt="doomine" />
                                                    </div>
                                                    <span class="font-regularDisplay text-text14">
                                                        4.5/5
                                                    </span>
                                                </div>

                        <span class="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                                            <p
                                                class="group-open:animate-fadeIn mt-3 font-regularDisplay text-text16 md:text-text20 text-gray-600">
                                                Este polo Oversize para mujer con cuello redondo es
                                                imprescindible para todas las amantes de la diversión
                                                y el buen gusto. Las mangas cortas y la longitud extra
                                                larga, así como su confección en algodón súper suave y
                                                cómodo, harán que te sientas genial con este polo en
                                                cualquier momento. Está disponible en muchos colores y
                                                estampados para que puedas elegir el que más te guste.
                                            </p>
                                        </details>
                                    </div> --}}
                  {{-- <div class="py-5">
                    <details class="group">
                      <summary class="flex cursor-pointer list-none items-center justify-between font-mediumDisplay">
                        <span class="font-boldDisplay text-text20 md:text-text24 text-[#151515]">
                          FAQs</span>
                        <span class="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <p
                        class="group-open:animate-fadeIn mt-3 font-regularDisplay text-text16 md:text-text20 text-gray-600">
                        Este polo Oversize para mujer con cuello redondo es
                        imprescindible para todas las amantes de la diversión
                        y el buen gusto. Las mangas cortas y la longitud extra
                        larga, así como su confección en algodón súper suave y
                        cómodo, harán que te sientas genial con este polo en
                        cualquier momento. Está disponible en muchos colores y
                        estampados para que puedas elegir el que más te guste.
                      </p>
                    </details>
                  </div> --}}

                  {{--  <div class="py-5">
                    <details class="group">
                      <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                        <span class="font-boldDisplay text-text20 md:text-text24 text-[#151515]">
                          Entrega y devoluciones</span>
                        <span class="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <p
                        class="group-open:animate-fadeIn mt-3 font-regularDisplay text-text16 md:text-text20 text-gray-600">
                        Este polo Oversize para mujer con cuello redondo es
                        imprescindible para todas las amantes de la diversión
                        y el buen gusto. Las mangas cortas y la longitud extra
                        larga, así como su confección en algodón súper suave y
                        cómodo, harán que te sientas genial con este polo en
                        cualquier momento. Está disponible en muchos colores y
                        estampados para que puedas elegir el que más te guste.
                      </p>
                    </details>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="w-11/12 mx-auto flex flex-col gap-5 pt-10">
      <div>
        <img src="{{ asset('images/img/producto_1.png') }}" alt="doomine" class="w-full h-full hidden md:block" />

        <img src="{{ asset('images/img/mobile_foto.png') }}" alt="doomine" class="w-full h-full block md:hidden" />
      </div>

      <p class="font-regularDisplay text-text20 md:text-text24 text-textBlack text-center w-full md:w-2/3 mx-auto">
        Suspendisse vitae leo porta sem vestibulum venenatis. Ut ut eleifend
        tellus, vel dapibus lectus. Aenean faucibus nisi eget massa fringilla.
      </p>
    </section>

    {{-- <section class="w-11/12 mx-auto flex flex-col gap-10 mb-24">
            <div class="flex justify-between items-center gap-2">
                <p class="uppercase font-boldItalicDisplay text-text20 md:text-text28 xl:text-text28">
                    <span class="hidden md:inline-block">También</span> Podría Gustarte
                </p>
                <a href="#" class="font-boldItalicDisplay text-text20 md:text-text28 uppercase">/ Ver Todo /</a>
            </div>

      <div>
        <div class="swiper slider-productos">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_1.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                      <p class="text-text10 md:text-text12 line-through text-gray-400 font-boldDisplay">
                        s/120.00
                      </p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_2.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_3.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                      <p class="text-text10 md:text-text12 line-through text-gray-400 font-boldDisplay">
                        s/120.00
                      </p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_4.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                      <p class="text-text10 md:text-text12 line-through text-gray-400 font-boldDisplay">
                        s/120.00
                      </p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    -20%
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_1.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_2.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_3.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_4.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    -20%
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_1.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_2.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_3.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                <div class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                  <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                    New Arrival
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="flex flex-col gap-5 relative">
                <img src="{{ asset('images/img/arrives_4.png') }}" alt="arrives" class="w-full h-full" />

                <div class="flex flex-col gap-2">
                  <div
                    class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-2 order-2 lg:order-1">
                    <p class="text-text14 md:text-text16">
                      Oversize Verde Babygirls
                    </p>
                    <div class="flex font-boldDisplay text-black items-center gap-2">
                      <p class="text-text14 md:text-text16">s/60.00</p>
                    </div>
                  </div>

                  <div class="order-1 lg:order-2">
                    <p class="font-boldDisplay text-text12 md:text-text14 xl:text-text16 text-textGray">
                      Polos
                    </p>
                  </div>
                </div>

                                <div
                                    class="bg-white absolute top-[10px] left-[10px] md:top-[25px] md:left-[25px] rounded-md py-1 px-2">
                                    <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack">
                                        -20%
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
  </main>


@section('scripts_importados')


  <script>
    $(document).ready(function() {

      PintarCarrito()

      function capitalizeFirstLetter(string) {
        string = string.toLowerCase()
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
    })
    $('#disminuir').on('click', function() {
      console.log('disminuyendo')
      let cantidad = Number($('#cantidadSpan span').text())
      if (cantidad > 0) {
        cantidad--
        $('#cantidadSpan span').text(cantidad)
      }


    })
    // cantidadSpan
    $('#aumentar').on('click', function() {
      console.log('aumentando')
      let cantidad = Number($('#cantidadSpan span').text())
      cantidad++
      $('#cantidadSpan span').text(cantidad)

    })
  </script>
  <script>
    $('#openCarrito').on('click', function() {
      $('.main').addClass('blur')
    })
    $('#closeCarrito').on('click', function() {

      $('.cartContainer').addClass('hidden')
      $('#check').prop('checked', false);
      $('.main').removeClass('blur')


    });
  </script>
  <script>
    var appUrl = '{{ env('APP_URL') }}';
  </script>


  <script src="{{ asset('js/carrito.js') }}"></script>

  <script>
    $(document).ready(function() {

      function llenarImagenes(images) {

        let html = '';
        images.forEach(element => {
          if (element.type_imagen == 'primary') {
            html += `
                          <div class="flex flex-col gap-5 relative ">
                            <img src="{{ asset('${element.name_imagen}') }}" alt="${element.name_imagen}" class="w-full object-cover" />
                          </div>
                      `;
          }

          if (element.type_imagen == 'secondary') {
            html += `
                      <img src="{{ asset('${element.name_imagen}') }}" alt="${element.name_imagen}"
                            class="w-full object-cover " />`;
          }
        });
        return html;
      }

      function llenadoTallas(tallas) {
        let html = '';

        tallas.forEach(element => {
          if (element) {
            html += `
                          <div class="tallas flex justify-center items-center border-2 w-full rounded-lg cursor-pointer">
                              <p class="tallasombreado py-5 px-4 w-full text-center transition">
                                ${element.talla.valor}
                              </p>
                          </div>
                         
                      `;
          }
        });
        return html;
      }


      function enviarColorSeleccionado() {
        var selectedColorDiv = $('.colors.color');
        var colorId = selectedColorDiv.data('id');
        var productId = selectedColorDiv.data('productid');

        $.ajax({
          url: '{{ route('cambioGaleria') }}', // Cambia esta URL a la ruta de tu controlador
          method: 'POST', // O 'POST' según corresponda
          data: {
            id: colorId,
            idproduct: productId
          },
          success: function(response) {
            console.log(response)
            let conteoImagenes = response.images.length;
            let llenadoimg = llenarImagenes(response.images);
            let llenadotallas = llenadoTallas(response.tallas);


            if (conteoImagenes == 1) {
              $('#imageContainer_uno').html(llenadoimg);
              $('#imageContainer').addClass('hidden');
              $('#imageContainer_uno').removeClass('hidden');

            } else {
              $('#imageContainer').html(llenadoimg);
              $('#imageContainer').removeClass('hidden');
              $('#imageContainer_uno').addClass('hidden');
            }

            $('#llenadoTallas').html(llenadotallas);
            console.log(response.tallas[0].stock)

            $('#textoStock').text(response.tallas[0].stock !== null ? "Con Stock" : '')




          },
          error: function(xhr) {
            console.log(xhr.responseText);
          }
        });
      }
      enviarColorSeleccionado();

      $('.colors').on('click', function() {
        $('.colors').removeClass('color');
        $(this).addClass('color');
        enviarColorSeleccionado();
      });

      $(document).on('click', '.tallas', function() {
        $('.tallas').removeClass('tallaSelected');
        $('.tallas').removeClass('bg-slate-400');

        $(this).addClass('tallaSelected');
        $(this).addClass('bg-slate-400');
      });


    });
  </script>

@stop


@stop
