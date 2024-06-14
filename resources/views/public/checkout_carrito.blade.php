@extends('components.public.matrix')

@section('css_importados')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


@stop


@section('content')


  <main>
    <section class="font-poppins w-11/12 mx-auto my-12 flex flex-col gap-10">
      @csrf
      <div>
        <a href="index.html" class="font-normal text-[14px] text-[#6C7275]">Home</a>
        <span>/</span>
        <a href="carrito.html" class="font-semibold text-[14px] text-[#141718]">Carrito</a>
      </div>
      <div class="flex flex-col">
        <label for="email" class="font-medium text-[12px] text-[#6C7275]">E-mail</label>

        <input id="email" type="email" placeholder="Correo electrónico" required name="email" value=""
          class=" py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />


      </div>



      <h2 class="font-semibold text-[20px] text-[#151515]">
        Dirección de envío
      </h2>
      <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">


        <div class="md:col-span-1">
          <label for="costo_x_art">Departamento</label>
          <div class="relative mb-2  mt-2">
            <select name="departamento_id" id="departamento_id"
              class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="">Seleccionar Departamento </option>
              @foreach ($departamentos as $item)
                <option value="{{ $item->id }}">{{ $item->description }}</option>
              @endforeach

            </select>
          </div>
        </div>

        <div class="md:col-span-1 opacity-15" id="cont_provincia">

          <label for="costo_x_art">Provincias</label>
          <div class="relative mb-2  mt-2">
            <select name="provincia_id" id="provincia_id"
              class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="">Seleccionar Provincia </option>
            </select>
          </div>
        </div>

        <div class="md:col-span-1 opacity-15" id="cont_distrito">
          <label for="costo_x_art">Distrito</label>
          <div class="relative mb-2  mt-2">
            <select name="distrito_id" id="distrito_id"
              class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
              <option value="">Seleccionar Distrito </option>
              {{-- @foreach ($departamentos as $item)
                    <option value="{{ $item->id }}">{{ $item->description }}</option>
                  @endforeach --}}

            </select>
          </div>
        </div>





      </div>


      <div class="flex md:gap-20">
        <div class="flex justify-between items-center md:basis-7/12 w-full md:w-auto">
          <p
            class="font-semibold text-[18px] text-[#21201E] border-b-[1px] border-[#6C7275] md:px-4 py-4 basis-1/3 h-full text-center">
            <span class="flex items-center h-full">Carro de compra</span>
          </p>

          <p
            class="font-medium text-[18px] text-[#C8C8C8] border-b-[1px] border-[#6C7275] md:px-4 py-4 basis-1/3 h-full text-center">
            <span class="flex items-center h-full">Detalles de pago</span>
          </p>

          <p
            class="font-medium text-[18px] text-[#C8C8C8] border-b-[1px] border-[#6C7275] md:px-4 py-4 basis-1/3 h-full text-center">
            <span class="flex items-center h-full">Orden completada</span>
          </p>
        </div>
        <div class="md:basis-5/12"></div>
      </div>
      <div class="flex flex-col md:flex-row gap-20">
        <div class="basis-7/12 flex flex-col gap-10">
          <div>
            <div class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5">
              <div class="w-full basis-5/12" id="itemsCarritoCheck">

              </div>
            </div>
          </div>
        </div>

        <div class="basis-5/12 flex flex-col justify-start gap-5">
          <h2 class="font-semibold text-[20px] text-[#151515]">
            Resumen de la compra
          </h2>

          <div>
            <div class="flex flex-col gap-5">
              <div class="w-full flex flex-col gap-5" id="contenedorEnvios">

                <span class="font-bold "> Seleccione una opcion para el envio </span>
                {{-- <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                  <input type="radio" id="bordered-radio-2" name="bordered-radio" value="15"
                    class="background-radius w-5 h-5" />
                  <label for="bordered-radio-2"
                    class="w-full py-4 ms-2 text-[16px] font-normal text-[#151515] flex justify-between items-center px-4">
                    <span>Envío express</span>
                    <span>s/ 15.00</span>
                  </label>
                </div> --}}


              </div>

              <div class="text-[#151515] flex justify-between items-center">
                <p class="font-normal text-[14px]">SubTotal</p>
                <span id="itemSubtotal" class="font-semibold text-[14px]">s/ 0.00</span>
              </div>

              <div class="text-[#151515] flex justify-between items-center">
                <p class="font-semibold text-[20px]">Total</p>
                <span id="itemsTotalCheck" class="font-semibold text-[20px]">s/ 0.00</span>
              </div>

              <button id="btnSiguiente" type="button"
                class="text-white bg-[#74A68D] w-full py-4 rounded-3xl cursor-pointer font-semibold text-[16px] inline-block text-center">
                Siguiente
              </button>

            </div>
          </div>
        </div>
      </div>
    </section>
  </main>




