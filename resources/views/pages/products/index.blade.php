<x-app-layout>

  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <section class="py-4 border-b border-slate-100 dark:border-slate-700">
      <a href="{{ route('products.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm">
        Agregar producto
      </a>
      <div class="flex justify-end mt-3">
        <button id="imprimirPedido" type="button"
          class="bg-blue-500  hover:bg-blue-700 w-48  px-4 py-2 rounded text-white flex justify-between align-content-center content-center items-center ">
          Detalle Productos
          <div class="w-4 justify-center align-content-center">
            <svg xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
              <path fill="#FFFFFF"
                d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
            </svg>
          </div>

        </button>

      </div>
    </section>


    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">


      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Productos </h2>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">

          <table id="tabladatos" class="display text-lg" style="width:100%">
            <thead>
              <tr>
                <th>Orden</th>
                <th>Producto</th>
                {{-- <th>Extracto</th> --}}
                {{-- <th>Descripcion</th> --}}
                <th>Precio</th>
                <th>Descuento</th>
                {{-- <th>Costo por articulo</th> --}}
                <th>Stock</th>
                {{-- <th>Peso</th> --}}
                <th>Imagen</th>
                <th>Galeria</th>

                <th>Lo más pedido</th>
                <th>Novedad</th>
                <th>Liquidacion</th>
                <th>Visible</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($products as $index => $item)
                <tr>
                  <td>{{ $item->order }}</td>
                  <td>{{ $item->producto }}</td>
                  {{-- <td>{{ $item->extract }}</td> --}}
                  {{-- <td>{{ $item->description }}</td> --}}
                  <td>{{ $item->precio }}</td>
                  <td>{{ $item->descuento }}</td>
                  {{-- <td>{{ $item->costo_x_art }}</td> --}}
                  <td>
                    @php
                      // Declara la variable de ámbito local antes del bucle
                      $totalStock = 0;
                    @endphp

                    @foreach ($item->combinations as $comb)
                      @php
                        // Suma el stock actual al total
                        $totalStock += $comb->stock;
                      @endphp

                      <!-- Aquí puedes poner el código HTML que necesitas para cada combinación -->
                    @endforeach

                    <!-- Después del bucle, puedes usar la variable totalStock -->
                    <p>{{ $totalStock }}</p>
                  </td>
                  {{-- <td>{{ $item->peso }}</td> --}}
                  <td class="px-3 py-2">
                    @foreach ($item->images as $imagen)
                      @if ($imagen->caratula == 1)
                        <img class="w-20" src="{{ asset($imagen->name_imagen) }}" alt="">
                      @endif
                    @endforeach


                  </td>
                  <td id="{{ $item->id }}">
                    @if ($item->images->count() > 0)
                      <!-- Botón para abrir el modal -->
                      <div class="cursor-pointer bg-green-300 px-3 py-2 rounded text-white hover:bg-green-600 w-10"
                        onclick="openModal({{ $item->images }} , '{{ config('app.url') }}')">
                        <i class="fa-regular fa-eye"></i>
                      </div>
                    @endif
                  </td>
                  <td>
                    <form method="POST" action="">
                      @csrf
                      <input type="checkbox" id="hs-basic-usage"
                        class="check_v btn_swithc relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent 
                              rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none 
                              checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700 
                              dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6
                              before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow 
                              before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200"
                        id='{{ 'v_' . $item->id }}' data-field='destacar' data-idService='{{ $item->id }}'
                        data-titleService='{{ $item->producto }}' {{ $item->destacar == 1 ? 'checked' : '' }}>
                      <label for="{{ 'v_' . $item->id }}"></label>
                    </form>
                  </td>
                  <td>
                    <form method="POST" action="">
                      @csrf
                      <input type="checkbox" id="hs-basic-usage"
                        class="check_v btn_swithc relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent 
                              rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none 
                              checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700 
                              dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6
                              before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow 
                              before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200"
                        id='{{ 'v_' . $item->id }}' data-field='recomendar' data-idService='{{ $item->id }}'
                        data-titleService='{{ $item->producto }}' {{ $item->recomendar == 1 ? 'checked' : '' }}>
                      <label for="{{ 'v_' . $item->id }}"></label>
                    </form>
                  </td>
                  <td>
                    <form method="POST" action="">
                      @csrf
                      <input type="checkbox" id="hs-basic-usage"
                        class="check_v btn_swithc relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent 
                              rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none 
                              checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700 
                              dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6
                              before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow 
                              before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200"
                        id='{{ 'v_' . $item->id }}' data-field='liquidacion' data-idService='{{ $item->id }}'
                        data-titleService='{{ $item->producto }}' {{ $item->liquidacion == 1 ? 'checked' : '' }}>
                      <label for="{{ 'v_' . $item->id }}"></label>
                    </form>
                  </td>
                  <td>
                    <form method="POST" action="">
                      @csrf
                      <input type="checkbox" id="switch_visible"
                        class="check_v btn_swithc relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent 
                              rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none 
                              checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700 
                              dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6
                              before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow 
                              before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200"
                        id='{{ 'v_' . $item->id }}' data-field='visible' data-idService='{{ $item->id }}'
                        data-titleService='{{ $item->producto }}' {{ $item->visible == 1 ? 'checked' : '' }}>
                      <label for="{{ 'v_' . $item->id }}"></label>
                    </form>
                  </td>

                  <td class="flex justify-center items-center gap-5 text-center sm:text-right">

                    <a href="{{ route('products.edit', $item->id) }}"
                      class="bg-yellow-400 px-3 py-2 rounded text-white  "><i
                        class="fa-regular fa-pen-to-square"></i></a>

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
                <th>Orden</th>
                <th>Producto</th>
                {{-- <th>Extracto</th> --}}
                {{-- <th>Descripcion</th> --}}
                <th>Precio</th>
                <th>Descuento</th>
                {{-- <th>Costo por articulo</th> --}}
                <th>Stock</th>
                {{-- <th>Peso</th> --}}
                <th>Imagen</th>
                <th>Galeria</th>
                <th>Lo más pedido</th>
                <th>Novedad</th>
                <th>Liquidacion</th>
                <th>Visible</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>

  </div>
  {{--  <x-modal.content id="landings-modal" title="Nueva landing" btn-submit-text="Guardar" size="xl">
    <div class="grid gap-4 grid-cols-2">
      <div>

      </div>
      <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
          Previsualizacion
        </label>
        <iframe class="shadow rounded-md" id="modal-previewer" src=""
          style="width: 100%; height: 330px; border: none;"></iframe>
      </div>
    </div>
  </x-modal.content> --}}






