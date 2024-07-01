<div id="quill-{{ $name }}" name="quill-{{ $name }}"
  class="h-60 mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
  placeholder="Descripción">{!! $value !!}</div>
<input id="{{ $name }}" hidden="true" name="{{ $name }}" value='{!! $value !!}' />

<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<script>
  $('document').ready(function() {

    const quill = new Quill('#quill-{{ $name }}', {
      theme: 'snow'
    });
    /* quill.on('text-change', function() {
      const value = quill.root.innerHTML;
      console.log(value)
      $('#{{ $name }}').attr('value', value);
    }) */

    quill.on('text-change', function(delta, oldDelta, source) {
      if (source === 'user') {

        // Obtener el contenido HTML actual del editor
        var html = quill.root.innerHTML;

        // Crear un elemento temporal para manipular el contenido HTML
        var tempElem = document.createElement('div');
        tempElem.innerHTML = html;

        // Aplicar clases de Tailwind CSS a los encabezados dentro del contenido HTML
        ['h1', 'h2', 'h3'].forEach(function(tagName) {
          var elements = tempElem.getElementsByTagName(tagName);
          for (var i = 0; i < elements.length; i++) {
            // Aplicar clases según el tipo de encabezado
            if (tagName === 'h1') {
              elements[i].classList.add('text-4xl', 'font-bold', 'mt-4', 'mb-2');
            } else if (tagName === 'h2') {
              elements[i].classList.add('text-3xl', 'font-semibold', 'mt-3', 'mb-2');
            } else if (tagName === 'h3') {
              elements[i].classList.add('text-2xl', 'font-medium', 'mt-3', 'mb-1');
            }
          }
        });


        $('#{{ $name }}').attr('value', tempElem.innerHTML);
      }
    });

  })
</script>
