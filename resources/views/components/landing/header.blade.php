<style>
  html {
    scroll-behavior: smooth;
  }
</style>
<header>
  <div id="top" class="bg-black py-2 text-white text-center italic w-full">
    Registrate y obtén un 30% de descuento en tu primer pedido <span class="font-bold underline"><a
        href="#formContactosLanding">Regístrate ahora</a></span>
  </div>
  <div id="container" class="w-[93%] mx-auto ">
    <div id="buttonsTop"
      class="flex flex-col sm:flex-row justify-center items-center sm:justify-between py-7 sm:py-10 gap-10">
      <div>
        <img src="{{ asset('images/landing/logo.webp') }}" alt="" width="180px" height="auto">
      </div>
      <div>
        <a href="#formContactosLanding" class="bg-black rounded-full text-white px-16 py-4 font-mediumItalicDisplay">LO
          QUIERO</a>
      </div>
    </div>
  </div>
</header>
<script>
  document.querySelector('a[href="#formContactosLanding"]').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('#formContactosLanding').scrollIntoView({
      behavior: 'smooth'
    });
  });
</script>