</x-app-layout>


<!-- Fondo oscuro -->
<div id="modalImg" class="hidden">
  <div class=" fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity"></div>

  <!-- Modal -->
  <div class=" fixed inset-0 z-30 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div
        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">

            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
              <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Visualizar imagenes</h3>
              <div class="mt-2 " id="containerImg">
                {{--  @foreach ($imagenes as $item)
                  <img src="{{ asset($item['name_imagen']) }}" alt="{{ asset($item['name_imagen']) }}"
                    class="w-10 h-10 object-cover">
                @endforeach --}}
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <button onclick="closeModal()" type="button"
            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Cerrar</button>

        </div>
      </div>
    </div>
  </div>

</div>


<script>
  function openModal(imagenes, app_url) {
    // Aquí puedes usar los parámetros `id` y `imagenes` si necesitas personalizar el modal

    let container = document.createElement('div')
    container.classList.add('grid', 'grid-cols-1', 'md:grid-cols-4', 'gap-2', 'mt-2',
      'justify-items-center'); // Agregar clases de grid

    imagenes.forEach(element => {
      let img = document.createElement('img');
      img.setAttribute('src', `${app_url}/${element.name_imagen}`);
      img.classList.add('w-32', 'h-32', 'rounded-xl', 'object-cover'); // Ajustar tamaño y estilo de imagen
      container.appendChild(img);
    });

    $('#containerImg').html(container)

    $('#modalImg').removeClass('hidden');

  }

  function closeModal() {
    $('#modalImg').addClass('hidden');
  }
</script>


