@extends('components.public.matrix')
@section('title', 'Contactanos | ' . config('app.name', 'Laravel'))

@section('css_importados')

@stop


@section('content')


  <main>
    <section class="my-12">
      {{-- <div class="flex flex-col w-11/12 mx-auto">
                <div class="flex flex-col gap-10 mt-10">
                    <div class="flex gap-1 text-text14 xl:text-text18">
                        <a href="index.html" class="font-regularDisplay text-[#6C7275]">Home</a>
                        <span>/</span>
                        <a href="contacto.html" class="font-mediumDisplay text-[#141718]">Contacto</a>
                    </div>
                </div>
            </div> --}}
    </section>

    <section class="w-11/12 mx-auto">
      <div class="text-[#151515] flex flex-col gap-16">
        <div class="md:w-8/12 flex flex-col gap-5">
          <h1 class="font-boldDisplay text-text48 xl:text-text52 leading-none md:leading-tight">
            Contáctanos Para Más Información
          </h1>
          <p class="font-regularDisplay text-text18 xl:text-text22">
            Dommine se encuentra interesado en ti. Si deseas tener más información sobre nuestros productos y promociones,
            entonces completa el siguiente formulario para contactarte o ten en cuenta nuestra ubicación, número
            telefónico y dirección de correo electrónico.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2">
          <div>
            <img src="{{ asset('images/img/contacto_1.png') }}" alt="doomine" class="w-full h-full cover bg-cover" />
          </div>
          <div class="bg-[#F3F5F7] p-4 md:p-10">
            <div class="flex flex-col justify-center items-start h-full gap-8">
              <h2 class="font-mediumDisplay text-text40 xl:text-text44 leading-none md:leading-tight">
                Sobre nosotros
              </h2>

              <div class="flex flex-col gap-5 font-regularDisplay text-text16 xl:text-text20">
                <p>
                  @foreach ($general as $item)
                    {{ $item->aboutus }}
                  @endforeach
                </p>
              </div>
              <div class="text-center flex justify-center">
                <a href="{{ route('catalogo', 0) }}"
                  class="leading-none font-boldDisplay text-text16 md:text-text20 bg-[#000000] rounded-full py-5 text-white px-10 hover:bg-white hover:text-black md:duration-500 border-[1.5px] border-black">
                  Comprar ahora
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="w-11/12 mx-auto my-16">
      <div>
        <h2 class="font-boldDisplay text-text40 xl:text-text44 text-center my-10 leading-none md:leading-tight">
          Contacta Con Nosotros
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
          <div class="flex flex-col gap-1 justify-center items-center bg-[#F3F5F7] py-5 text-text16 xl:text-text20">
            <div class="flex justify-center items-center">
              <img src="{{ asset('images/svg/icon_direccion.svg') }}" alt="direccion" />
            </div>
            <p class="text-[#6C7275] font-boldDisplay uppercase">Dirección</p>
            <p class="font-boldDisplay text-[#141718]">
              @foreach ($general as $item)
                {{ $item->address }}
              @endforeach
            </p>
            <p class="font-boldDisplay text-[#141718]">
              @foreach ($general as $item)
                {{ $item->district }} - {{ $item->city }}
              @endforeach
            </p>
          </div>

          <div class="flex flex-col gap-1 justify-center items-center bg-[#F3F5F7] py-5 text-text16 xl:text-text20">
            <div class="flex justify-center items-center">
              <img src="{{ asset('images/svg/icon_celular.svg') }}" alt="celular" />
            </div>
            <p class="text-[#6C7275] font-boldDisplay uppercase">TELÉFONO</p>
            <p class="font-boldDisplay text-[#141718]">
              @foreach ($general as $item)
                {{ $item->cellphone }}
              @endforeach
            </p>
            <p class="font-boldDisplay text-[#141718]">
              @foreach ($general as $item)
                {{ $item->office_phone }}
              @endforeach
            </p>
          </div>

          <div class="flex flex-col gap-1 justify-center items-center bg-[#F3F5F7] py-5 text-text16 xl:text-text20">
            <div class="flex justify-center items-center">
              <img src="{{ asset('images/svg/icon_email.svg') }}" alt="email" />
            </div>
            <p class="text-[#6C7275] font-boldDisplay uppercase">Email</p>
            <p class="font-boldDisplay text-[#141718]">
              @foreach ($general as $item)
                {{ $item->email }}
              @endforeach
            </p>
          </div>
        </div>
      </div>

      <div class="my-16 grid grid-cols-1 md:grid-cols-2 gap-16 justify-center items-center">
        <form id="formContactos" class="flex flex-col gap-5">
          @csrf
          <div class="flex flex-col gap-2">
            <label for="name" class="font-mediumDisplay text-text12 xl:text-text16 text-[#6C7275]">Nombre</label>
            <input id="name" type="text" placeholder="Nombre Completo" required name="name"
              class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="correo_electronico" class="font-mediumDisplay text-text12 xl:text-text16 text-[#6C7275]">Correo
              Electrónico</label>
            <input type="email" placeholder="hola@gmail.com" required name="email" id="email"
              class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-[1.5px] border-gray-200 rounded-xl" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="message" class="font-mediumDisplay text-text12 xl:text-text16 text-[#6C7275]">Mensaje</label>
            <textarea name="message" id="mensaje" cols="30" rows="5"
              class="border-gray-200 border-[1.5px] rounded-xl focus:outline-none text-text16 xl:text-text20"
              placeholder="Hola ..."></textarea>
          </div>

          <div>
            <input type="submit" value="Enviar Mensaje"
              class="text-white bg-black py-3 rounded-full cursor-pointer border-2 font-boldDisplay text-text16 xl:text-text20 text-center border-none w-full md:w-auto px-10 inline-block" />
          </div>
        </form>
        <div class="flex justify-center items-center">
          <img src="{{ asset('images/img/mapa.png') }}" alt="ubicacion" />
        </div>
      </div>
    </section>
  </main>


@section('scripts_importados')
  <script>
    function alerta(message) {
      Swal.fire({
        title: message,
        icon: "error",
      });
    }

    function validarEmail(value) {
      console.log(value)
      const regex =
        /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/

      if (!regex.test(value)) {
        alerta("El campo email no es válido");
        return false;
      }
      return true;
    }

    $('#formContactos').submit(function(event) {

      event.preventDefault();
      let formDataArray = $(this).serializeArray();

      if (!validarEmail($('#email').val())) {
        return;
      };

      /* console.log(formDataArray); */
      $.ajax({
        url: '{{ route('guardarContactos') }}',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
          $('#formContactos')[0].reset();
          Swal.fire({
            title: response.message,
            icon: "success",
          });

        },
        error: function(error) {
          const obj = error.responseJSON.message;
          const keys = Object.keys(error.responseJSON.message);
          let flag = false;
          keys.forEach(key => {
            if (!flag) {
              const e = obj[key][0];
              Swal.fire({
                title: error.message,
                text: e,
                icon: "error",
              });
              flag = true; // Marcar como mostrado
            }
          });
        }
      });
    })
  </script>
  <script>
    var appUrl = '{{ env('APP_URL') }}';

    // Agrega más variables de entorno aquí según sea necesario
  </script>


  <script src="{{ asset('js/carrito.js') }}"></script>
@stop

@stop
