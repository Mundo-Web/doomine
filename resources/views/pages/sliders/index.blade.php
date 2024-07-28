<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <section class="py-4 border-b border-slate-100 dark:border-slate-700">
      <a href="{{ route('slider.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm">Agregar slider</a>
    </section>


    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">


      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Sliders</h2>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">

          <table id="tabladatos" class="display text-lg" style="width:100%">
            <thead>
              <tr>
                <th>Titulo</th>
                <th>Imagen (Izquierda)</th>
                <th>Imagen (Derecha)</th>
                <th>Visible</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($slider as $item)
                <tr>
                  <td>{{ $item->title }}</td>
                  <td class="px-3 py-2"><img class="w-16" src="{{ asset($item->url_image . $item->name_image) }}"
                      alt=""></td>
                  <td class="px-3 py-2"><img class="w-16" src="{{ asset($item->url_image2 . $item->name_image2) }}"
                      alt=""></td>
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
                        id='{{ 'v_' . $item->id }}' data-field='visible' data-idSlider='{{ $item->id }}'
                        data-titleSlider='{{ $item->title }}' {{ $item->visible == 1 ? 'checked' : '' }}>
                      <label for="{{ 'v_' . $item->id }}"></label>
                    </form>



                  </td>
                  <td class="flex flex-row justify-end items-center gap-5">

                    <a href="{{ route('slider.edit', $item->id) }}"
                      class="bg-yellow-400 px-3 py-2 rounded text-white  "><i
                        class="fa-regular fa-pen-to-square"></i></a>
                    {{-- {{  route('servicios.destroy', $item->id) }} --}}
                    <form action=" " method="POST">
                      @csrf
                      <a data-idService='{{ $item->id }}'
                        class="btn_delete bg-red-600 px-3 py-2 rounded text-white cursor-pointer"><i
                          class="fa-regular fa-trash-can"></i></a>
                      <!-- <a href="" class="bg-red-600 p-2 rounded text-white"><i class="fa-regular fa-trash-can"></i></a> -->
                    </form>

                  </td>
                </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th>Titulo</th>
                <th>Imagen (Izquierda)</th>
                <th>Imagen (Derecha)</th>
                <th>Visible</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>

  </div>

  <script>
    $('document').ready(function() {

      new DataTable('#tabladatos', {
        responsive: true
      });

      $(".btn_delete").on("click", function(e) {

        var id = $(this).attr('data-idService');

        Swal.fire({
          title: "Seguro que deseas eliminar?",
          text: "Vas a eliminar un slider",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, borrar!",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({

              url: '{{ route('slider.deleteSlider') }}',
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


      $(document).on("change", ".btn_swithc", function() {

        var status = 0;
        var id = $(this).attr('data-idSlider');
        let contenedor = $(this);
        var titleSlider = $(this).attr('data-titleSlider');
        var field = $(this).attr('data-field');

        if ($(this).is(':checked')) {
          status = 1;
        } else {
          status = 0;
        }



        $.ajax({
          url: "{{ route('slider.updateVisible') }}",
          method: 'POST',
          data: {
            _token: $('input[name="_token"]').val(),
            status: status,
            id: id,
            field: field,
          },
          success: function(response) {
            Swal.fire({
              position: "top-end",
              icon: "success",
              title: 'Slider Activado',
              showConfirmButton: false,
              timer: 1500

            });



          },
          error: function(response) {

            Swal.close();
            Swal.fire({
              title: response.responseJSON.message,
              icon: "error",
            });

            contenedor[0].checked = !contenedor[0].checked;

          }
        })



      });
    })
  </script>

</x-app-layout>
