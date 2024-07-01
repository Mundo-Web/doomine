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
              class="bg-red-800 text-white  me-2 px-2.5 py-1 rounded dark:bg-yellow-900 dark:text-yellow-300 shadow-2xl">
              {{ number_format((($item->precio - $item->descuento) * 100) / $item->precio, 2) }}% OFF
            </span>
            {{--  @foreach ($item->tags as $tag)
              <div class="bg-white  rounded-md py-1 px-2">
                <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack ">
                  {{ $tag->name }}
                </p>
              </div>
            @endforeach --}}
          </div>
        </div>
      </div>
    @endforeach
  </div>

  {{-- <div class="hidden md:block">
                <nav class="mb-4 flex justify-between" aria-label="Pagination">
                    <a class="px-4 py-2 flex gap-2 border-[1.5px] border-gray-300 rounded-lg group items-center hover:bg-black md:duration-500"
                        href="/page/1">
                        <div>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M15.8332 10.0013H4.1665M4.1665 10.0013L9.99984 15.8346M4.1665 10.0013L9.99984 4.16797"
                                    stroke="black" stroke-width="1.67" stroke-linecap="round"
                                    stroke-linejoin="round" class="group-hover:stroke-strokeWithe md:duration-500" />
                            </svg>
                        </div>
                        <span
                            class="font-mediumDisplay text-[16px] xl:text-text20 text-[#000000] group-hover:text-textWhite md:duration-500">Anterior</span>
                    </a>

                    <div class="flex text-[#000000] font-mediumDisplay items-end">
                        <a class="rounded-lg px-4 py-2 hover:bg-[#F5F5F5] duration-300 active:bg-[#F5F5F5] text-text20"
                            href="/page/2">1
                        </a>

                        <a class="rounded-lg px-4 py-2 text-[#495560] hover:bg-[#F5F5F5] duration-300 text-text20"
                            href="/page/2">2
                        </a>

                        <a class="rounded-lg px-4 py-2 text-[#495560] hover:bg-[#F5F5F5] duration-300 text-text20"
                            href="/page/3">3
                        </a>

                        <p>.....</p>

                        <a class="rounded-lg px-4 py-2 text-[#495560] hover:bg-[#F5F5F5] duration-300 text-text20"
                            href="/page/3">4
                        </a>
                    </div>

                    <a class="px-4 py-2 flex gap-2 border-[1.5px] border-gray-300 rounded-lg group items-center hover:bg-black md:duration-500"
                        href="/page/1">
                        <span
                            class="font-mediumDisplay text-[16px] xl:text-text20 text-[#000000] group-hover:text-textWhite md:duration-500">
                            Próxima
                        </span>

                        <div>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.1665 10.0013H15.8332M15.8332 10.0013L9.99984 4.16797M15.8332 10.0013L9.99984 15.8346"
                                    stroke="black" stroke-width="1.67" stroke-linecap="round"
                                    stroke-linejoin="round" class="group-hover:stroke-strokeWithe md:duration-500" />
                            </svg>
                        </div>
                    </a>
                </nav>
    </div> --}}
</section>
