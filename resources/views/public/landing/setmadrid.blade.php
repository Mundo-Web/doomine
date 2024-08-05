@extends('components.landing.matrix')

@section('css_importados')

@stop


@section('content')

    <main>
        <div id="container" class="w-[93%] mx-auto ">

            <section id="banner" class="grid z-30  bg-cover bg-bottom" style="background-image: url('{{ asset('images/landing/banner1.png') }}');">
                <div class="infoBanner w-10/12 mx-auto  text-white py-20 lg:py-40">
                    <h2 class="text-[32px] lg:text-[40px] xl:text-[60px] font-regularItalicDisplay">Exclusivo y Elegante</h2>
                    <h1 class="text-[40px] lg:text-[60px] xl:text-[80px] font-boldItalicDisplay">Set Madrid con ¡30% OFF!
                    </h1>
                    <p class="text-[18px] lg:text-[20px] font-regularDisplay mb-8">
                        Entra en el mundo de la moda con actitud. Descrubre el Set Madrid, con un conjunto diseñado para
                        mujeres y jóvenes y sofisticadas como tu. Regístrate ahora y se la primera en lucirlo con un 30% de
                        descuento exclusivo
                    </p>
                    <a href=""
                        class="group border-2 hover:text-black border-white rounded-full py-2 font-mediumItalicDisplay flex flex-row items-center justify-center lg:w-[440px] w-[300px] text-[14px] lg:text-[20px] hover:bg-white">¡OFERTA
                        DISPONIBLE SOLO AQUÍ! <i class="group-hover:text-black fa-solid fa-circle-arrow-right text-4xl ml-4"></i></a>
                </div>
            </section>

            <section class="grid grid-cols-1 lg:grid-cols-2  lg:-mt-[5%] gap-12 mt-12 ">
                <div class="w-full xl:w-9/12 content-center justify-self-end">
                    <h3 class="font-boldDisplay text-[28px]">NEW ARRIVALS</h3>
                    <h2 class="font-boldItalicDisplay text-[40px] lg:text-[60px] xl:text-[80px]">Set Madrid</h2>
                    <p class=" font-lightDisplay text-2xl">Visualiza la sofisticación y el diseño del Set Madrid. Esta
                        prenda, que solo puede ser vista y comprada a través de este enlace exclusivo, es la combinación
                        perfecta de comodidad y estilo.</p>
                </div>
                <img src="{{ asset('images/landing/banner2.png') }}" alt="">
            </section>

            <section class="mt-12 xl:mt-36 w-full">
                <h2 class="font-boldItalicDisplay text-[28px] text-center">BENEFICIOS</h2>
                <h3 class="font-boldItalicDisplay text-[40px] lg:text-[60px] xl:text-[80px] text-center">¿Por qué elegir Set
                    Madrid?</h3>

                <div class="grid grid-cols-1 lg:grid-cols-7 mt-12 xl:mt-24 w-full">
                    <div class="col-span-2 grid">
                        <div class="cards content-center  xl:justify-self-end space-y-12 xl:space-y-32">
                            <div class="card">
                                <h4 class="font-boldItalicDisplay text-3xl w-52">Estilo Sofisticado</h4>
                                <p class="font-lightDisplay text-2xl w-80">Diseño elegante que se adapta a cualquier
                                    ocasión</p>
                            </div>
                            <div class="card">
                                <h4 class="font-boldItalicDisplay text-3xl w-52">Calidad Premium</h4>
                                <p class="font-lightDisplay text-2xl w-80">Materiales de alta calidad que garantizan
                                    durabilidad y confort</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-3 px-[10%] lg:px-20 py-12">
                        <img src="{{ asset('images/landing/banner3final.png') }}"  alt="" width="100%">
                    </div>

                    <div class="col-span-2 grid">
                        <div class="cards content-center justify-self-start space-y-12 xl:space-y-32">
                            <div class="card">
                                <h4 class="font-boldItalicDisplay text-3xl w-52">Versatibilidad</h4>
                                <p class="font-lightDisplay text-2xl w-80">Perfecto para eventos formales e informales</p>
                            </div>
                            <div class="card">
                                <h4 class="font-boldItalicDisplay text-3xl w-52">Exclusividad</h4>
                                <p class="font-lightDisplay text-2xl w-80">Disponibilidad solo a través de esta oferta
                                    especial</p>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section>
                <div class="grid grid-cols-1 lg:grid-cols-5 mt-20 xl:mt-32 space-y-10 lg:space-y-0">
                    <div class="col-span-3 w-full lg:w-9/12 lg:mx-auto">
                        <h3 class="font-boldDisplay text-2xl">COMPLETA Y GANA 30% OFF</h3>
                        <h2 class="font-boldItalicDisplay text-[40px] lg:text-[60px] ">
                            Regístrate y Obtén tu Descuento
                        </h2>
                        <p class="font-lightDisplay text-[24px]">Para acceder a esta oferta exclusiva y disfrutar del 30% de
                            descuento en el Set Madrid, simplemente completa el formulario a continuación. ¡Es rápido y
                            fácil!</p>
                    </div>
                    <div class="col-span-2 bg-[#f5f5f5] pb-10">

                        <form action="" class=" mx-auto w-10/12 space-y-8"  id="formContactosLanding">
                            @csrf
                            <div>
                                <div class="mb-4">
                                    <label for="" class="text-[#6C7275]">Nombre Completo</label>
                                </div>
                                <div class="">
                                    <input name="full_name" type="text" class="rounded-xl w-full py-4 px-4 ring-0 focus:ring-0 border-0 border-transparent focus:border-0" placeholder="Ingresa tu nombre">
                                </div>

                            </div>

                            <div>
                                <div class="mb-4">
                                    <label for="" class="text-[#6C7275]">Correo Electrónico</label>
                                </div>
                                <div class="">
                                    <input name="email" id="email" type="text" class="rounded-xl w-full py-4 px-4 ring-0 focus:ring-0 border-0 border-transparent focus:border-0" placeholder="Ingresa tu correo electrónico">
                                </div>

                            </div>
                            <div>
                                <div class="mb-4">
                                    <label for="" class="text-[#6C7275]">Celular</label>
                                </div>
                                <div class="">
                                    <input name="phone" id="telefono" type="text" class="rounded-xl w-full py-4 px-4 ring-0 focus:ring-0 border-0 border-transparent focus:border-0" placeholder="+51">
                                </div>
                                <input type="hidden" name="source" value="Landing - Set Madrid">
                            </div>

                            <div class="mt-14">
                                <button type="submit"
                                    class="bg-black w-full text-white rounded-full px-4 py-4 block text-center text-sm lg:text-base">REGÍSTRATE
                                    AHORA Y AHORRA 30% OFF</button>
                            </div>
                        </form>
                        <div class="overflow-y-auto h-36 mx-auto w-10/12 mt-8 bg-scroll">
                            <h3>Política de Privacidad y Términos de Uso</h3>
                            <p class="text-[#6C7275] my-4">
                                Al registrarte para el descuento exclusivo del 30% en el Set Madrid, aceptas nuestras
                                políticas de privacidad y términos de uso. Usaremos tu información solo para procesar tu
                                solicitud y enviarte promociones y noticias de nuestros productos. Tu privacidad es
                                importante para nosotros. No compartiremos tus datos con terceros sin tu consentimiento.
                                Para más detalles, consulta nuestra Política de Privacidad y Términos de Uso. Si tienes
                                preguntas, contáctanos en info@doomie.com
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="banner" class="grid  bg-cover mt-16 xl:mt-32" style="background-image: url('{{ asset('images/landing/banner4.png') }}');">
                <div class="infoBanner w-11/12 xl:w-8/12 mx-auto  text-white py-44 text-center">
                    <h2 class="text-[32px] lg:text-[60px] font-boldItalicDisplay">NO TE PIERDAS ESTA OPORTUNIDAD</h2>
                    <p class="text-xl font-lightDisplay mb-8">
                        Regístrate ahora y obtén tu Set Madrid con un 30% de descuento. Esta oferta exclusiva está
                        disponible solo a través de esta página. ¡Sé la primera en lucir este elegante traje de campaña!
                    </p>
                    <a href=""
                        class="rounded-full py-3 px-3 lg:px-6 text-lg lg:text-[20px] font-mediumItalicDisplay bg-black text-white">OBTEN
                        TU
                        DESCUENTO AHORA </a>
                </div>
            </section>
        </div>

    </main>

    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Políticas de privacidad
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        With less than a month to go before the European Union enacts new consumer privacy laws for its
                        citizens, companies around the world are updating their terms of service agreements to comply.
                    </p>
                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                        The European Union’s General Data Protection Regulation (G.D.P.R.) goes into effect on May 25 and is
                        meant to ensure a common set of data rights in the European Union. It requires organizations to
                        notify users as soon as possible of high-risk data breaches that could personally affect them.
                    </p>
                </div>
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal" type="button"
                        class="text-white bg-terciario p-3 rounded-lg">Aceptar</button>
                </div>
            </div>
        </div>
    </div>



@section('scripts_importados')

@stop

@stop
