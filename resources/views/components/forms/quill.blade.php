<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

<div id="quill-{{ $id }}" name="quill-{{ $id }}"
  class="h-60 mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-b-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-0  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
  {!! $value !!}</div>
<textarea style="display: none" id="{{ $id }}" name="{{ $id }}">{!! $value !!}</textarea>

<script>
  $('document').ready(function() {

    const quill = new Quill('#quill-{{ $id }}', {
      theme: 'snow'
    });

    quill.on('text-change', function(delta, oldDelta, source) {
      if (source === 'user') {

        // Obtener el contenido HTML actual del editor
        var html = quill.root.innerHTML;

        // Crear un elemento temporal para manipular el contenido HTML
        var tempElem = document.createElement('div');
        tempElem.innerHTML = html;
        tempElem.classList.add('prose')

        $('#{{ $id }}').val(tempElem.outerHTML);
        $('#{{ $id }}').text(tempElem.outerHTML);
      }
    });

  })
</script>
