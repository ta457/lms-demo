<div class="border-b border-gray-200 dark:border-gray-600 w-full pb-2">
  <div class="flex justify-between items-center w-full">
    <div class="flex gap-4 items-center group">
      <div class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
        <svg class="w-5 h-5 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
          fill="none" viewBox="0 0 18 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 2V1h10v1M6 1v12m-2 0h4m3-6V6h6v1m-3-1v7m-1 0h2" />
        </svg>
      </div>
      <div>
        <p class="text-sm font-medium text-gray-900 dark:text-white">
          {{ $title }}
        </p>
      </div>
    </div>
    @if (Auth::user()->role == '3')
    <a class="hover:cusor-pointer" href="/subsection/{{ $id }}/edit-text">
      <svg class="w-5 h-5 text-gray-400 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
        <path
          d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
        <path
          d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
      </svg>
    </a>
    @endif
  </div>

  <div class="px-2 mt-2 ml-4 text-sm text-gray-700 dark:text-gray-200 border-l-2 border-gray-400">
    {!! $content !!}
  </div>
</div>