<script>
  $(document).ready(function() {
    $(document).on("click", '#btngaleria', function() {

      console.log(this.getAttribute('data-Image'))
    })

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
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 7, 8, 9,
              10
            ], // Aquí especificas los índices de las columnas que quieres exportar
            format: {
              body: function(data, row, column, node) {
                // Si la columna es la que contiene el checkbox, exportar su valor
                if (column === 7 || column === 8 || column === 9 || column ===
                  10) { // Suponiendo que la columna del checkbox es la 7

                  return $(node).find('input[type="checkbox"]').prop('checked') ? 'Si' : 'No';
                }
                // Para el resto de las columnas, devolver el texto tal cual
                return $(node).text();
              }
            }
          },


        },
        {
          extend: 'pdfHtml5',
          text: '<i class="fas fa-file-pdf"></i> ',
          titleAttr: 'Exportar a PDF',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 7, 8, 9,
              10
            ], // Aquí especificas los índices de las columnas que quieres exportar
            format: {
              body: function(data, row, column, node) {
                // Si la columna es la que contiene el checkbox, exportar su valor
                if (column === 7 || column === 8 || column === 9 || column ===
                  10) { // Suponiendo que la columna del checkbox es la 7

                  return $(node).find('input[type="checkbox"]').prop('checked') ? 'Si' : 'No';
                }
                // Para el resto de las columnas, devolver el texto tal cual
                return $(node).text();
              }
            }
          },
        },
        {
          extend: 'csvHtml5',
          text: '<i class="fas fa-file-csv"></i> ',
          titleAttr: 'Imprimir',
          className: 'btn btn-info',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 7, 8, 9,
              10
            ], // Aquí especificas los índices de las columnas que quieres exportar
            format: {
              body: function(data, row, column, node) {
                // Si la columna es la que contiene el checkbox, exportar su valor
                if (column === 7 || column === 8 || column === 9 || column ===
                  10) { // Suponiendo que la columna del checkbox es la 7

                  return $(node).find('input[type="checkbox"]').prop('checked') ? 'Si' : 'No';
                }
                // Para el resto de las columnas, devolver el texto tal cual
                return $(node).text();
              }
            }
          },
        },
        {
          extend: 'print',
          text: '<i class="fa fa-print"></i> ',
          titleAttr: 'Imprimir',
          className: 'btn btn-info',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 7, 8, 9,
              10
            ], // Aquí especificas los índices de las columnas que quieres exportar
            format: {
              body: function(data, row, column, node) {
                // Si la columna es la que contiene el checkbox, exportar su valor
                if (column === 7 || column === 8 || column === 9 || column ===
                  10) { // Suponiendo que la columna del checkbox es la 7

                  return $(node).find('input[type="checkbox"]').prop('checked') ? 'Si' : 'No';
                }
                // Para el resto de las columnas, devolver el texto tal cual
                return $(node).text();
              }
            }
          },
        },
        {
          extend: 'copy',
          text: '<i class="fas fa-copy"></i> ',
          titleAttr: 'Copiar',
          className: 'btn btn-success',
          exportOptions: {
            columns: [0, 1, 2, 3, 4, 7, 8, 9,
              10
            ], // Aquí especificas los índices de las columnas que quieres exportar
            format: {
              body: function(data, row, column, node) {
                // Si la columna es la que contiene el checkbox, exportar su valor
                if (column === 7 || column === 8 || column === 9 || column ===
                  10) { // Suponiendo que la columna del checkbox es la 7

                  return $(node).find('input[type="checkbox"]').prop('checked') ? 'Si' : 'No';
                }
                // Para el resto de las columnas, devolver el texto tal cual
                return $(node).text();
              }
            }
          },
        },
      ]
    });

    $(".btn_swithc").on("change", function() {



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

    $(document).on("click", ".btn_delete", function(e) {
      e.preventDefault()

      let id = $(this).attr('data-idService');

      Swal.fire({
        title: "Seguro que deseas eliminar?",
        text: "Vas a eliminar un Producto",
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
<script>
  $('#imprimirPedido').on("click", function() {
    // Obtén la URL usando Blade
    var url = "{{ route('productos.export') }}";

    // Redirige en una nueva pestaña
    window.open(url, '_blank');
  });
</script>
