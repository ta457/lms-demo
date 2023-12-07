<li>
  @if ($active)
    <a href="{{ $href }}"
      class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-700 group">
      {{ $slot }}
      <span class="ml-3 font-semibold">{{ $label }}</span>
    </a>
  @else
    <a href="{{ $href }}"
      class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
      {{ $slot }}
      <span class="ml-3">{{ $label }}</span>
    </a>
  @endif
</li>