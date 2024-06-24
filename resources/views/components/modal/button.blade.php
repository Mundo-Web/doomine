<button id="{{ $id ?? '' }}" data-modal-target="{{ $ref }}" data-modal-toggle="{{ $ref }}"
  class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 {{ isset($isHidden) ? 'hidden' : '' }}"
  type="button">
  {{ $slot }}
</button>
