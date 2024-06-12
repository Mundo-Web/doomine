@extends('components.public.matrix')

@push('head')
  <script src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
    kr-public-key="{{ config('services.izipay.public_key') }}"
    kr-post-url-success="{{ route('agradecimiento', ['codigoCompra' => $codigoCompra]) }}"></script>

  <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic-reset.min.css">
  <script src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/classic.js"></script>
@endpush

@section('css_importados')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <script src="https://sandbox-checkout.izipay.pe/payments/v1/js/index.js"></script>

@stop
<style type="text/css">
  /* to choice the embedded size */
  .kr-embedded {
    width: 33% !important;
  }

  /* to use the CSS Flexbox (Flexible Box) */
  .kr-embedded .flex-container {
    flex-direction: row !important;
    justify-content: space-between;
    width: 100%;
    display: flex;
    gap: 5px;
  }

  /* to have the email field  the same width as the KR fields */
  .kr-embedded .flex-container .kr-email {
    width: 100%;
  }

  /* to center the button with the class kr-payment-button */
  .kr-embedded .kr-payment-button {
    margin-left: auto;
    margin-right: auto;
    display: block;
    width: 100%;
    border-color: rgb(42, 210, 201) !important;
    color: rgb(116 166 141 / var(--tw-bg-opacity));
    border-radius: 92px;
    padding: 10px;
    margin: 17px;
  }

  .kr-popin-button {
    color: #ffffff !important;
    background-color: #74A68D !important;
    border-color: #74A68D;
    border-radius: 92px;
  }
</style>


