<x-app-layout>

  @php

    $route = resource_path('views/pages/general/newArrials.json');
    $file = file_get_contents($route);
    $archivoArray = json_decode($file, true);

    // Convertir el array en un objeto
    $archivoObjeto = (object) $archivoArray;

  @endphp
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <form action="{{ route('datosgenerales.update', $general->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
          <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Datos generales
            del negocio</h2>
        </header>
        @if (session('success'))
          <script>
            window.onload = function() {
              mostrarAlerta();
            }
          </script>
        @endif
        <div class="p-3">

          <div>

            <div class="flex items-center justify-center">
              <div>
                <div>

                  <div class=" rounded shadow-lg p-4 px-4 ">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1">

                      <div class="lg:col-span-1">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                          <h2 class="md:col-span-5 text-lg font-semibold text-slate-800 dark:text-white">
                            Información de contacto</h2>

                          <div class="md:col-span-5">
                            <label for="address">Dirección de la empresa</label>
                            <div class="relative mb-2 ">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="address" name="address" value="{{ $general->address }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@flowbite.com">
                            </div>
                          </div>

                          <div class="md:col-span-2">
                            <label for="inside">Interior</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="inside" name="inside" value="{{ $general->inside }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Interior Oficina 204 - Piso 4">
                            </div>
                          </div>

                          <div class="md:col-span-2">
                            <label for="district">Distrito</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="district" name="district" value="{{ $general->district }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Interior Oficina 204 - Piso 4">
                            </div>
                          </div>

                          <div class="md:col-span-1">
                            <label for="country">País</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="country" name="country" value="{{ $general->country }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Interior Oficina 204 - Piso 4">
                            </div>
                          </div>

                          <div class="md:col-span-2">
                            <label for="email">Correo electrónico</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="email" id="email" name="email" value="{{ $general->email }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@flowbite.com">
                            </div>
                          </div>

                          <div class="md:col-span-1">
                            <label for="cellphone">Número de celular</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="cellphone" name="cellphone" value="{{ $general->cellphone }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="+51 123456789">
                            </div>
                          </div>

                          <div class="md:col-span-1">
                            <label for="office_phone">Número de Teléfono</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="office_phone" name="office_phone"
                                value="{{ $general->office_phone }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="+51 1234567">
                            </div>
                          </div>

                          <div class="md:col-span-1">
                            <label for="whatsapp">Número Para Whatsapp</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="whatsapp" name="whatsapp" value="{{ $general->whatsapp }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="+51 1234567">
                            </div>
                          </div>
                          <div class="md:col-span-5">
                            <label for="mensaje_whatsapp">Mensaje predeterminado para
                              Whastapp</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="mensaje_whatsapp" name="mensaje_whatsapp"
                                value="{{ $general->mensaje_whatsapp }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="+51 1234567">
                            </div>
                          </div>


                          <div class="md:col-span-5">
                            <label for="schedule">Horario de Oficina</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="schedule" name="schedule" value="{{ $general->schedule }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Horario de Oficina">
                            </div>
                          </div>


                          <h2 class="md:col-span-5 text-lg font-semibold text-slate-800 mt-2 dark:text-white">
                            Redes Sociales</h2>

                          <div class="md:col-span-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-0">
                              <div>
                                <div class="relative">
                                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                      </path>
                                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                      </path>
                                    </svg>
                                  </div>
                                  <input type="text" id="rs_facebook" name="facebook"
                                    value="{{ $general->facebook }}"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Facebook">
                                </div>
                              </div>

                              <div>
                                <div class="relative ">
                                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                      </path>
                                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                      </path>
                                    </svg>
                                  </div>
                                  <input type="text" id="rs_instagram" name="instagram"
                                    value="{{ $general->instagram }}"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Instagram">
                                </div>
                              </div>

                              <div>
                                <div class="relative ">
                                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                      </path>
                                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                      </path>
                                    </svg>
                                  </div>
                                  <input type="text" id="rs_youtube" name="youtube"
                                    value="{{ $general->youtube }}"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Youtube">
                                </div>
                              </div>

                              <div>

                                <div class="relative">
                                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                      </path>
                                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                      </path>
                                    </svg>
                                  </div>
                                  <input type="text" id="rs_twitter" name="twitter"
                                    value="{{ $general->twitter }}"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Twitter">
                                </div>
                              </div>

                              <div>
                                <div class="relative ">
                                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                      viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                      </path>
                                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                      </path>
                                    </svg>
                                  </div>
                                  <input type="text" id="rs_tiktok" name="tiktok"
                                    value="{{ $general->tiktok }}"
                                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Tik Tok">
                                </div>
                              </div>

                            </div>
                          </div>

                          <h2 class="md:col-span-5 text-lg font-semibold text-slate-800 mt-2 dark:text-white">
                            Descripción de la empresa</h2>

                          <div class="md:col-span-5">
                            <label for="aboutus">Acerca de nosotros</label>
                            <div class="relative mb-2">
                              <div class="absolute top-3 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>
                              <textarea type="text" id="aboutus" name="aboutus"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nosotros...">{{ $general->aboutus }}</textarea>
                            </div>
                          </div>
                          <div class="md:col-span-5">
                            <label for="aboutus">Activar Banner Descuento por registro</label>
                            <div class="relative mb-2">
                              <div class="absolute top-3 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                  <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                  </path>
                                  <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                  </path>
                                </svg>
                              </div>


                              <input type="checkbox" name="is_active_discount" id="is_active_discount"
                                class="check_v btn_swithc relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent 
                                        rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none 
                                        checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700 
                                        dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6
                                        before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow 
                                        before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200"
                                id='{{ 'v_' . $general->id }}' data-field='destacar'
                                data-idService='{{ $general->id }}'
                                data-titleService='Actualizado informacion banner'
                                {{ $general->is_active_discount == 1 ? 'checked' : '' }}>
                              <label for="{{ 'v_' . $general->id }}"></label>

                            </div>
                          </div>
                          <div class="md:col-span-2">
                            <label for="inside">Url Google Maps</label>
                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                  xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48"
                                  viewBox="0 0 48 48">
                                  <linearGradient id="iu22Zjf0u3e5Ts0QLZZhJa_uzeKRJIGwbBY_gr1" x1="11.274"
                                    x2="36.726" y1="9.271" y2="34.723" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="#d43a02"></stop>
                                    <stop offset="1" stop-color="#b9360c"></stop>
                                  </linearGradient>
                                  <path fill="url(#iu22Zjf0u3e5Ts0QLZZhJa_uzeKRJIGwbBY_gr1)"
                                    d="M36.902,34.536C40.052,31.294,42,26.877,42,22c0-9.94-8.06-18-18-18S6,12.06,6,22	c0,4.877,1.948,9.294,5.098,12.536c0.018,0.019,0.03,0.04,0.048,0.059l0.059,0.059c0.047,0.048,0.094,0.095,0.142,0.142	l11.239,11.239c0.781,0.781,2.047,0.781,2.828,0l11.239-11.239c0.048-0.047,0.095-0.094,0.142-0.142l0.059-0.059	C36.873,34.576,36.885,34.554,36.902,34.536z">
                                  </path>
                                  <radialGradient id="iu22Zjf0u3e5Ts0QLZZhJb_uzeKRJIGwbBY_gr2" cx="24"
                                    cy="22.5" r="9.5" gradientUnits="userSpaceOnUse">
                                    <stop offset=".177"></stop>
                                    <stop offset="1" stop-opacity="0"></stop>
                                  </radialGradient>
                                  <circle cx="24" cy="22.5" r="9.5"
                                    fill="url(#iu22Zjf0u3e5Ts0QLZZhJb_uzeKRJIGwbBY_gr2)"></circle>
                                  <circle cx="24" cy="22" r="8" fill="#f9f9f9"></circle>
                                  <radialGradient id="iu22Zjf0u3e5Ts0QLZZhJc_uzeKRJIGwbBY_gr3" cx="23.842"
                                    cy="43.905" r="13.637" gradientUnits="userSpaceOnUse">
                                    <stop offset=".177"></stop>
                                    <stop offset="1" stop-opacity="0"></stop>
                                  </radialGradient>
                                  <path fill="url(#iu22Zjf0u3e5Ts0QLZZhJc_uzeKRJIGwbBY_gr3)"
                                    d="M24,30c-4.747,0-8.935,2.368-11.467,5.982l10.052,10.052c0.781,0.781,2.047,0.781,2.828,0	l10.052-10.052C32.935,32.368,28.747,30,24,30z">
                                  </path>
                                  <path fill="#de490d"
                                    d="M24,32c-4.196,0-7.884,2.157-10.029,5.42l8.615,8.615c0.781,0.781,2.047,0.781,2.828,0l8.615-8.615	C31.884,34.157,28.196,32,24,32z">
                                  </path>
                                </svg>
                              </div>
                              <input type="text" id="url_maps" name="url_maps" value="{{ $general->url_maps }}"
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Url Google maps">
                            </div>
                          </div>
                          <div class="md:col-span-5">
                            <div class="flex flex-row content-between justify-between items-baseline">
                              <div><label for="img_login">Imagen Login</label></div>

                              <div class="md:col-span-1">
                                <img class="w-20" src="{{ asset($general->img_login) }}" alt="">
                              </div>
                            </div>

                            <div class="relative mb-2">
                              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <img width="30" height="30"
                                  src="https://img.icons8.com/ios-glyphs/30/full-image.png" alt="full-image" />
                              </div>
                              <input type="file" id="img_login" name="img_login" value=""
                                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Url Google maps">
                            </div>

                          </div>

                          <!-- <div class="md:col-span-2">
                                            <label for="city">City</label>
                                            <input type="text" name="city" id="city" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="" placeholder="" />
                                        </div> -->

                          <!-- <div class="md:col-span-2">
                                            <label for="country">Country / region</label>
                                            <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                            <input name="country" id="country" placeholder="Country" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                                            <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                                                <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                            <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                                                <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                            </button>
                                            </div>
                                        </div> -->

                          <!-- <div class="md:col-span-2">
                                            <label for="state">State / province</label>
                                            <div class="h-10 bg-gray-50 flex border border-gray-200 rounded items-center mt-1">
                                            <input name="state" id="state" placeholder="State" class="px-4 appearance-none outline-none text-gray-800 w-full bg-transparent" value="" />
                                            <button tabindex="-1" class="cursor-pointer outline-none focus:outline-none transition-all text-gray-300 hover:text-red-600">
                                                <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </button>
                                            <button tabindex="-1" for="show_more" class="cursor-pointer outline-none focus:outline-none border-l border-gray-200 transition-all text-gray-300 hover:text-blue-600">
                                                <svg class="w-4 h-4 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                            </button>
                                            </div>
                                        </div> -->



                          <!-- <div class="md:col-span-5">
                                            <div class="inline-flex items-center">
                                            <input type="checkbox" name="billing_same" id="billing_same" class="form-checkbox" />
                                            <label for="billing_same" class="ml-2">My billing address is different than above.</label>
                                            </div>
                                        </div> -->

                          <div class="md:col-span-5 text-right mt-6">
                            <div class="inline-flex items-end">
                              <button type="submit" id="form_general" onclick="confirmarActualizacion()"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Actualizar
                                datos</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>



          </div>
        </div>
      </div>
      <div
        class="mt-3 col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
          <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">New Arrivals</h2>
        </header>

        <div class="p-3">

          <div>

            <div class="flex items-center justify-center">
              <div>
                <div>
                  <div>

                    <div class=" rounded shadow-lg p-4 px-4 ">
                      <div class="grid gap-4 gap-y-2 text-sm grid-cols-1">

                        <div class="lg:col-span-5">
                          <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                            <h2 class="md:col-span-5 text-lg font-semibold text-slate-800 dark:text-white">
                              Información de New Arrivals (Novedades)</h2>

                            <div class="md:col-span-2">
                              <label for="address">Texto Principal</label>
                              <div class="relative mb-2 ">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                    </path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                    </path>
                                  </svg>
                                </div>
                                <input type="text" id="textoPrincipal" name="textoPrincipal"
                                  value="{{ $archivoObjeto->newArribals['titulo'] }}"
                                  class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  placeholder="name@flowbite.com">
                              </div>
                            </div>

                            <div class="md:col-span-1">
                              <label for="inside">Numero de fondo</label>
                              <div class="relative mb-2">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                  <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                    </path>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z">
                                    </path>
                                  </svg>
                                </div>
                                <input type="number" id="numFondo" name="numFondo"
                                  value="{{ $archivoObjeto->newArribals['FondoNum'] }}"
                                  class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                  placeholder="Interior Oficina 204 - Piso 4">
                              </div>
                            </div>




                            <div class="md:col-span-5 text-right mt-6">
                              <div class="inline-flex items-end">
                                <button id="newArrivals"
                                  class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Actualizar
                                  datos New Arrivals </button>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>

  <script>
    $('document').ready(function() {

      // Función para mostrar la alerta de confirmación antes de enviar el formulario
      function confirmarActualizacion() {
        Swal.fire({
          title: '¿Estás seguro?',
          text: 'Esta acción actualizará los datos.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Sí, actualizar',
          cancelButtonText: 'Cancelar',
        }).then((result) => {
          if (result.isConfirmed) {
            // Envía el formulario si se confirma la acción
            document.getElementById('form_general').submit();
          }
        });
      }


      function mostrarAlerta() {
        Swal.fire({
          title: '¡Actualizado!',
          text: 'Los datos se han actualizado correctamente.',
          icon: 'success',
          confirmButtonText: 'Aceptar',
        });
      }


    });
  </script>

  <script>
    $('#newArrivals').on('click', function(e) {
      console.log('actualizando dato sdel json')
      e.preventDefault()
      // slider.updateJson

      let textoPrincipal = $("#textoPrincipal").val()
      let numFondo = $("#numFondo").val()


      let formData = new FormData();
      formData.append('_token', $('input[name="_token"]').val());
      formData.append('textoPrincipal', textoPrincipal);
      formData.append('numFondo', numFondo);


      $.ajax({
        url: "{{ route('newArribals.updateJson') }}",
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          Swal.fire({

            icon: "success",
            title: 'New Arribals Actualizado Correctamente',

          });


        },
        error: function(response) {

          Swal.close();
          Swal.fire({
            title: response.responseJSON.message,
            icon: "error",
          });



        }
      })
    })
  </script>


</x-app-layout>
