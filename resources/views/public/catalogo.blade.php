@extends('components.public.matrix')
@section('title', 'Catalogo | ' . config('app.name', 'Laravel'))

@section('css_importados')

@stop


@section('content')

  <main class="flex flex-col gap-12 -mb-12">

    {{-- <section class="flex gap-2 items-center w-11/12 mx-auto">
            <a href="#" class="font-regularDisplay text-text20 xl:text-text24 text-gray-500 leading-none">
                Home
            </a>
            <div class="flex justify-center items-center">
                <img src="{{asset('images/svg/flecha.svg')}}" alt="doomine" />
            </div>
            <a href="#" class="font-mediumDisplay text-text20 xl:text-text24 text-black leading-none">
                Categorías
            </a>
        </section> --}}
    <!--  -->

    <div class="w-11/12 mx-auto mt-10">
      <div class="grid grid-cols-2 row-span-2 md:grid-cols-4 lg:row-span-1 gap-2 md:gap-0">
        <div class="order-3 md:order-1 flex justify-between md:pr-2 items-center">
          <p class="font-boldDisplay text-[20px] xl:text-text28 hidden md:block">
            Categorías
          </p>
          <div class="flex justify-center items-center open">
            <img src="{{ asset('images/svg/catalogo_filtro_icon.svg') }}" alt="logo_filtros" />
          </div>
        </div>
        <form id="FilterForm" method="post" action="" class="hidden">
          @csrf
          <input type="hidden" name="categories_id" value="{{ $filtro }}" id="get_categories"
            data-filtro=".changeCategory">
          <input type="hidden" name="precio_id" id="get_precios" data-filtro=".changePrice">
          <input type="hidden" name="talla_id" id="get_tallas" data-filtro=".changeTallas">
          <input type="hidden" name="color_id" id="get_colores" data-filtro=".changeCollection">
          <input type="hidden" name="coleccion_id" id="get_colecciones" data-filtro=".changeColor">
          <input type="hidden" name="orderPrice" id="orderPrice">
        </form>
        <div class="md:pl-9 order-1 md:order-2 flex items-center">
          <h3 class="font-boldItalicDisplay text-text20 md:text-text24 text-left w-full lg:w-auto">
            @if ($filtro == 0)
              / Productos /
            @else
              / Productos - {{ $categoria->name }} /
            @endif
          </h3>
        </div>

        <div class="flex items-center gap-2 order-4 md:order-3 justify-end md:pr-5">
          <p class="text-[#CCCCCC] font-regularDisplay text-text14 md:text-text18">
            Mostrando <span>1</span>-<span>20</span> de
            <span>100</span> productos
          </p>
        </div>

        <div class="dropdown w-full order-2 md:order-4">
          <div
            class="input-box focus:outline-none font-mediumDisplay text-text16 md:text-text20 mr-20 shadow-md px-2 bg-[#F5F5F5]">
            Ordenar por
          </div>
          <div class="list z-[10]">
            <div class="w-full">
              <input type="radio" name="drop1" id="id11" class="radio" value="price_high" />

              <label for="id11"
                class="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar">
                <span class="name inline-block w-full">Precio más alto</span>
              </label>
            </div>

            <div class="w-full">
              <input type="radio" name="drop1" id="id12" class="radio" value="price_low" />
              <label for="id12"
                class="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white ordenar">
                <span class="name inline-block w-full">
                  Precio más bajo
                </span>
              </label>
            </div>

            <div class="w-full">
              <input type="radio" name="drop1" id="id13" class="radio" value="more_old" />
              <label for="id13"
                class="font-regularDisplay text-text20 hover:font-bold md:duration-100 hover:text-white comentar">
                <span class="name inline-block w-full"> Antiguo </span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  -->

    <div class="flex flex-col md:flex-row md:gap-10 w-11/12 mx-auto font-poppins">
      <aside class="flex flex-col gap-10 md:basis-3/12">

        <div class="hidden-categoria-precio">
          <div class="hidden md:flex flex-col gap-10 show-categoria-precio">
            <div class="flex flex-col gap-2 text-text18 xl:text-text20">
              <div class="font-regularDisplay flex justify-start gap-2 items-center w-full">
                <a href="/catalogo/0" class="{{ $filtro == 0 ? 'font-semibold underline' : 'text-black' }}">Todas</a>
              </div>

              @foreach ($categorias as $item)
                {{-- <a href="/catalogo/{{ $item->id }}">
                  <div
                    class="font-boldDisplay flex justify-start gap-2 items-center w-full @if ($filtro == 0) @else {{ $item->id == $categoria->id ? 'font-semibold underline text-black' : '' }} @endif ">
                    {{ $item->name }}
                  </div>
                </a> --}}
                <div class="flex justify-start gap-2 items-center w-full">
                  <input type="checkbox" value="{{ $item->id }}" class="changeCategory"
                    id="categoria_{{ $item->id }}">
                  <label for="categoria_{{ $item->id }}"
                    class="font-boldDisplay flex justify-start gap-2 items-center w-full">
                    {{ $item->name }}
                  </label>
                </div>
              @endforeach

            </div>

            <div>
              <div class="relative">
                <div class="mx-auto">
                  <div class="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                    <details class="group">
                      <summary class="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                        <span class="font-boldDisplay text-text20 text-[#151515]">
                          Precio
                        </span>
                        <span class="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <div class="group-open:animate-fadeIn mt-5">
                        <div class="flex flex-col gap-2 text-text18 xl:text-text20">

                          <div class="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="0_50" class="changePrice" id="price_0_50">
                            <label for="price_0_50" class="cursor-pointer">
                              S/0 - S/50
                            </label>
                          </div>

                          <div class="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="50.01_100" class="changePrice" id="price_51_100">
                            <label for="price_51_100" class="cursor-pointer">
                              S/50 - S/100
                            </label>
                          </div>

                          <div class="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="100.01_150" class="changePrice" id="price_101_150">
                            <label for="price_101_150" class="cursor-pointer">
                              S/100 - S/150
                            </label>
                          </div>

                          <div class="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="150.01_200" class="changePrice" id="price_151_200">
                            <label for="price_151_200" class="cursor-pointer">
                              S/150 - S/200
                            </label>
                          </div>

                          <div class="font-regularDisplay flex justify-start gap-2 items-center w-full">
                            <input type="checkbox" value="200.01_100000" class="changePrice" id="price_200_more">
                            <label for="price_200_more" class="cursor-pointer">
                              S/200 - Más
                            </label>
                          </div>
                        </div>
                      </div>
                    </details>
                  </div>
                </div>
              </div>
            </div>
            @foreach ($atributos as $item)
              @php
                $nametypeatributo = $item->typeAttribute->name;
              @endphp
              @if ($nametypeatributo === 'Color')
                <div>
                  <div class="relative">
                    <div class="mx-auto">
                      <div class="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                        <details class="group">
                          <summary class="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                            <span class="font-boldDisplay text-text20 text-[#151515]">
                              {{ $item->titulo }}
                            </span>
                            <span class="transition group-open:rotate-180">
                              <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                  d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                                  fill="black" />
                                <path
                                  d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                                  fill="black" />
                              </svg>
                            </span>
                          </summary>

                          <div class="group-open:animate-fadeIn mt-5">
                            <div class="grid grid-rows-1 gap-4 place-items-start">
                              @foreach ($item->attributeValues as $valores)
                                <div class="flex flex-row justify-start items-center text-center gap-2">
                                  <a href="javascript:;" id="{{ $valores->id }}" class="changeColor rounded-full"
                                    data-val="0" style="background-color:{{ $valores->color }};">
                                    <span class="block w-5 h-5 rounded-full transition"></span>
                                  </a>

                                  <span> {{ $valores->valor }}</span>



                                </div>
                              @endforeach

                              {{-- <div class="relative">
                              <input type="checkbox" name="{{ $item->titulo }}[]" value="{{ $valores->valor }}" 
                                     id="color_{{ $valores->id }}" class="hidden colores">
                              <label for="color_{{ $valores->id }}" 
                                     style="background-color: {{ $valores->color }};" 
                                     class="block w-12 h-12 rounded-full cursor-pointer border-2 transition labelcolor"></label>
                            </div> --}}

                            </div>
                          </div>
                        </details>
                      </div>
                    </div>
                  </div>
                </div>
              @else
                <div>
                  <div class="relative">
                    <div class="mx-auto">
                      <div class="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                        <details class="group">
                          <summary class="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                            <span class="font-boldDisplay text-text20 text-[#151515]">
                              {{ $item->titulo }}
                            </span>
                            <span class="transition group-open:rotate-180">
                              <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                  d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                                  fill="black" />
                                <path
                                  d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                                  fill="black" />
                              </svg>
                            </span>
                          </summary>

                          <div class="group-open:animate-fadeIn mt-5">
                            <div class="flex flex-col gap-2 text-text18 xl:text-text20">
                              @foreach ($item->attributeValues as $valores)
                                <div class="font-regularDisplay flex justify-start gap-2 items-center w-full">
                                  {{-- <a href="?{{$item->titulo}}={{$valores->valor}}"
                                    class="cursor-pointer">
                                    {{$valores->valor}}
                                  </a> --}}
                                  <input type="checkbox" value="{{ $valores->id }}" class="changeTallas"
                                    id="talla_{{ $valores->id }}">
                                  <label for="talla_{{ $valores->id }}"
                                    class="font-boldDisplay flex justify-start gap-2 items-center w-full">
                                    {{ $valores->valor }}
                                  </label>
                                </div>
                              @endforeach
                            </div>
                          </div>
                        </details>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endforeach

            <div>
              <div class="relative">
                <div class="mx-auto">
                  <div class="mx-auto grid max-w-[900px] divide-y divide-neutral-200">
                    <details class="group">
                      <summary class="flex cursor-pointer list-none items-center justify-between font-medium pr-1">
                        <span class="font-boldDisplay text-text20 text-[#151515]">
                          Colecciones
                        </span>
                        <span class="transition group-open:rotate-180">
                          <svg width="20" height="20" viewBox="0 0 12 13" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M1.17736 3.72824C1.51789 3.3994 2.06052 3.40886 2.38937 3.74939L7.15275 8.68202L5.91958 9.87288L1.1562 4.94025C0.827356 4.59972 0.836834 4.05708 1.17736 3.72824Z"
                              fill="black" />
                            <path
                              d="M4.84668 8.67969L9.61006 3.74706C9.9389 3.40653 10.4815 3.39707 10.8221 3.72591C11.1626 4.05475 11.1721 4.59739 10.8432 4.93791L6.07985 9.87054L4.84668 8.67969Z"
                              fill="black" />
                          </svg>
                        </span>
                      </summary>

                      <div class="group-open:animate-fadeIn mt-5">
                        <div class="flex flex-col gap-2 text-text18 xl:text-text22">

                          @foreach ($colecciones as $item)
                            <div class="font-regularDisplay flex justify-start gap-2 items-center w-full">
                              <input type="checkbox" id="collection_{{ $item->id }}" value="{{ $item->id }}"
                                class="w-4 h-4 accent-[#000000] cursor-pointer changeCollection" />
                              <label for="collection_{{ $item->id }}" class="cursor-pointer">
                                {{ $item->name }}
                              </label>
                            </div>
                          @endforeach

                        </div>
                      </div>
                    </details>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </aside>
      <!-- modal filtros -->
      <!-- <a class="mostrar-modal">Filtrossss</a> -->
      <div class="modal-filtros z-[100]">
        <div class="modal__mostrar-filtro">
          <div class="flex justify-between">
            <p class="font-boldDisplay text-[20px]">Categorías</p>
            <a href="#" class="modal__close-filtro">
              <img src="{{ asset('images/svg/close.svg') }}" alt="close" />
            </a>
          </div>
          <div class="overflow-y-scroll h-[500px] scroll__categorias">
            <div class="addCategoriaPrecio flex flex-col gap-5"></div>
          </div>
        </div>
      </div>

      <!-- Listado de productos- -->
      <div id="getProductAjax" class="grid gap-10">
        @include('public._listproduct')
      </div>
    </div>
    <div class="flex justify-center items-center">
      <a href="javascript:;" @if (empty($page)) style="display:none;" @endif
        data-page={{ $page }}
        class="text-textBlack py-3 px-5 border-2 border-gray-700 rounded-3xl w-60 text-center font-medium text-text16 cargarMas">
        Cargar más modelos
      </a>
    </div>
    <section>
      <div>
        <img src="{{ asset('images/img/catalogo_1.png') }}" alt="doomine" class="w-full h-full hidden md:block" />
      </div>
    </section>
  </main>


@section('scripts_importados')

  <script>
    $(document).ready(function() {



    });
  </script>

  <script>
    var appUrl = '{{ env('APP_URL') }}';
  </script>


  <script src="{{ asset('js/carrito.js') }}"></script>

  <script>
    function pintarOpcionesChecked() {

      $('[data-filtro]').each(function() {
        const values = $(this).val().split(',')
        const selector = $(this).attr('data-filtro')
        $(selector).each(function() {
          if (values.includes(this.value)) {
            $(this).prop('checked', true);
          }
        });
      })

    }

    $(document).ready(function() {
      // Captura el click de abrir
      const modal = document.querySelector(".modal-filtros");
      const closeModal = document.querySelector(".modal__close-filtro");
      const body = document.querySelector(".body");

      const hiddenCategoriaPrecio = document.querySelector(".hidden-categoria-precio");
      const open = document.querySelector(".open");
      const showCategoriaPrecio = document.querySelector(".show-categoria-precio");
      const addCategoriaPrecio = document.querySelector(".addCategoriaPrecio");
      let openModal = null;

      function getWidth() {
        let width = window.innerWidth;
        if (width < 768) {
          open.classList.add("mostrar-modal", "cursor-pointer");
          openModal = document.querySelector(".mostrar-modal");
          openModal.addEventListener("click", showModal);
          hiddenCategoriaPrecio.innerHTML = "";
        } else {
          open.classList.remove("mostrar-modal", "cursor-pointer");
          if (openModal) {
            openModal.removeEventListener("click", showModal);
            showCategoriaPrecio.classList.remove("hidden");
            hiddenCategoriaPrecio.innerHTML = showCategoriaPrecio.innerHTML;
          }
        }
      }

      function showModal(e) {
        e.preventDefault();
        if (showCategoriaPrecio) {
          addCategoriaPrecio.innerHTML = showCategoriaPrecio.innerHTML;
        }
        hiddenCategoriaPrecio.innerHTML = "";

        modal.classList.add("modal--show-filtro");
        body.classList.add("overflow-hidden");

        modal.style.display = "flex";
        pintarOpcionesChecked();
        updateCategoriesField();
      }

      getWidth();
      window.addEventListener("resize", getWidth);

      closeModal.addEventListener("click", (e) => {
        e.preventDefault();
        modal.classList.remove("modal--show-filtro");
        body.classList.remove("overflow-hidden");
      });

      function closeModa(event) {
        if (event.target === modal) {
          modal.classList.remove("modal--show-filtro");
          body.classList.remove("overflow-hidden");
        }
      }

      window.addEventListener("click", closeModa);

      pintarOpcionesChecked();

      function updateCategoriesField() {
        var selectedCategories = [];
        $('.changeCategory:checked').each(function() {
          selectedCategories.push($(this).val());
        });
        const values = selectedCategories.join(',');
        // history.pushState(null, null, `/catalogo/${values}`);
        $('#get_categories').val(values);
      }

      // updateCategoriesField();

      $(document).on('change', '.changeCategory', function() {
        updateCategoriesField();
        FilterForm();
      });

      function updatePriceField() {
        var selectedPrice = [];
        $('.changePrice:checked').each(function() {
          selectedPrice.push($(this).val());
        });
        $('#get_precios').val(selectedPrice.join(','));
      }

      // updatePriceField();
      $(document).on('change', '.changePrice', function() {
        updatePriceField();
        FilterForm();
      });

      function updateTallaField() {
        var selectedTallas = [];
        $('.changeTallas:checked').each(function() {
          selectedTallas.push($(this).val());
        });
        $('#get_tallas').val(selectedTallas.join(','));
      }

      // updateTallaField();
      $(document).on('change', '.changeTallas', function() {
        updateTallaField();
        FilterForm();
      });

      function updateCollectionField() {
        var selectedCollection = [];
        $('.changeCollection:checked').each(function() {
          selectedCollection.push($(this).val());
        });
        $('#get_colecciones').val(selectedCollection.join(','));
      }

      // updateCollectionField();
      $(document).on('change', '.changeCollection', function() {
        updateCollectionField();
        FilterForm();
      });

      $(document).on('change', '.colores', function() {
        if ($(this).is(':checked')) {
          $('.labelcolor').addClass('border-black');
        } else {
          $('.labelcolor').removeClass('border-black');
        }
      });

      $('.colores:checked').each(function() {
        $(this).next('labelcolor').addClass('border-black');
      });

      $('.changeColor').click(function() {
        var id = $(this).attr('id');
        var status = $(this).attr('data-val');
        if (status == 0) {
          $(this).attr('data-val', 1);
          $(this).addClass('active-color');
        } else {
          $(this).attr('data-val', 0);
          $(this).removeClass('active-color');
        }

        var ids = '';
        $('.changeColor').each(function() {
          var status = $(this).attr('data-val');
          if (status == 1) {
            var id = $(this).attr('id');
            ids += id + ',';
          }
        });
        $('#get_colores').val(ids);
        FilterForm();
      });

      function FilterForm() {
        //Valida si hay un query en la url para agregar el valor al orderPrice





        $.ajax({
          url: '{{ route('catalogo_filtro_ajax') }}',
          method: 'POST',
          data: $('#FilterForm').serialize(),
          dataType: "json",
          success: function(response) {
            $('#getProductAjax').html(response.success);
            $('.cargarMas').attr('data-page', response.page);

            if (response.page == 0) {
              $('.cargarMas').hide();
            } else {
              $('.cargarMas').show();
            }
          },
          error: function(error) {}
        });
      }

      $('body').delegate('.cargarMas', 'click', function() {
        var url = window.location.href;
        var query = url.split('?');
        if (query != '') {
          console.log('entro here')
          var query = query[1].split('=');
          if (query[0] == 'priceOrder') {
            $('#orderPrice').val(query[1]);
          }
        }
        var page = $(this).attr('data-page');
        $('.cargarMas').html('Cargando...');
        $.ajax({
          url: "{{ route('catalogo_filtro_ajax') }}?page=" + page,
          method: 'POST',
          data: $('#FilterForm').serialize(),
          dataType: "json",
          success: function(response) {
            $('#getProductAjax').append(response.success);
            $('.cargarMas').attr('data-page', response.page);
            $('.cargarMas').html('Cargar más modelos');
            if (response.page == 0) {
              $('.cargarMas').hide();
            } else {
              $('.cargarMas').show();
            }
          },
          error: function(error) {}
        });
      });
    });
  </script>
  <script>
    $('input[type="radio"][name="drop1"]').change(function() {
      // Obtén el valor del radio seleccionado
      var selectedValue = $(this).val();
      // Acción a realizar con el valor, por ejemplo, mostrar en consola
      var currentUrl = window.location.href;

      // Acción a realizar con la URL, por ejemplo, mostrar en consola
      console.log("URL actual: " + currentUrl);

      $("#orderPrice").val(selectedValue);

      // Opcional: Modificar la URL con el valor seleccionado y recargar la página
      // Esto es solo un ejemplo, ajusta según tus necesidades
      var newUrl = new URL(currentUrl);
      newUrl.searchParams.set('priceOrder', selectedValue); // Añade o actualiza el parámetro 'priceOrder'
      window.location.href = newUrl.toString(); // Cambia la URL y recarga la página

    });
  </script>
@stop

@stop