@section('content')

  <main>
    <section class="font-poppins w-11/12 mx-auto my-12 flex flex-col gap-10">
      <div>
        <a href="index.html" class="font-normal text-[14px] text-[#6C7275]">Home</a>
        <span>/</span>
        <a href="carrito.html" class="font-semibold text-[14px] text-[#141718]">Carrito</a>
      </div>
      <div class="flex md:gap-10">
        <div class="flex justify-between items-center md:basis-8/12 w-full md:w-auto">
          <p
            class="font-semibold text-[18px] text-[#EB5D2C] border-b-[1px] border-[#EB5D2C] md:px-4 py-4 basis-1/3 h-full text-center">
            <span class="flex items-center h-full">Carro de compra</span>
          </p>

          <p
            class="font-medium text-[18px] text-[#151515] border-b-[1px] border-[#6C7275] md:px-4 py-4 basis-1/3 h-full text-center">
            <span class="flex items-center h-full">Detalles de pago</span>
          </p>

          <p
            class="font-medium text-[18px] text-[#C8C8C8] border-b-[1px] border-[#6C7275] md:px-4 py-4 basis-1/3 h-full text-center">
            <span class="flex items-center h-full">Orden completada</span>
          </p>
        </div>
        <div class="md:basis-4/12"></div>
      </div>

      <div class="flex flex-col 2md:flex-row gap-16 md:gap-10">
        <div class="basis-8/12 flex flex-col gap-10 order-2 2md:order-1">
          <div class="flex flex-col gap-5">
            <div>
              <!-- form -199 -513 -->
              <form id="formHome">
                <div class="flex flex-col gap-8">

                  @csrf
                  <div class="flex flex-col gap-5 pb-10 border-b-2 border-[#151515]">
                    <h2 class="font-semibold text-[20px] text-[#151515]">
                      Información del contacto
                    </h2>

                    <div class="flex flex-col gap-5">
                      <div class="flex flex-col gap-2">
                        <label for="email" class="font-medium text-[12px] text-[#6C7275]">E-mail</label>

                        @if (isset($detalleUsuario) && count($detalleUsuario) > 0)
                          <input id="email" type="email" placeholder="Correo electrónico" required name="email"
                            value="{{ $detalleUsuario[0]->email }}"
                            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                        @else
                          <input id="email" type="email" placeholder="Correo electrónico" required name="email"
                            value="{{ $detalleUsuario[0]->email }}"
                            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                        @endif

                      </div>
                      {{-- llenar los datos si la persona existe --}}
                      <div class="flex flex-col md:flex-row gap-5">

                        <div class="basis-1/2 flex flex-col gap-2">
                          <label for="nombre" class="font-medium text-[12px] text-[#6C7275]">Nombre</label>
                          @if (isset($detalleUsuario) && count($detalleUsuario) > 0)
                            <input id="nombre" type="text" placeholder="Nombre" name="nombre"
                              class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]"
                              value="{{ $detalleUsuario[0]->nombre }}" />
                          @else
                            <input id="nombre" type="text" placeholder="Nombre" name="nombre"
                              class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                          @endif

                        </div>


                        <div class="basis-1/2 flex flex-col gap-2">
                          <label for="apellidos" class="font-medium text-[12px] text-[#6C7275]">Apellido</label>

                          @if (isset($detalleUsuario) && count($detalleUsuario) > 0)
                            <input id="apellidos" type="text" placeholder="Apellido" name="apellidos"
                              class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]"
                              value="{{ $detalleUsuario[0]->apellidos }}" />
                          @else
                            <input id="apellido" type="text" placeholder="Apellido" name="apellidos"
                              class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                          @endif

                        </div>
                      </div>



                      <div class="flex flex-col gap-2">
                        <label for="celular" class="font-medium text-[12px] text-[#6C7275]">Celular</label>

                        @if (isset($detalleUsuario) && count($detalleUsuario) > 0)
                          <input id="celular" type="text" placeholder="(+51) 000 000 000" name="phone"
                            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl"
                            value="{{ $detalleUsuario[0]->phone }}" />
                        @else
                          <input id="celular" type="text" placeholder="(+51) 000 000 000" name="phone"
                            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
                        @endif
                      </div>
                    </div>
                  </div>

                  <div class="flex flex-col gap-5 pb-10 border-b-2 border-[#151515]">
                    <h2 class="font-semibold text-[20px] text-[#151515]">
                      Dirección de envío
                    </h2>
                    <div class="flex flex-col gap-5">
                      <div class="flex flex-col gap-5">


                        <div class="flex flex-col gap-2">
                          <label for="nombre_calle" class="font-medium text-[12px] text-[#6C7275]">Avenida / Calle /
                            Jirón</label>

                          @if (isset($detalleUsuario) && count($detalleUsuario) > 0)
                            <input id="nombre_calle" type="text" name="dir_av_calle"
                              placeholder="Ingresa el nombre de la calle"
                              class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]"
                              value="{{ $detalleUsuario[0]->dir_av_calle }}" />
                          @else
                            <input id="nombre_calle" type="text" name="dir_av_calle"
                              placeholder="Ingresa el nombre de la calle"
                              class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                          @endif
                        </div>
                      </div>
                      <div>
                        <div class="flex flex-col md:flex-row gap-5">
                          <div class="basis-1/2 flex flex-col gap-2">
                            <label for="numero_calle" class="font-medium text-[12px] text-[#6C7275]">Número</label>
                            @if (isset($detalleUsuario) && count($detalleUsuario) > 0)
                              <input id="numero_calle" name="dir_numero" type="text"
                                placeholder="Ingresa el número de la callle"
                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]"
                                value="{{ $detalleUsuario[0]->dir_numero }}" />
                            @else
                              <input id="numero_calle" name="dir_numero" type="text"
                                placeholder="Ingresa el número de la callle"
                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                            @endif

                          </div>

                          <div class="basis-1/2 flex flex-col gap-2">
                            <label for="direccion" class="font-medium text-[12px] text-[#6C7275]">Dpto./ Interior/ Piso/
                              Lote/ Bloque
                              (opcional)</label>
                            @if (isset($detalleUsuario) && count($detalleUsuario) > 0)
                              <input id="direccion" type="text" name="dir_bloq_lote"
                                placeholder="Ejem. Casa 3, Dpto 101"
                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]"
                                value="{{ $detalleUsuario[0]->dir_bloq_lote }}" />
                            @else
                              <input id="direccion" type="text" name="dir_bloq_lote"
                                placeholder="Ejem. Casa 3, Dpto 101"
                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                            @endif
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="flex flex-col gap-5 pb-10">
                    <h2 class="font-semibold text-[20px] text-[#151515]">
                      Metodo de pago
                    </h2>
                    <div class="w-full flex flex-col gap-5 border-dashed pb-10 border-b-2 border-[#E8ECEF]">
                      <div class="flex items-center ps-4 border border-[#F3F5F7] rounded-xl">
                        <input type="radio" id="bordered-radio-tarjeta" name="tipo_tarjeta" value="tar_credito"
                          class="background-radius w-5 h-5 cursor-pointer text-[#6C7275]" />
                        <label for="bordered-radio-tarjeta"
                          class="w-full py-4 ms-2 text-[16px] font-normal text-[#6C7275] flex justify-between items-center px-4">
                          <span>Tarjeta de crédito</span>
                        </label>
                      </div>
                      <div class="flex items-center ps-4 border border-[#F3F5F7] rounded-xl">
                        <input type="radio" id="bordered-radio-debito" name="tipo_tarjeta" value="tar_debito"
                          class="background-radius w-5 h-5 cursor-pointer text-[#6C7275]" />
                        <label for="bordered-radio-debito"
                          class="w-full py-4 ms-2 text-[16px] font-normal text-[#6C7275] flex justify-between items-center px-4">
                          <span>Tarjeta de Débito</span>
                        </label>
                      </div>

                      {{-- <div class="flex items-center ps-4 border border-[#F3F5F7] rounded-xl">
                        <input type="radio" id="bordered-radio-cuenta" name="bordered-radio-tarjetas"
                          value="depo_cuenta" class="background-radius w-5 h-5 cursor-pointer text-[#6C7275]" />
                        <label for="bordered-radio-cuenta"
                          class="w-full py-4 ms-2 text-[16px] font-normal text-[#6C7275] flex justify-between items-center px-4">
                          <span>Depósito a cuenta</span>
                        </label>
                      </div> --}}
                    </div>


                    <div class="pt-10">
                      <a id="pagarProductos"
                        class="text-white bg-[#74A68D] w-full py-3 rounded-3xl cursor-pointer border-2 font-semibold text-[16px] 
                        inline-block text-center border-none">Pagar</a>

                    </div>

                    <div class="pt-10" id="contenedorIzypay" hidden>
                      <div class="flex justify-center content-center ">
                        <div
                          class="kr-embedded text-white bg-[#74A68D] w-full py-3 rounded-3xl cursor-pointer border-2 font-semibold text-[16px] inline-block text-center border-none"
                          kr-popin kr-form-token="{{ $formToken }}">
                          <div class="flex-container">
                            <div class="kr-pan"> </div>
                            <div class="kr-expiry"></div>
                            <div class="kr-security-code"></div>
                          </div>



                          <button class="kr-payment-button"></button>
                        </div>
                      </div>

                    </div>
                    <div class="flex">

                    </div>


                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="basis-4/12 flex flex-col justify-start gap-10 pt-10 md:pt-0 order-1 2md:order-2">
        <h2 class="font-semibold text-[20px] text-[#151515] px-4">
          Resumen del pedido
        </h2>

        <div class="p-4">
          <div class="flex flex-col gap-10" id="itemsCarritoPago">







          </div>

          <div class="font-poppins flex flex-col gap-5 mt-10">
            <div class="text-[#141718] flex justify-between items-center border-b-[1px] border-[#E8ECEF] pb-5">
              <p class="font-normal text-[16px]">Envío</p>
              <p id="tipoEnvioDesc" class="font-semibold text-[16px]"></p>
            </div>

            <div class="text-[#141718] flex justify-between items-center border-b-[1px] border-[#E8ECEF] pb-5">
              <p class="font-normal text-[16px]">Subtotal</p>
              <p id='itemSubtotal' class="font-semibold text-[16px]">s/ 00.00</p>
            </div>

            <div
              class="text-[#141718] font-medium text-[20px] flex justify-between items-center border-b-[1px] border-[#E8ECEF] pb-5">
              <p>Total</p>
              <p id="itemTotal">s/ 00.00</p>
            </div>

          </div>
        </div>
      </div>
      </div>
    </section>
  </main>



