@extends('components.public.matrix')
@section('title', 'Catalogo | ' . config('app.name', 'Laravel'))

@section('css_importados')

@stop


@section('content')
  <main class="flex flex-col gap-12 -mb-12" id='catalogoBlade' {{-- 'general', 'faqs', 'categorias', 'testimonie', 'filtro',  'categoria', 'atributos', 'colecciones' --}}
    data-General="{{ json_encode($general) }}" data-faqs="{{ json_encode($faqs) }}"
    data-categorias="{{ json_encode($categorias) }}" data-testimonie="{{ json_encode($testimonie) }}"
    data-filtro="{{ json_encode($filtro) }}" data-categoria="{{ json_encode($categoria) }}"
    data-atributos="{{ json_encode($atributos) }}" data-colecciones="{{ json_encode($colecciones) }}"
    data-appUrl="{{ config('app.url') }}">

  </main>

@endsection


<script>
  var appUrl = document.getElementById('catalogoBlade').getAttribute('data-appUrl');
</script>
