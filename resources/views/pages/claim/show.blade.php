<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl">Reclamo de {{ $message->fullname }}</h2>
      </header>
      <div class="p-3">

        <div class="p-6">
          <table class="table-auto w-full border-collapse border border-gray-300 mb-8">
            <tr>
              <td class="font-bold text-base border px-4 py-2">Nombre completo:</td>
              <td class="text-sm border px-4 py-2">{{ $message->fullname }}</td>
              <td class="font-bold text-base border px-4 py-2">Tipo de documento:</td>
              <td class="text-sm border px-4 py-2">{{ $message->type_document }}</td>
            </tr>
            <tr>
              <td class="font-bold text-base border px-4 py-2">Numero de documento:</td>
              <td class="text-sm border px-4 py-2">{{ $message->number_document }}</td>
              <td class="font-bold text-base border px-4 py-2">Telefono:</td>
              <td class="text-sm border px-4 py-2">{{ $message->cellphone }}</td>
            </tr>
            <tr>
              <td class="font-bold text-base border px-4 py-2">Correo:</td>
              <td class="text-sm border px-4 py-2">{{ $message->email }}</td>
              <td class="font-bold text-base border px-4 py-2">Departamento:</td>
              <td class="text-sm border px-4 py-2">{{ $departamento[0]->description }}</td>
            </tr>
            <tr>
              <td class="font-bold text-base border px-4 py-2">Provincia:</td>
              <td class="text-sm border px-4 py-2">{{ $provinces[0]->description }}</td>
              <td class="font-bold text-base border px-4 py-2">Distrito:</td>
              <td class="text-sm border px-4 py-2">{{ $distritos[0]->description }}</td>
            </tr>
            <tr>
              <td class="font-bold text-base border px-4 py-2">Direccion:</td>
              <td class="text-sm border px-4 py-2">{{ $message->address }}</td>
              <td class="font-bold text-base border px-4 py-2">Producto o Servicio:</td>
              <td class="text-sm border px-4 py-2">{{ $message->typeitem }}</td>
            </tr>
            <tr>
              <td class="font-bold text-base border px-4 py-2">Monto total:</td>
              <td class="text-sm border px-4 py-2">{{ $message->amounttotal }}</td>
              <td class="font-bold text-base border px-4 py-2">Categoria de producto o servicio:</td>
              <td class="text-sm border px-4 py-2">{{ $message->category_product_service }}</td>
            </tr>
            <tr>
              <td class="font-bold text-base border px-4 py-2">Detalle de producto o servicio:</td>
              <td class="text-sm border px-4 py-2">{{ $message->description }}</td>
              <td class="font-bold text-base border px-4 py-2">Queja o Reclamo:</td>
              <td class="text-sm border px-4 py-2">{{ $message->type_claim }}</td>
            </tr>
            <tr>
              <td class="font-bold text-base border px-4 py-2">Fecha de ocurrencia:</td>
              <td class="text-sm border px-4 py-2">{{ $message->date_incident }}</td>
              <td class="font-bold text-base border px-4 py-2">Numero de pedido:</td>
              <td class="text-sm border px-4 py-2">{{ $message->address_incident }}</td>
            </tr>
            <tr>
              <td class="font-bold text-base border px-4 py-2">Detalle de reclamo:</td>
              <td class="text-sm border px-4 py-2">{{ $message->detail_incident }}</td>
              <td class="text-sm border px-4 py-2" colspan="2"></td>
            </tr>
          </table>

          <a href="{{ route('reclamo.index') }}" class="bg-blue-500 px-4 py-2 rounded text-white "><span><i
                class="fa-solid fa-arrow-left mr-2"></i></span> Volver</a>

        </div>
      </div>
    </div>

  </div>



</x-app-layout>
