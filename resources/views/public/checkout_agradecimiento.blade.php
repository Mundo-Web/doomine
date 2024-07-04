@extends('components.public.matrix')

@section('css_importados')

@stop


@section('content')

  <main>
    <section class="font-poppins my-12 w-11/12 mx-auto">
      <div class="flex flex-col 2md:flex-row gap-32 md:gap-10 w-11/12 mx-auto">
        <div class="md:basis-1/2 flex flex-col gap-10 basis-0">
          <div>
            <a href="index.html" class="font-normal text-[14px] text-[#6C7275]">
              Home
            </a>
            <span>/</span>
            <a href="carrito.html" class="font-semibold text-[14px] text-[#141718]">Carrito</a>
          </div>

          <div class="flex justify-between items-center w-full">
            <p
              class="font-semibold text-[18px] text-[#EB5D2C] border-b-[1px] border-[#EB5D2C] md:px-4 py-4 basis-1/3 h-full text-center">
              <span class="flex items-center h-full">Carro de compra</span>
            </p>

            <p
              class="font-semibold text-[18px] text-[#EB5D2C] border-b-[1px] border-[#EB5D2C] md:px-4 py-4 basis-1/3 h-full text-center">
              <span class="flex items-center h-full">Detalles de pago</span>
            </p>

            <p
              class="font-medium text-[18px] text-[#21201E] border-b-[1px] border-[#21201E] md:px-4 py-4 basis-1/3 h-full text-center">
              <span class="flex items-center h-full">Orden completada</span>
            </p>
          </div>
        </div>
      </div>

      <div class="flex flex-col justify-start gap-10 max-w-[600px] mx-auto pt-10 text-center">
        <div class="font-poppins flex flex-col gap-4 justify-center items-center">
          <p class="text-[#6C7275] font-medium text-[20px]">
            Gracias por tu compra &#127881;
          </p>
          <h2 class="font-semibold text-[40px] text-[#151515]">
            Tu orden ha sido recibida
          </h2>
          <p class="font-medium text-[16px] text-[#6C7275]">
            Código de pedido
          </p>
          <p id="codigoPedido" class="font-semibold text-[16px] text-[#141718]">#{{ $codigoCompra }}</p>
        </div>

        <div class="font-poppins">
          <div>
            <div class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5">
              <div class="w-full basis-5/12" id="itemsCarritoAgradecimientos">

              </div>



            </div>
          </div>

        </div>
      </div>

      <div class="flex flex-col gap-5">
        <div>
          <a href="{{ route('catalogo', 0) }}"
            class="text-white bg-[#74A68D] w-full py-3 rounded-2xl cursor-pointer font-semibold text-[16px] inline-block text-center">Seguir
            comprando</a>
        </div>

        <div>
          <a href="/micuenta/pedidos"
            class="text-[#151515] bg-[#FFFFFF] w-full py-3 rounded-2xl cursor-pointer font-semibold text-[16px] inline-block text-center border-[1.5px] border-[#151515]">Historial
            de compras</a>
        </div>
      </div>
      </div>
    </section>
  </main>


@section('scripts_importados')
  <script>
    // Elimina las comillas dobles al principio y al final de la cadena


    $(document).ready(function() {
      Local.delete('carrito')
      Local.delete('token')

    });
  </script>

  <script>
    var appUrl = '{{ env('APP_URL') }}';

    // Agrega más variables de entorno aquí según sea necesario
  </script>


  <script src="{{ asset('js/carrito.js') }}"></script>

  <script src="{{ asset('js/storage.extend.js') }}"></script>

@stop

@stop