@section('scripts_importados')
  <script>
    let carritot = Local.get('carrito')
    if (carritot == undefined || carritot === '') {



      window.location.href = `/`



    }

    $("#btnSiguiente").on('click', function(e) {



      let email = $('#email').val()
      if (email == '' || email == null) {
        e.preventDefault()
        Swal.fire({
          icon: "warning",
          title: "Opss ",
          text: 'Recuerde ingresar un correo'
        });
        return
      }
      if (!checkedRadio) {
        e.preventDefault()
        Swal.fire({
          icon: "warning",
          title: "Opss ",
          text: 'Recuerde elegir un metodo de envio'
        });
        return
      }
      $(this).addClass('opacity-50 cursor-not-allowed').prop('disabled', true);
      let totalCarrito = calcularTotal()

      $.ajax({
        url: '{{ route('procesar.carrito') }}',
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          carrito: Local.get('carrito'),
          email,
          distrito: $('#distrito_id').val(),
          departamento: $('#departamento_id').val(),
          provincia: $('#provincia_id').val(),
          total: JSON.stringify(totalCarrito)
        },
        success: function(response) {
          Swal.close();
          Swal.fire({
            title: `Exito!!`,
            text: `Informacion procesada correctamente`,
            icon: "success",
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
              const timer = Swal.getPopup().querySelector("b");
              timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
              }, 100);
            },
            willClose: () => {
              clearInterval(timerInterval);
            }
          });
          //limpiar carrito de compra
          // Local.delete('carrito')

          setTimeout(function() {

            window.location.href =
              `/pago?codigoCompra=${response.codigoOrden}&token=${response.formToken}&first=${response.primeraVez}`
          }, 2000);
        },
        error: function(response) {

          $("#btnSiguiente").removeClass('opacity-50 cursor-not-allowed').prop('disabled', false);
          const customMessages = response.responseJSON.message?.validator?.customMessages;

          if (!customMessages) {
            Swal.close();
            Swal.fire({
              title: `Opps!!`,
              text: response.responseJSON.errors,
              icon: "error",
            });
          }
          return
          const messages = Object.keys(customMessages).map(key => customMessages[key]);
          Swal.close();
          Swal.fire({
            title: `Opps!!`,
            text: messages,
            icon: "error",
          });
        }
      });


    })
  </script>
  <script>
    $(document).ready(function() {


      $("#departamento_id").change(function() {
        //ni bien cambie el departamento capturamos
        //el valor del ID del valor seleccionado 
        departamento_id = $('#departamento_id').val();

        //ejecutamos el ajax
        $.ajax({
          url: "{{ route('prices.getProvincias') }}",
          dataType: "json",
          method: 'POST',
          data: {
            _token: $('input[name="_token"]').val(),
            id: departamento_id
          }
        }).done(function(res) {
          $('#provincia_id').empty();
          $('#provincia_id').append(
            '<option value="">Seleccionar Provincia</option>'
          )
          $('#cont_provincia').toggleClass('opacity-15')
          $.each(res, function(key, value) {
            $('#provincia_id').append(
              '<option value="' + value['id'] + '">' + value['description'] + '</option>'
            )
          });
        });
      });


      $("#provincia_id").change(function() {
        //ni bien cambie el departamento capturamos
        //el valor del ID del valor seleccionado 
        provincia_id = $('#provincia_id').val();

        //ejecutamos el ajax
        $.ajax({
          url: "{{ route('prices.getDistrito') }}",
          dataType: "json",
          method: 'POST',
          data: {
            _token: $('input[name="_token"]').val(),
            id: provincia_id
          }
        }).done(function(res) {
          $('#distrito_id').empty();
          $('#distrito_id').append(
            '<option value="">Seleccionar Distrito</option>'
          )
          $('#cont_distrito').toggleClass('opacity-15')
          $.each(res, function(key, value) {
            $('#distrito_id').append(
              '<option value="' + value['id'] + '">' + value['description'] + '</option>'
            )
          });
        });
      });

      $("#distrito_id").change(function() {
        console.log('eligio el distrito');

        let distrito_id = $('#distrito_id').val()

        $.ajax({
          url: "{{ route('prices.calculeEnvio') }}",
          dataType: "json",
          method: 'POST',
          data: {
            _token: $('input[name="_token"]').val(),
            id: distrito_id
          },
          success: function(response) {
            console.log(response.LocalidadParaEnvio)
            let EnviosDisponibles = response.LocalidadParaEnvio
            let htmlContent = ''
            let entrgaLocal = `<div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                      <input type="radio" id="bordered-radio-2" name="bordered-radio" value="0.00"
                          class="background-radius w-5 h-5" />
                      <label for="bordered-radio-2"
                          class="w-full py-4 ms-2 text-[16px] font-normal text-[#151515] flex justify-between items-center px-4">
                          <span> Recojo GRATIS en tienda </span>
                          <span>S/. 0.00</span>
                      </label>
                  </div>`

            let isLocal = false


            if (EnviosDisponibles.length == 0) {
              let mes = `No hay opcion de envio para este destino`
              $('#contenedorEnvios').html(mes)
              Swal.fire({
                icon: "warning",
                title: "Opss ",
                text: mes
              });

              return
            }
            EnviosDisponibles.forEach(envio => {
              if (envio.local == 1) {
                isLocal = true
                entrgaLocal += `
                    <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input type="radio" id="bordered-radio-2" name="bordered-radio" value="${envio.price}"
                                class="background-radius w-5 h-5" />
                            <label for="bordered-radio-2"
                                class="w-full py-4 ms-2 text-[16px] font-normal text-[#151515] flex justify-between items-center px-4">
                                <span>${envio.local == 1 ? 'Envio a domicilio': 'Envio Courier'}</span>
                                <span>S/ ${envio.price}</span>
                            </label>
                        </div>
                  `

              } else {
                htmlContent += `
                  <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                          <input type="radio" id="bordered-radio-2" name="bordered-radio" value="${envio.price}"
                              class="background-radius w-5 h-5" />
                          <label for="bordered-radio-2"
                              class="w-full py-4 ms-2 text-[16px] font-normal text-[#151515] flex justify-between items-center px-4">
                              <span>${envio.local == 1 ? 'Envio a domicilio': 'Envio Courier'}</span>
                              <span>S/ ${envio.price}</span>
                          </label>
                      </div>
                `
              }


            })


            if (isLocal) {
              $('#contenedorEnvios').html(entrgaLocal);
            } else {
              $('#contenedorEnvios').html(htmlContent);

            }

          }
        })
      });

    })
  </script>
  <script>
    function pintarCantidad() {
      let carritoCantidad = Local.get('carrito')

      console.log('header exito', carritoCantidad)

      if (typeof carritoCantidad !== 'undefined' && carritoCantidad !== null) {
        console.log('diferente a nulo')
        // La variable carritoCantidad está definida y no es null
        let total = carritoCantidad.length
        if (total == 0) {

          $('#imgCantidad').attr('hidden', true);


        } else {
          $('#imgCantidad').attr('hidden', false);

          $('#spanCantidad').text(total)

        }


      } else {

        $('#imgCantidad').attr('hidden', true);
      }

    }
    pintarCantidad()
  </script>

  <script>
    let articulosCarrito = [];
    let checkedRadio = false




    function calcularTotal() {
      let articulos = Local.get('carrito')
      let total = articulos.map(item => {
        let monto
        if (Number(item.descuento) !== 0) {
          monto = item.cantidad * Number(item.descuento)
        } else {
          monto = item.cantidad * Number(item.precio)

        }
        return monto

      })
      const suma = total.reduce((total, elemento) => total + elemento, 0);

      $('#itemSubtotal').text(`S/. ${suma} `)
      const opciones = document.getElementsByName('bordered-radio');

      // Iterar sobre los radio buttons para encontrar el que está seleccionado
      let valorSeleccionado = 0;
      opciones.forEach(opcion => {
        if (opcion.checked) {
          valorSeleccionado = opcion.value;
        }
      });

      // El valor de valorSeleccionado es el valor del radio button seleccionado


      total = Number(suma) + Number(valorSeleccionado)

      let carrito = Local.get('carrito')
      // carrito = [...carrito, carrito.total]
      Local.set("carrito", carrito)

      $('#itemsTotalCheck').text(`S/. ${total} `)
      return {
        total,
        suma
      }

    }

    function addOnCarBtn(id, operacion, colorId, talla) {

      console.log(id, colorId)

      const prodRepetido = articulosCarrito.map(item => {
        if (item.id === id && item.color.id === colorId && item.talla === talla) {
          item.cantidad += Number(1);
          return item; // retorna el objeto actualizado 
        } else {
          return item; // retorna los objetos que no son duplicados 
        }

      });
      Local.set('carrito', articulosCarrito)
      // localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
      limpiarHTML()
      PintarCarrito()


    }

    function deleteOnCarBtn(id, operacion, colorId, talla) {
      const prodRepetido = articulosCarrito.map(item => {
        if (item.id === id && item.cantidad > 0 && item.color.id === colorId && item.talla === talla) {
          item.cantidad -= Number(1);
          return item; // retorna el objeto actualizado 
        } else {
          return item; // retorna los objetos que no son duplicados 
        }

      });
      Local.set('carrito', articulosCarrito)
      limpiarHTML()
      PintarCarrito()


    }

    function deleteItem(id, colorId, talla) {
      articulosCarrito = articulosCarrito.filter(objeto => {
        return !(objeto.id === id && objeto.color.id === colorId && objeto.talla == talla);

      });

      Local.set("carrito", articulosCarrito)
      limpiarHTML()
      PintarCarrito()
    }

    var appUrl = <?php echo json_encode($url_env); ?>;
    $(document).ready(function() {
      articulosCarrito = Local.get('carrito') || [];

      PintarCarrito();
    });

    function limpiarHTML() {
      //forma lenta 
      /* contenedorCarrito.innerHTML=''; */
      $('#itemsCarrito').html('')
      $('#itemsCarritoCheck').html('')


    }



    function PintarCarrito() {

      let itemsCarrito = $('#itemsCarrito')
      let itemsCarritoCheck = $('#itemsCarritoCheck')

      articulosCarrito.forEach(element => {
        let plantilla = `<div class="flex justify-between bg-white font-poppins border-b-[1px] border-[#E8ECEF] pb-5">
              <div class="flex  items-center gap-5">
                <div class="bg-[#F3F5F7] rounded-md p-4">
                  
                  <img src="${appUrl}/${element.caratula}" alt="producto" class="w-24" />

                </div>
                <div class="flex flex-col gap-3 py-2">
                  <h3 class="font-semibold text-[14px] text-[#151515]">
                    ${element.producto} 
                  </h3>
                  <p class="font-normal text-[12px] text-[${element.color.hex}]">
                    ${element.color.valor} ${element.talla}
                  </p>
                  <div class="flex w-20 justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md">
                    <button type="button" onClick="(deleteOnCarBtn(${element.id}, '-', ${element.color.id}, '${element.talla}'))" class="  w-8 h-8 flex justify-center items-center ">
                      <span  class="text-[20px]">-</span>
                    </button>
                    <div class="w-8 h-8 flex justify-center items-center">
                      <span  class="font-semibold text-[12px]">${element.cantidad }</span>
                    </div>
                    <button type="button" onClick="(addOnCarBtn(${element.id}, '+', ${element.color.id}, '${element.talla}'))" class="  w-8 h-8 flex justify-center items-center ">
                      <span class="text-[20px]">+</span>
                    </button>
                  </div>
                </div>
              </div>
              <div class="flex flex-col justify-end py-2 gap-5 items-center pr-2">
                <p class="font-semibold text-[14px] text-[#151515]">
                  S/ ${Number(element.descuento) !== 0 ? element.descuento : element.precio}
                </p>
                <div class="flex items-center">
                  <button type="button" onClick="(deleteItem(${element.id}, ${element.color.id}, '${element.talla}'))" class="  w-8 h-8 flex justify-center items-center ">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                  </svg>
                  </button>
  
                </div>
              </div>
            </div>`

        itemsCarrito.append(plantilla)
        itemsCarritoCheck.append(plantilla)

      });

      calcularTotal()
    }






    $('#btnAgregarCarrito').on('click', function() {
      let url = window.location.href;
      let partesURl = url.split('/')
      let item = partesURl[partesURl.length - 1]
      let cantidad = Number($('#cantidadSpan span').text())
      item = item.replace('#', '')



      // id='nodescuento'


      $.ajax({

        url: `{{ route('carrito.buscarProducto') }}`,
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          id: item,
          cantidad

        },
        success: function(success) {
          let {
            producto,
            id,
            descuento,
            precio,
            imagen,
            color
          } = success.data
          let cantidad = Number(success.cantidad)
          let detalleProducto = {
            id,
            producto,
            descuento,
            precio,
            imagen,
            cantidad,
            color,
            tipo_envio: 0,
            caratula: success.caratula.images[0].name_imagen,
            talla: talla.trim()
          }
          let existeArticulo = articulosCarrito.some(item => item.id === detalleProducto.id)
          if (existeArticulo) {
            //sumar al articulo actual 
            const prodRepetido = articulosCarrito.map(item => {
              if (item.id === detalleProducto.id) {
                item.cantidad += Number(detalleProducto.cantidad);
                return item; // retorna el objeto actualizado 
              } else {
                return item; // retorna los objetos que no son duplicados 
              }

            });
          } else {
            articulosCarrito = [...articulosCarrito, detalleProducto]

          }

          localStorage.setItem('carrito', JSON.stringify(articulosCarrito));

          limpiarHTML()
          PintarCarrito()

        },
        error: function(error) {
          console.log(error)
        }

      })



      // articulosCarrito = {...articulosCarrito , detalleProducto }
    })
    $('#openCarrito').on('click', function() {
      $('.main').addClass('blur')
    })
    $('#closeCarrito').on('click', function() {
      $('.main').removeClass('blur')
      $('.cartContainer').addClass('hidden')
      $('#check').prop('checked', false);

    })
    $(document).on('click', 'input[type="radio"][name="bordered-radio"]', function() {
      // Obtener el valor del radio button seleccionado
      const valorSeleccionado = $(this).val();


      articulosCarrito = Local.get('carrito')
      console.log(articulosCarrito)
      let carritoCheck = articulosCarrito.map(item => {
        let obj = {
          id: item.id,
          producto: item.producto,
          descuento: item.descuento,
          precio: item.precio,
          imagen: item.imagen,
          cantidad: item.cantidad,
          color: item.color,
          tipo_envio: Number(valorSeleccionado),
          talla: item.talla,
          caratula: item.caratula
        };
        return obj
      })

      Local.set("carrito", carritoCheck)
      checkedRadio = true

      // Hacer algo con el valor seleccionado, por ejemplo, imprimirlo en la consola
      limpiarHTML()
      PintarCarrito()
    });
  </script>


  <script src="{{ asset('js/storage.extend.js') }}"></script>
@stop

@stop
