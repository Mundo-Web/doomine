<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    {{-- <section class="py-4 border-b border-slate-100 dark:border-slate-700">
      <a href="{{ route('products.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm">
        Agregar producto
      </a>
    </section> --}}


    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">


      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Pedidos </h2>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">

          <table id="tabladatos" class="display text-lg" style="width:100%">
            <thead>
              <tr>
                <th>Codigo de pedido</th>
                <th>Usuario</th>
                <th>Monto de pago</th>
                <th>Costo de envio</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($orders as $item)
                <tr>
                  <td><a href="{{ route('verPedido', $item->id) }}">#{{ $item->codigo_orden }}</a></td>
                  <td>{{ $item->usuarioPedido->email }}</td>
                  <td>{{ $item->monto }}</td>
                  <td>{{ $item->precio_envio }}</td>
                  <td><span
                      class="px-4 py-2 text-center rounded-md
                                        @if ($item->statusOrdenes->descripcion == 'Pendiente') bg-red-500 text-white
                                        @elseif($item->statusOrdenes->descripcion == 'Procesada')
                                            bg-green-500 text-white
                                        @else
                                            bg-gray-200 text-black @endif">
                      {{ $item->statusOrdenes->descripcion }}
                    </span>
                  </td>


                  <td class="flex justify-center items-center gap-5 text-center sm:text-right">

                    <a href="{{ route('verPedido', $item->id) }}" class="bg-green-300 px-3 py-2 rounded text-white  "><i
                        class="fa-regular fa-eye"></i></a>

                    <form action="" method="POST">
                      @csrf
                      <a data-idService='{{ $item->id }}'
                        class="btn_delete bg-red-600 px-3 py-2 rounded text-white cursor-pointer"><i
                          class="fa-regular fa-trash-can"></i></a>
                    </form>

                  </td>
                </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th>Codigo de pedido</th>
                <th>Usuario</th>
                <th>Monto de pago</th>
                <th>Costo de envio</th>
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>

  </div>



</x-app-layout>
<script>
  $('document').ready(function() {

    new DataTable('#tabladatos', {
      //   responsive: true
      // buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      layout: {
        topStart: 'buttons'
      },
      language: {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "sProcessing": "Procesando...",
      },
      buttons: [{
          extend: 'excelHtml5',
          text: '<i class="fas fa-file-excel"></i> ',
          titleAttr: 'Exportar a Excel',
          className: 'btn btn-success',
        },
        {
          extend: 'pdfHtml5',
          text: '<i class="fas fa-file-pdf"></i> ',
          titleAttr: 'Exportar a PDF',
        },
        {
          extend: 'csvHtml5',
          text: '<i class="fas fa-file-csv"></i> ',
          titleAttr: 'Imprimir',
          className: 'btn btn-info',
        },
        {
          extend: 'print',
          text: '<i class="fa fa-print"></i> ',
          titleAttr: 'Imprimir',
          className: 'btn btn-info',
        },
        {
          extend: 'copy',
          text: '<i class="fas fa-copy"></i> ',
          titleAttr: 'Copiar',
          className: 'btn btn-success',
        },
      ]
    });

    $(document).on("change", ".btn_swithc", function() {



      let status = 0;
      let id = $(this).attr('data-idService');
      let titleService = $(this).attr('data-titleService');
      let field = $(this).attr('data-field');

      if ($(this).is(':checked')) {
        status = 1;
      } else {
        status = 0;
      }

      console.log(titleService)

      $.ajax({
        url: "{{ route('products.updateVisible') }}",
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          status: status,
          id: id,
          field: field,
          titleService
        }
      }).done(function(res) {

        Swal.fire({
          position: "top-end",
          icon: "success",
          title: titleService + " a sido modificado",
          showConfirmButton: false,
          timer: 1500

        });

      })
    });

    $(".btn_delete").on("click", function(e) {
      e.preventDefault()

      let id = $(this).attr('data-idService');

      Swal.fire({
        title: "Seguro que deseas eliminar?",
        text: "Vas a eliminar un Logo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, borrar!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({

            url: `{{ route('products.borrar') }}`,
            method: 'POST',
            data: {
              _token: $('input[name="_token"]').val(),
              id: id,

            }

          }).done(function(res) {

            Swal.fire({
              title: res.message,
              icon: "success"
            });

            location.reload();

          })


        }
      });

    });

  })
</script>
