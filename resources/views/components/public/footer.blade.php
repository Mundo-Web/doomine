<footer class="bg-bgRosa mt-12 flex flex-col gap-10">
  <div class="w-11/12 mx-auto flex flex-col gap-10">
    <div class="flex justify-start mt-10">
      <div class="flex flex-col gap-4 w-full md:w-6/12">
        <p class="font-regularDisplay text-text18 xl:text-text24 text-textBlack">
          ¡Compra segura y rápida! Aceptamos tarjetas Visa, MasterCard y American Express para tu comodidad y
          tranquilidad. Compra fácil y sin preocupaciones.
        </p>

        <div class="flex gap-1">
          <img src="{{ asset('images/img/pago_1.png') }}" alt="visa" />
          <img src="{{ asset('images/img/pago_2.png') }}" alt="mastercad" />
          <img src="{{ asset('images/img/pago_3.png') }}" alt="PayPal" />
          <img src="{{ asset('images/img/pago_4.png') }}" alt="apple Pay" />
          <img src="{{ asset('images/img/pago_5.png') }}" alt="google Pay" />
        </div>
      </div>
    </div>

    {{-- <div class="flex md:justify-end items-center text-textBlack uppercase">
      <div
        class="flex items-center justify-between md:justify-end gap-10 border-b-2 border-black w-full md:w-auto"
      >
        <p
          class="font-lightDisplay text-text44 md:text-text80 xl:text-text90 italic"
        >
          Suscríbete
        </p>
        <a href="#">
          <div>
            <svg
              viewBox="0 0 80 81"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
              class="w-[60px] h-[60px] md:w-[100px] md:h-[100px]"
            >
              <circle
                cx="40.4017"
                cy="40.5312"
                r="28"
                transform="rotate(-45 40.4017 40.5312)"
                fill="black"
              />
              <path
                d="M42.332 29.7198L51.0046 29.9313M51.0046 29.9313L51.2161 38.604M51.0046 29.9313L29.8024 51.1335"
                stroke="white"
                stroke-width="2.8718"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </div>
        </a>
      </div>
    </div> --}}

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
      <div class="flex flex-col gap-5">
        <p class="font-boldItalicDisplay text-text16 uppercase xl:text-text24">
          Navegar
        </p>
        <div class="flex flex-col gap-5 text-gray-400 font-regularDisplay text-text16 xl:text-text20">

          <a href="{{ route('catalogo', 0) }}">Categorías</a>
          <a href="{{ route('coleccion', 0) }}">Colecciones</a>
          <a href="{{ route('novedades') }}">New Arrivals</a>
          <a href="{{ route('contacto') }}">Visítanos</a>
        </div>
      </div>

      <div class="flex flex-col gap-5">
        <p class="font-boldItalicDisplay text-text16 uppercase xl:text-text24">
          Ayuda
        </p>

        <div class="flex flex-col gap-5 text-gray-400 font-regularDisplay text-text16 xl:text-text20">

          <a href="/terminos-y-condiciones">Términos y condiciones</a>
          <a href="/politicas-de-devolucion">Política de privacidad</a>
        </div>
      </div>


      <div class="flex flex-row md:flex-col md:items-end lg:col-span-2 gap-2">

        @if ($datosgenerales[0]->youtube)
          <a target="_blank" href="{{ $datosgenerales[0]->youtube }}">
            <img src="{{ asset('images/svg/youtube.svg') }}" alt="facebook" />
          </a>
        @endif

        @if ($datosgenerales[0]->facebook)
          <a target="_blank" href="{{ $datosgenerales[0]->facebook }}">
            <img src="{{ asset('images/svg/facebook.svg') }}" alt="facebook" />
          </a>
        @endif

        @if ($datosgenerales[0]->instagram)
          <a target="_blank" href="{{ $datosgenerales[0]->instagram }}">
            <img src="{{ asset('images/svg/instagram.svg') }}" alt="instagram" />
          </a>
        @endif


        @if ($datosgenerales[0]->tiktok)
          <a target="_blank" href="{{ $datosgenerales[0]->tiktok }}">
            <img src="{{ asset('images/svg/tiktok.svg') }}" alt="instagram" />
          </a>
        @endif

        @if ($datosgenerales[0]->twitter)
          <a target="_blank" href="{{ $datosgenerales[0]->twitter }}">
            <img src="{{ asset('images/svg/twitter.svg') }}" alt="instagram" />
          </a>
        @endif
      </div>
    </div>
  </div>

  <div>
    <img src="{{ asset('images/img/footer_1.png') }}" alt="doomine" class="w-full h-full" />
  </div>
</footer>
