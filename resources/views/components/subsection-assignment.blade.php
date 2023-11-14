<div class="border-b border-gray-200 w-full pb-2">
  <div class="flex justify-between items-center w-full">
    <a href="/section/{{ $subsection }}/submit" class="flex gap-4 items-center group">
      <div class="w-10 h-10 rounded-lg bg-gray-200 flex items-center justify-center">
        <svg class="w-5 h-5 text-gray-400 dark:text-white group-hover:text-gray-700" aria-hidden="true"
          xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path
            d="m14.707 4.793-4-4a1 1 0 0 0-1.416 0l-4 4a1 1 0 1 0 1.416 1.414L9 3.914V12.5a1 1 0 0 0 2 0V3.914l2.293 2.293a1 1 0 0 0 1.414-1.414Z" />
          <path
            d="M18 12h-5v.5a3 3 0 0 1-6 0V12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
        </svg>
      </div>
      <div>
        <p class="text-sm font-medium text-primary-600 group-hover:text-primary-500">
          {{ $title }}
        </p>
      </div>
    </a>
    @if (Auth::user()->role == '3')
    <button class="hover:cusor-pointer">
      <svg class="w-5 h-5 text-gray-400 hover:text-gray-700 dark:text-white" aria-hidden="true"
        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
        <path
          d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
        <path
          d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
      </svg>
    </button>
    @endif
  </div>
  
  <div class="px-2 mt-2 ml-4 text-sm text-gray-700 border-l-2 border-gray-400">
    <div>
      <strong>Deadline: <p class="inline-block text-emerald-500">{!! $deadline !!}</p></strong>
    </div>
    <div class="mt-1">
      <strong>Instruction: </strong>
      <p>{!! $instruction !!}</p>
    </div>
  </div>
</div>