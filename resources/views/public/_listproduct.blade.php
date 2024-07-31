<section class="md:basis-9/12 flex flex-col gap-10">
  <div class="grid grid-cols-2 lg:grid-cols-3 gap-5 z-[0]">

    @foreach ($productos as $item)
      <div class="flex flex-col gap-5 relative col-span-1 order-1 lg:order-1">
        <div class="product_container">
          @foreach ($item->images as $image)
            @if ($image->caratula == 1)
              <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
                class="w-full h-full hover:scale-110 transition-all duration-300" />
            @endif
          @endforeach

          <div class="addProduct text-center flex justify-center">

            <a href="{{ route('producto', $item->id) }}"
              class="leading-none font-mediumDisplay text-text12 md:text-text14 bg-[#000000] px-1 py-2 md:py-2 2lg:px-5 flex-initial w-32 md:w-36 2lg:py-3 2lg:w-52 text-center text-white rounded-3xl xl:text-text20 xl:w-60">
              Ver producto
            </a>
          </div>
        </div>

        <div class="flex flex-col gap-1">
          <div
            class="flex flex-col 2xl:flex-row md:justify-between font-boldDisplay text-black gap-1 order-2 lg:order-1">
            <p class="text-text14 md:text-text16 xl:text-text20">
              {{ $item->producto }}
            </p>
            <div class="flex flex-col md:flex-row font-boldDisplay text-black items-start gap-1">

              @if ($item->descuento == 0)
                <p class="text-text14 md:text-text16 xl:text-text20">
                  s/{{ $item->precio }}
                </p>
              @else
                <div class="flex flex-row gap-2 ">
                  <p class="text-text14 md:text-text16 xl:text-text20">
                    s/{{ $item->descuento }}
                  </p>
                  <p class="text-text10 md:text-text16 line-through text-gray-400 font-mediumDisplay xl:text-text18">
                    s/{{ $item->precio }}
                  </p>

                </div>
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

        <div class="absolute top-[10px] left-[10px] md:top-[10px] md:left-[10px]">
          <div class="flex gap-3 flex-wrap">
            <span
              class="bg-red-800 text-xs md:text-sm text-white  me-2 px-2.5 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300 shadow-2xl">
              {{ number_format((($item->precio - $item->descuento) * 100) / $item->precio, 0) }}% <br
                class="block md:hidden"> OFF
            </span>


          </div>
        </div>
      </div>
    @endforeach
  </div>


</section>
