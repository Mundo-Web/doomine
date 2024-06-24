<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl">Pedido #{{ $orders->codigo_orden }}
        </h2>
      </header>
      <div class="p-6">

        <div class="flex flex-col gap-2 ">
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
                          <table class="min-w-full divide-y divide-gray-200">
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
                            <tbody class="divide-y divide-gray-200">
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

                <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-md ml-1">Direccion
                  de envio:</h2>
                <p class="ml-1 text-slate-800 dark:text-slate-100 text-sm">
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


</x-app-layout>
<script></script>
