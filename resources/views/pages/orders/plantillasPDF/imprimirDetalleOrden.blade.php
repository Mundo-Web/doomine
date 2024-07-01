<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="application/pdf; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ $title . ' ' . $orders->codigo_orden }} </title>

</head>

<body>
  <style>
    html {
      font-family: sans-serif;
      font-size: 11px;
    }

    table {
      width: 100%;
      border-spacing: 0;

    }

    .table {
      border: 0.1px solid #ccc;
    }

    .celda {
      text-align: left;
      padding: 5px;
      border: 0.1px solid #ccc;
    }

    .celda_center {
      text-align: center;
      padding: 5px;
      border: 0.1px solid #ccc;
    }

    .celda_right {
      text-align: right;
      padding: 5px;
      border: 0.1px solid #ccc;
    }

    tr:nth-child(even) {}

    .nth-child {
      background-color: transparent;
    }

    .border-bottom {
      border-bottom: 0.1px solid #ccc;
    }

    th {
      padding: 5px;
      text-align: center;
      border-color: #409EFF;
      border: 0.1px solid #ccc;
    }

    .headers {
      padding: 5px !important;
      border-bottom: 0.1px solid #ccc;
      height: 25px;
    }


    p>strong {
      margin-left: 5px;
      font-size: 13px;
    }

    thead {
      font-weight: bold;
      color: #000;
      text-align: center;
    }

    .title {
      font-weight: bold;
      padding: 5px;
      font-size: 12px !important;
    }

    .encabezado {
      background-color: #eee;
      text-transform: uppercase;
      padding: 5px;
      padding-left: 10px;
      font-weight: bold;
    }

    .categoria {
      background-color: #eee;
      text-transform: uppercase;
      padding: 5px;
      padding-left: 50px;
    }

    .celda_loop {
      width: 10% !important;
      text-align: center;
      padding: 5px;
      border: 0.1px solid #ccc;
    }

    .celda_descrip {
      width: 60% !important;
      text-align: left;
      padding: 5px;
      border: 0.1px solid #ccc;
    }

    .celda_date {
      width: 30% !important;
      text-align: center;
      padding: 5px;
      border: 0.1px solid #ccc;
    }

    .celda_left {
      width: 30% !important;
      text-align: left;
      padding: 5px;
      border: 0.1px solid #ccc;
    }

    p>strong {
      margin-left: 5px;
      font-size: 11px;
    }

    header {
      position: fixed;
      height: 1cm;
      color: #000;
      text-align: center;
      padding: 10px;
      font-size: 12px;
      font-family: arial;

    }

    .grupo {
      padding-left: 20px;
    }

    .categoria {
      padding-left: 60px;
    }

    .subcategoria {
      padding-left: 100px;
    }

    footer {
      position: fixed;
      bottom: 10px;
      height: 0.8cm;
      color: #000;
      text-align: center;
      font-size: 11px;
      padding: 12px;
      font-family: Arial;
      padding: 10px;
    }

    @page {
      margin: 0.5cm 0.5cm 0cm 0.5cm;
      font-family: sans-serif;
    }

    td,
    th {
      font-size: 10px !important;
      height: 15px;
    }

    body {
      margin: 1.5cm 0.5cm 0.5cm 0.5cm;
    }
  </style>

  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">

      <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl">Pedido #{{ $orders->codigo_orden }}
      </h2>




      <div class="p-6">

        <div class="flex flex-col gap-2 " id="containerImprimir">
          <div class="flex gap-2 p-3 ">

            <div class="basis-0 md:basis-3/5">
              <div class="rounded shadow-lg p-4">



                <div class="bg-white rounded-lg shadow-lg px-8 py-4 max-w-xl mx-auto">
                  <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">


                    </div>
                    <div class="text-gray-700">

                      <div class="text-sm">Fecha: {{ $orders->created_at ?? '' }}</div>

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
                  <br>

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
                              @php
                                $contador = 1;
                              @endphp
                              @foreach ($orders->DetalleOrden as $item)
                                <tr>
                                  <td class=" celda_center" width="30px">
                                    {{ $contador }}
                                  </td>
                                  <td class="celda_center title" width="60%">
                                    {{ $item->producto->producto ?? '' }}
                                  </td>
                                  <td class="celda_center" width="60px">
                                    {{ $item->precio ?? '' }}</td>
                                  <td class="celda_center" width="60px">
                                    {{ $item->cantidad ?? '' }}</td>
                                  <td class="celda_center" width="60px">
                                    {{ $item->precio * $item->cantidad ?? '' }}</td>
                                </tr>
                                @php
                                  $contador++;
                                @endphp
                              @endforeach

                              <tr>
                                <td colspan="5"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2"class="celda_right title">Subtotal:</td>
                                <td colspan="1" class="celda_center ">S/{{ $subtotal }}</td>

                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2"class="celda_right title">Costo de envio::</td>
                                <td colspan="1" class="celda_center ">S/{{ $orders->precio_envio }}</td>

                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2" class="celda_right title">Total:</td>
                                <td colspan="1" class="celda_center ">S/{{ $orders->monto }}</td>

                              </tr>
                            </tbody>

                          </table>
                        </div>
                      </div>
                    </div>
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

                  Dir Av Calle:{{ $direccion->dir_av_calle ?? '' }} </p>
                <p>Numero: {{ $direccion->dir_numero ?? '' }}</p>
                <p class="ml-1 text-slate-800 dark:text-slate-100 text-sm">
                  Bloque:{{ $direccion->dir_bloq_lote ?? '' }}</p>

              </div>
            </div>

          </div>
        </div>


      </div>
    </div>
  </div>

</body>

</html>