@section('scripts_importados')

  <script>
    $(document).ready(function() {
      $(document).on('click', '.kr-popin-button', function(e) {


      })

    })
  </script>

  <script>
    $('#pagarProductos').on('click', function(e) {
      e.preventDefault()

      let url = window.location.href;
      const urlObj = new URL(url);
      const params = urlObj.searchParams

      let firstPurchase = params.get('first')
      let formDataArray = $('#formHome').serializeArray();
      let mensaje = 'El campo'
      let mensajeFinal = ' No pueden estar vacios'
      let hasEmptyFields = false


      if (firstPurchase == 'false') {
        formDataArray.forEach(function(item) {
          if (item.value.trim() === '') {
            switch (item.name) {
              case 'nombre':
                mensaje += ' Nombre,';
                hasEmptyFields = true;
                break
              case 'apellidos':
                mensaje += ' Apellido,';
                hasEmptyFields = true;
                break
              case 'email':
                mensaje += ' Email,';
                hasEmptyFields = true;
                break
              case 'phone':
                mensaje += ' Celular,';
                hasEmptyFields = true;
                break

              case 'dir_av_calle':
                mensaje += ' Avenida/Calle,';
                hasEmptyFields = true;
                break
              case 'dir_numero':
                mensaje += ' Numero,';
                hasEmptyFields = true;
                break
            }


          }
        })

        if (!hasEmptyFields) {
          $('#contenedorIzypay').show();
        } else {
          Swal.fire({

            icon: "warning",
            title: "Opss ",
            text: `${mensaje}${mensajeFinal}`


          });
          hasEmptyFields = false
        }
      } else {
        formDataArray.forEach(function(item) {
          if (item.value.trim() === '') {

            switch (item.name) {


              case 'dir_av_calle':
                mensaje += ' Avenida/Calle,';
                hasEmptyFields = true;
                break;
              case 'dir_numero':
                mensaje += ' Numero,';
                hasEmptyFields = true;
                break;
            }


          }
        })
        if (!hasEmptyFields) {
          $('#contenedorIzypay').show();
        } else {
          Swal.fire({

            icon: "warning",
            title: "Opss ",
            text: `${mensaje}${mensajeFinal}`


          });
          hasEmptyFields = false
        }

      }

      $.ajax({
        url: '{{ route('procesar.pago') }}',
        method: 'POST',
        data: {
          data: $('#formHome').serializeArray(),
          codigoCompra: {{ $codigoCompra }}
        },
        success: function(response) {
          console.log(response)

          //limpiar carrito de compra

        },
        error: function(error) {
          console.log(error)
        }
      })
    })
  </script>

  <script>
    let articulosCarrito = [];
    let checkedRadio = false


    function deleteOnCarBtn(id, operacion) {
      const prodRepetido = articulosCarrito.map(item => {
        if (item.id === id && item.cantidad > 0) {
          item.cantidad -= Number(1);
          return item; // retorna el objeto actualizado 
        } else {
          return item; // retorna los objetos que no son duplicados 
        }

      });

      Local.set("carrito", articulosCarrito)
      limpiarHTML()
      PintarCarrito()


    }

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

      let tipoEnvio = 0
      if (carrito.length !== 0) {
        tipoEnvio = carrito[0]["tipo_envio"]
      }
      // carrito = [...carrito, carrito.total]
      Local.set("carrito", carrito)
      total += tipoEnvio
      let textEnvio = tipoEnvio == 15 ? 'Envío express' : "Recoger"


      $('#tipoEnvioDesc').text(textEnvio)

      $('#itemTotal').text(`S/. ${total} `)

    }

    function addOnCarBtn(id, operacion) {

      const prodRepetido = articulosCarrito.map(item => {
        if (item.id === id) {
          item.cantidad += Number(1);
          return item; // retorna el objeto actualizado 
        } else {
          return item; // retorna los objetos que no son duplicados 
        }

      });
      Local.set("carrito", articulosCarrito)
      // localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
      limpiarHTML()
      PintarCarrito()


    }

    function deleteItem(id) {
      articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

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
      $('#itemsCarritoPago').html('')


    }



    function PintarCarrito() {

      let itemsCarrito = $('#itemsCarrito')
      let itemsCarritoPago = $('#itemsCarritoPago')

      articulosCarrito.forEach(element => {

        let plantilla = `<div class="flex justify-between bg-white font-poppins border-b-[1px] border-[#E8ECEF] pb-5">
        <div class="flex justify-center items-center gap-5">
          <div class="bg-[#F3F5F7] rounded-md p-4">
            <img src="${appUrl}/${element.caratula}" alt="producto" class="w-24" />
          </div>
          <div class="flex flex-col gap-3 py-2">
            <h3 class="font-semibold text-[14px] text-[#151515]">
              ${element.producto} 
            </h3>
            <p class="font-normal text-[12px] text-[#6C7275]">
              ${element.color.valor} ${element.talla}
            </p>
            <div class="flex w-20 justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md">
              
              <div class="w-8 h-8 flex justify-center items-center">
                <span  class="font-semibold text-[12px]">${element.cantidad }</span>
              </div>
              
            </div>
          </div>
        </div>
        <div class="flex flex-col justify-start py-2 gap-5 items-center pr-2">
          <p class="font-semibold text-[14px] text-[#151515]">
            S/ ${Number(element.descuento) !== 0 ? element.descuento : element.precio}
          </p>
          <div class="flex items-center">
            

          </div>
        </div>
      </div>`

        itemsCarrito.append(plantilla)
        itemsCarritoPago.append(plantilla)

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
          console.log(success);
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

          // localStorage.setItem('carrito', JSON.stringify(articulosCarrito));

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
    $('input[type="radio"][name="bordered-radio"]').on('click', function() {
      // Obtener el valor del radio button seleccionado
      const valorSeleccionado = $(this).val();


      articulosCarrito = Local.get('carrito')
      let carritoCheck = articulosCarrito.map(item => {
        let obj = {
          id: item.id,
          producto: item.producto,
          descuento: item.descuento,
          precio: item.precio,
          imagen: item.imagen,
          cantidad: item.cantidad,
          color: item.color,
          tipo_envio: Number(valorSeleccionado)
        };
        return obj
      })

      Local.set("carrito", carritoCheck)
      checkedRadio = true

      // Hacer algo con el valor seleccionado, por ejemplo, imprimirlo en la consola
      limpiarHTML()
      PintarCarrito()
    });
    $("#btnSiguiente").on('click', function(e) {

      if (!checkedRadio) {
        e.preventDefault()
        Swal.fire({

          icon: "warning",
          title: "Opss ",
          text: 'Recuerde elegir un metodo de envio'


        });

      }
    })
  </script>

  <script src="{{ asset('js/storage.extend.js') }}"></script>

  <script>
    function pintarCantidad() {
      let carritoCantidad = Local.get('carrito')


      if (typeof carritoCantidad !== 'undefined' && carritoCantidad !== null) {
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

@stop

@stop
