<x-app-layout>

  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl">Pedido #{{ $orders->codigo_orden }}
        </h2>

        <button id="imprimirPedido" type="button" class="bg-blue-500 px-3 py-2 rounded text-white cursor-pointer">
          Imprimir
          <div class="px-5"><svg xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
              <path
                d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
            </svg>
          </div>

        </button>

      </header>
      <div class="p-6">

        <div class="flex flex-col gap-2 " id="containerImprimir">
          <div class="flex gap-2 p-3 ">

            <div class="basis-0 md:basis-3/5">
              <div class="rounded shadow-lg p-4">



                <div class="bg-white rounded-lg shadow-lg px-8 py-4 max-w-xl mx-auto">
                  <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                      <img class="" src="{{ asset('images/img/logo.png') }}" alt="Logo" />

                    </div>
                    <div class="text-gray-700">

                      <div class="text-sm">Fecha: {{ $orders->created_at ?? '' }}</div>
                      <div class="text-sm">Pedido #{{ $orders->codigo_orden ?? '' }}</div>
                    </div>
                  </div>
                  <div class="border-b-2 border-gray-300 pb-3 mb-3">
                    <h2 class="text-xl font-bold mb-4">Informacion del cliente</h2>
                    <div class="ml-1 text-slate-800 dark:text-slate-100 text-sm">
                      {{ $orders->usuarioPedido->name ?? '' }} {{ $orders->usuarioPedido->lastname ?? '' }}</div>
                    <div class="ml-1 text-slate-800 dark:text-slate-100 text-sm">{{ $direccion->dir_av_calle ?? '' }} -
                      {{ $direccion->dir_numero ?? '' }}</div>
                    <div class="ml-1 text-slate-800 dark:text-slate-100 text-sm">{{ $direccion->dir_bloq_lote ?? '' }}
                    </div>
                    <div class="ml-1 text-slate-800 dark:text-slate-100 text-sm">
                      {{ $orders->usuarioPedido->email ?? '' }}</div>
                  </div>

                  <div class="flex flex-col py-4">
                    <div class="-m-1.5 overflow-x-auto">
                      <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg overflow-hidden">
                          <table class="min-w-full ">
                            <thead>
                              <tr>
                                <th></th>
                                <th scope="col" class="px-6 py-3 text-start text-sm font-medium text-slate-800 ">
                                  Producto</th>
                                <th scope="col" class="px-6 py-3 text-start text-sm font-medium text-slate-800  ">
                                  Precio</th>
                                <th scope="col" class="px-6 py-3 text-start text-sm font-medium text-slate-800 ">
                                  Cantidad</th>
                                <th scope="col" class="px-6 py-3 text-end text-sm font-medium text-slate-800 ">
                                  Total</th>
                              </tr>
                            </thead>
                            <tbody class="">
                              @foreach ($orders->DetalleOrden as $item)
                                <tr>
                                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                    <div class="flex flex-row items-start gap-4 mt-2">
                                      <img class="w-10" src="{{ asset($item->imagenProducto->name_imagen) }}" />

                                    </div>
                                  </td>
                                  <td>
                                    <h2 class="">{{ $item->producto->producto ?? '' }}</h2>
                                  </td>
                                  <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                    {{ $item->precio ?? '' }}</td>
                                  <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                    {{ $item->cantidad ?? '' }}</td>
                                  <td class="px-6 py-4 text-sm font-medium text-gray-800">
                                    {{ $item->precio * $item->cantidad ?? '' }}</td>
                                </tr>
                              @endforeach

                            </tbody>

                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="flex justify-end mb-1">
                    <div class="px-6  text-end text-sm font-medium text-slate-800">Subtotal:</div>
                    <div class="text-slate-800 text-sm mr-3">S/{{ $subtotal }}</div>
                  </div>
                  <div class="flex justify-end mb-4">
                    <div class="px-6  text-end text-sm font-medium text-slate-800">Costo de envio:</div>
                    <div class="text-slate-800 text-sm mr-3">S/{{ $orders->precio_envio }}</div>

                  </div>
                  <div class="flex justify-end mb-8">
                    <div class="px-6  text-end text-sm font-medium text-slate-800">Total:</div>
                    <div class="text-slate-800 font-bold text-md mr-3">S/{{ $orders->monto }}</div>
                  </div>
                  {{-- <div class="border-t-2 border-gray-300 pt-8 mb-8">
                                              <div class="text-gray-700 mb-2">Payment is due within 30 days. Late payments
                                                  are subject to fees.</div>
                                              <div class="text-gray-700 mb-2">Please make checks payable to Your Company
                                                  Name and mail to:</div>
                                              <div class="text-gray-700">123 Main St., Anytown, USA 12345</div>
                                          </div> --}}
                </div>




              </div>
            </div>

            <div class="basis-0 md:basis-2/5">
              <div class="rounded shadow-lg p-4">

                <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-md ml-1">Direccion de envio:</h2>
                <p class="ml-1 text-slate-800 dark:text-slate-100 text-smclass="ml-1 text-slate-800 dark:text-slate-100
                  text-sm>{{ $departamentos[0]->description }} -
                  {{ $provincias[0]->description }} -
                  {{ $distritos[0]->description }}</p>
                <p class="ml-1
                text-slate-800 dark:text-slate-100 text-sm">

                  {{ $direccion->dir_av_calle ?? '' }} - {{ $direccion->dir_numero ?? '' }}</p>
                <p class="ml-1 text-slate-800 dark:text-slate-100 text-sm">
                  {{ $direccion->dir_bloq_lote ?? '' }}</p>

              </div>
            </div>

          </div>
        </div>











        <div class="inline-flex items-end">
          <a href="{{ URL::previous() }}"
            class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Volver</a>
        </div>
      </div>
    </div>
    {{-- <script>
      document.getElementById('imprimirPedido').addEventListener('click', function() {
        // Obtén el div que deseas convertir a PDF
        var element = document.getElementById('containerImprimir');

        // Usa html2canvas para capturar el div como una imagen
        html2canvas(element).then(function(canvas) {
          // Crea una instancia de jsPDF
          const {
            jsPDF
          } = window.jspdf;
          const pdf = new jsPDF();

          // Obtén la imagen del canvas en formato de datos URL
          const imgData = canvas.toDataURL('image/png');

          // Agrega la imagen al PDF
          pdf.addImage(imgData, 'PNG', 10, 10);

          // Guarda el PDF
          pdf.save('pedido.pdf');
        });
      });
    </script> --}}


</x-app-layout>
<script>
  $(document).ready(function() {
    $('#imprimirPedido').on("click", function() {
      // Obtén la URL usando Blade
      var url = "{{ route('descargarPdf.ordenes', $orders->id) }}";

      // Redirige en una nueva pestaña
      window.open(url, '_blank');
    });
  });
</script>
