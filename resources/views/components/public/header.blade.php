<header>
  <div class="bg-bgBlack font-medium text-text14 xl:text-text18 italic">
    @if ($generalinfo->is_active_discount)
      <p class="text-textWhite py-5 text-center">
        {{ $generalinfo->text_banner }}
        <a href="{{ route('register') }}" class="underline font-bold">
          Regístrate ahora
        </a>
      </p>
    @endif

  </div>
  <div
    class="grid grid-cols-8 md:grid-cols-12 grid-rows-2 xl:grid-cols-12 xl:grid-rows-1 w-11/12 mx-auto my-10 gap-5 xl:gap-0">
    <div class="col-span-5 md:col-span-9 xl:col-span-2 order-1 xl:order-1 flex items-center">
      <a href="{{ route('index') }}">
        <img src="{{ asset('images/img/logo3x.png') }}" alt="doomine" />
      </a>
    </div>

    <nav class="nav col-span-1 xl:col-span-7 order-3 xl:order-2 flex justify-end xl:justify-center xl:items-center">
      <label for="menu" class="nav__label">
        <div>
          <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 18H20M4 12H20M4 6H20" stroke="black" stroke-width="2" stroke-linecap="round" />
          </svg>
        </div>

      </label>

      <input type="checkbox" id="menu" class="nav__input" />

      <div class="nav__menu text-textBlack w-full z-[100]">
        <div class="flex justify-end w-full pr-10">
          <label for="menu" class="nav__label">
            <img src="{{ asset('images/svg/close.svg') }}" class="nav__img" />
          </label>
        </div>

        <div class="nav__menu-center">
          <p class="font-boldDisplay text-text32 italic block xl:hidden my-5">
            Navegar
          </p>
          <div class="menues flex flex-col justify-center">
            <!-- Menu movil -->
            <div class="menu__desplegable-categorias toggleDropdownCategorias">
              <div class="flex items-center gap-5 xl:gap-3 cursor-pointer py-5 xl:py-0">
                <span
                  class="font-mediumDisplay text-text20 lg:text-text24 cursor-pointer flex justify-start items-center gap-3 leading-none">
                  Categorías
                </span>
                <span>
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
              </div>

              <div class="dropdown-content font-regularDisplay text-text20 xl:text-text24 rounded-xl">
                @foreach ($submenucategorias as $item)
                  <a href="{{ route('catalogo', $item->id) }}">
                    {{ $item->name }}
                  </a>
                @endforeach
              </div>
            </div>

            <div class="menu__desplegable-collection toggleDropdownCollection">
              <div class="flex items-center gap-5 xl:gap-3 cursor-pointer py-5 xl:py-0">
                <span
                  class="font-mediumDisplay text-text20 lg:text-text24 cursor-pointer flex justify-start items-center gap-3 leading-none">
                  Colecciones
                </span>
                <span>
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
              </div>

              <div class="dropdown-content font-regularDisplay text-text20 xl:text-text24 rounded-xl">
                @foreach ($submenucolecciones as $item)
                  <a href="{{ route('coleccion', $item->id) }}">
                    {{ $item->name }}
                  </a>
                @endforeach
              </div>
            </div>
            <!-- Menu movil fin -->

            <!--  -->
            <a href="{{ route('novedades') }}"
              class="nav__item font-mediumDisplay text-text20 lg:text-text24 py-5 xl:py-0 leading-none">
              New Arrivals
            </a>
            <a href="{{ route('contacto') }}"
              class="nav__item font-mediumDisplay text-text20 lg:text-text24 py-5 xl:py-0 leading-none">
              Contáctanos
            </a>
          </div>
        </div>

        <div class="flex flex-row gap-10 justify-center items-center xl:hidden">
          <a href="#">
            <img src="{{ asset('images/svg/twitter.svg') }}" alt="twitter" />
          </a>

          <a href="#">
            <img src="{{ asset('images/svg/facebook.svg') }}" alt="facebook" />
          </a>

          <a href="#">
            <img src="{{ asset('images/svg/instagram.svg') }}" alt="instagram" />
          </a>
        </div>
      </div>
    </nav>

    <div
      class="col-span-8 md:col-span-12 xl:hidden order-4 xl:order-3 flex justify-end bg-[#F5F5F5] items-center rounded-3xl px-2 gap-2">
      <div>
        <img src="{{ asset('images/svg/lupa.svg') }}" alt="search" />
      </div>
      <input type="text" placeholder="Buscar" id="buscarProducto2"
        class="w-full xl:max-w-sm outline-none bg-[#F5F5F5] font-medium text-text16 border-x-0 border-y-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[0px]" />
      <div id="resultados2" class="bg-white p-[1px] rounded-xl  overflow-y-auto max-h-[300px] shadow-2xl"
        style="  position: absolute; z-index: 50;
  top: 226px;"></div>

    </div>

    <div class="col-span-2 md:col-span-2 xl:col-span-3 order-2 xl:order-4 flex justify-end">
      <div class="flex gap-2 justify-end items-center w-full">
        <button class="hidden md:block openBtn" onclick="openSearch()">
          <img src="{{ asset('images/svg/lupa.svg') }}" alt="search" class="w-10" />
        </button>

        <div>
          @if (Auth::user() == null)
            <a href="{{ route('login') }}"><img src="{{ asset('images/svg/perfil.svg') }}" alt="user" /></a>
          @else
            <div class="relative inline-flex" x-data="{ open: false }">
              <button class="inline-flex justify-center items-center group" aria-haspopup="true"
                @click.prevent="open = !open" :aria-expanded="open">
                <div class="flex items-center truncate">
                  <span
                    class="truncate ml-2 text-sm font-medium dark:text-slate-300 group-hover:text-slate-800 dark:group-hover:text-slate-200">{{ Auth::user()->name }}</span>
                  <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                    <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                  </svg>
                </div>
              </button>
              <div
                class="origin-top-right z-10 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1"
                @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">
                <ul>
                  <li class="hover:bg-gray-100">
                    <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                      href="{{ route('pedidos') }}" @click="open = false" @focus="open = true"
                      @focusout="open = false">Mis pedidos</a>
                  </li>
                  <li class="hover:bg-gray-100">
                    <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                      href="{{ route('direccion') }}" @click="open = false" @focus="open = true"
                      @focusout="open = false">Dirección</a>
                  </li>
                  <li class="hover:bg-gray-100">
                    <a class="font-medium text-sm text-black flex items-center py-1 px-3"
                      href="{{ route('micuenta') }}" @click="open = false" @focus="open = true"
                      @focusout="open = false">Ajustes</a>
                  </li>
                  <li class="hover:bg-gray-100">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                      @csrf
                      <button type="submit" class="font-medium text-sm text-black flex items-center py-1 px-3"
                        href="{{ route('logout') }}" @click.prevent="$root.submit(); open = false">
                        {{ __('Cerrar sesión') }}
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          @endif
        </div>


        <div>
          <label for="check">
            <img src="{{ asset('images/svg/bag.svg') }}" alt="doomine" class="cursor-pointer" />
          </label>
          <input type="checkbox" class="bag__modal" id="check" />

          <div class="bag hidden absolute top-0 right-0 z-[200] md:w-[600px] cartContainer">
            <!-- class="h-screen overflow-y-scroll " -->
            <div class="p-4 flex flex-col h-screen justify-between">
              <div class="flex justify-between">
                <h2 class="font-mediumDisplay text-[28px] text-[#151515] pb-5">
                  Carrito
                </h2>
                <div id="closeCarrito" class="cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                  </svg>

                </div>
              </div>

              <div class="overflow-y-scroll h-auto scroll__carrito">
                <div class="flex flex-col gap-10" id="itemsCarrito">

                </div>
              </div>

              <div class="font-poppins flex flex-col gap-2 ">
                {{-- <div class="text-[#141718] flex justify-between items-center">
                  <p class="font-regularDisplay text-[16px]">Subtotal</p>
                  <p class="font-boldDisplay text-[16px]">s/ 00.00</p>
                </div> --}}

                <div class="text-[#141718] font-mediumDisplay text-[20px] flex justify-between items-center">
                  <p>Total</p>
                  <p id="itemsTotal"></p>
                </div>
                <div>
                  <a href="/carrito"
                    class="font-boldDisplay text-base bg-bgBlack py-3 px-5 rounded-2xl text-white cursor-pointer w-full inline-block text-center">
                    Checkout
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="flex justify-center items-center font-moderat_700 relative ">
          <img id="imgCantidad" src="{{ asset('images/svg/image_10.svg') }}" alt="bag">
          <span id="spanCantidad" class="text-white absolute"></span>
        </div>
      </div>
    </div>
  </div>

  <!-- whatsapp -->
  <div class="flex justify-end relative">
    <div class="fixed bottom-[36px] z-[10] right-[15px] md:right-[25px]">
      <a href="https://api.whatsapp.com/send?phone={{ $generalinfo->whatsapp }}&text={{ $generalinfo->mensaje_whatsapp }}"
        class="">
        <img src="{{ asset('images/img/WhatsApp.png') }}" alt="whatsapp" class="w-20" />
      </a>
    </div>
  </div>

  <!-- search -->
  <div id="myOverlay" class="overlay" style="z-index: 200;">
    <span class="closebtn" onclick="closeSearch()">×</span>
    <div class="overlay-content w-3/4 md:w-1/2 z-30">
      <form>
        <input type="text" placeholder="Buscar.." name="search" id="buscarproducto" class="rounded-2xl ">
      </form>
      <div id="resultados" class="bg-white p-[1px] rounded-xl  overflow-y-auto max-h-[300px]"></div>
    </div>
  </div>

  <script>
    function openSearch() {
      document.getElementById("myOverlay").style.display = "block";
    }

    function closeSearch() {
      document.getElementById("myOverlay").style.display = "none";
    }

    $(document).ready(function() {
      $('#buscarproducto').keyup(function() {

        var query = $(this).val().trim();

        if (query !== '') {
          $.ajax({
            url: '{{ route('buscar') }}',
            method: 'GET',
            data: {
              query: query
            },
            success: function(data) {
              var resultsHtml = '';
              var url = '{{ asset('') }}';
              console.log(data)
              data.forEach(function(result) {
                resultsHtml +=
                  `
                  <a href="/producto/${result.id}">
                      <div class="w-full flex flex-row py-3 px-5 hover:bg-slate-200">
                          <div class="w-[10%]">
                              <img class="w-14 rounded-md" src="${url}${result?.images[0]?.name_imagen ?? result.imagen}" />
                          </div>
                          <div class="flex flex-col justify-center w-[70%]">
                              <h2 class="text-left">${result.producto}</h2>
                              <p class="text-text12 text-left">Categoría</p>
                          </div>
                          <div class="flex flex-col justify-center w-[10%]">
                              <p class="text-right">S/${result.precio}</p>
                              <p class="text-text12 text-right line-through text-slate-500">S/${result.descuento}</p>
                          </div>
                      </div>
                  </a>
              `;
              });

              $('#resultados').html(resultsHtml);
            }
          });
        } else {
          $('#resultados').empty();
        }
      });



      $('#buscarProducto2').keyup(function() {

        let query = $(this).val().trim();

        if (query !== '') {
          $.ajax({
            url: '{{ route('buscar') }}',
            method: 'GET',
            data: {
              query: query
            },
            success: function(data) {
              var resultsHtml = '';
              var url = '{{ asset('') }}';
              console.log(data)
              data.forEach(function(result) {
                resultsHtml +=
                  `
                <a href="/producto/${result.id}">
                    <div class="w-full flex flex-row py-3 px-5 hover:bg-slate-200">
                        <div class="w-[10%]">
                            <img class="w-14 rounded-md" src="${url}${result?.images[0]?.name_imagen ?? result.imagen}" />
                        </div>
                        <div class="flex flex-col justify-center w-[70%]">
                            <h2 class="text-left">${result.producto}</h2>
                            <p class="text-text12 text-left">Categoría</p>
                        </div>
                        <div class="flex flex-col justify-center w-[10%]">
                            <p class="text-right">S/${result.precio}</p>
                            <p class="text-text12 text-right line-through text-slate-500">S/${result.descuento}</p>
                        </div>
                    </div>
                </a>
            `;
              });

              $('#resultados2').append(resultsHtml);
            }
          });
        } else {
          $('#resultados2').empty();
        }
      });

    });
  </script>

  <style>
    .overlay {
      height: 100%;
      width: 100%;
      display: none;
      position: fixed;
      z-index: 1;
      top: 0;
      left: 0;
      background-color: rgb(0, 0, 0);
      background-color: rgba(0, 0, 0, 0.9);
    }

    .overlay-content {
      position: relative;
      top: 25%;
      text-align: center;
      margin-top: 30px;
      margin: auto;
    }

    .overlay .closebtn {
      position: absolute;
      top: 20px;
      right: 45px;
      font-size: 60px;
      cursor: pointer;
      color: white;
    }

    .overlay .closebtn:hover {
      color: #ccc;
    }

    .overlay input[type=text] {
      padding: 15px;
      font-size: 17px;
      border: none;
      float: left;
      width: 100%;
      background: white;
    }

    .overlay input[type=text]:hover {
      background: #f1f1f1;
    }

    .overlay button {
      float: left;
      width: 20%;
      padding: 14.5px;
      background: #ddd;
      font-size: 17px;
      border: none;
      cursor: pointer;
    }

    .overlay button:hover {
      background: #bbb;
    }
  </style>
</header>

<script>
  $('.bag__modal').on('click', function() {
    $('.main').addClass('blur')
    $('footer').addClass('blur');
  })
  $('#closeCarrito').on('click', function() {

    $('.cartContainer').addClass('hidden')
    $('#check').prop('checked', false);
    $('.main').removeClass('blur')
    $('footer').removeClass('blur');

  })
</script>


<script src="{{ asset('js/storage.extend.js') }}"></script>
