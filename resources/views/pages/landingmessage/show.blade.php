<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl">Mensaje de {{ $message->full_name }}</h2>
      </header>
      <div class="p-3">

        <div class="p-6">

          <p class="font-bold">Correo:</p>
          <p> {{ $message->email }} </p>
          <br>
          <p class="font-bold">Telefono:</p>
          <p class="mb-5">
            {{ $message->phone }}
          </p>

          <a href="{{ route('mensajesLanding') }}" class="bg-blue-500 px-4 py-2 rounded text-white"><span><i
                class="fa-solid fa-arrow-left mr-2"></i></span> Volver</a>

        </div>
      </div>
    </div>
    <div class="flex justify-end mt-3">
      <button id="imprimirPedido" type="button"
        class="bg-blue-500 w-28  px-4 py-2 rounded text-white flex justify-between align-content-center content-center items-center ">
        Imprimir
        <div class="w-4 justify-center align-content-center">
          <svg xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
            <path fill="#FFFFFF"
              d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
          </svg>
        </div>

      </button>

    </div>

  </div>





</x-app-layout>
<script>
  $(document).ready(function() {
    $('#imprimirPedido').on("click", function() {
      // Obtén la URL usando Blade
      var url = "{{ route('descargarPdf.mensaje', $message->id) }}";

      // Redirige en una nueva pestaña
      window.open(url, '_blank');
    });
  });
</script>
