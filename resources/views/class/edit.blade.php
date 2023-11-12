@props([
  'class' => $props['class']
])

<x-app-layout>
  {{-- header===================================================== --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __($class->course_name . " / " . $class->class_name) }}
    </h2>
  </x-slot>

  {{-- sections=================================================== --}}
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      @foreach ($class->sections($class->id) as $section)
      <div class="mb-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="mb-6">
          <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
            {{ $section->section_title }}
          </h3>
        </div>
      </div>
      @endforeach


      {{-- section template --}}
      <div class="mb-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="mb-6">
          <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
            Section title
          </h3>
        </div>

        <div class="mb-4 flex gap-4 items-center">
          <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 16 20">
              <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
              <path
                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Z" />
            </svg>
          </div>
          <div>
            <p class="text-base font-semibold text-gray-900">This is a file</p>
          </div>
        </div>

        <div class="mb-4 flex gap-4 items-center">
          <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 18 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 2V1h10v1M6 1v12m-2 0h4m3-6V6h6v1m-3-1v7m-1 0h2" />
            </svg>
          </div>
          <div>
            <p class="text-base font-semibold text-gray-900">This is a text sub-section</p>
          </div>
        </div>

        <div class="mb-4 flex gap-4 items-center">
          <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
            <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="currentColor" viewBox="0 0 20 20">
              <path
                d="m14.707 4.793-4-4a1 1 0 0 0-1.416 0l-4 4a1 1 0 1 0 1.416 1.414L9 3.914V12.5a1 1 0 0 0 2 0V3.914l2.293 2.293a1 1 0 0 0 1.414-1.414Z" />
              <path
                d="M18 12h-5v.5a3 3 0 0 1-6 0V12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
            </svg>
          </div>
          <div>
            <p class="text-base font-semibold text-gray-900">Student submission sub-section</p>
          </div>
        </div>
      </div>

      {{-- add section form --}}
      <div class="mb-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <form id="add-section-form" class="hidden" action="/class/{{ $class->id }}/edit" method="POST">
          @csrf
          <div class="max-w-xl">
            {{-- Add section header --}}
            <div class="flex justify-between items-center rounded-t sm:mb-5 dark:border-gray-600">
              <h3 class="text-2xl font-semibold text-gray-900 dark:text-white">
                New section
              </h3>
              {{-- <button type="button" id="close-add-section-btn"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close modal</span>
              </button> --}}
            </div>
            {{-- Add section main --}}
            <input type="number" name="class_id" id="class_id" class="hidden" value="{{ $class->id }}">
            <div class="flex flex-col">
              <label class="block font-medium text-sm text-gray-700" for="section_title">Section title</label>
              <input class="border-gray-300 focus:ring-primary-500 focus:border-primary-500 rounded-md shadow-sm font-normal mt-1 block w-full" 
                type="text" name="section_title" id="section_title">
            </div>
            {{-- Add section footer --}}
            <button type="submit"
              class="px-3.5 py-2 mt-6 text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              Save
            </button>
            <button id="close-add-section-btn" type="button"
              class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
              Cancel
            </button>
          </div>
        </form>

        {{-- Choose subsection --}}
        <div id="choose-subsection" class="w-full hidden bg-gray-50 border-2 border-gray-300 border-dashed rounded-lg">
          <div class="flex justify-between items-center rounded-t dark:border-gray-600">
            <div></div>
            <button type="button" id="close-add-section-btn"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
              <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                  clip-rule="evenodd"></path>
              </svg>
              <span class="sr-only">Close modal</span>
            </button>
          </div>
          <div class="h-32 flex flex-col gap-4 items-center">
            <div class="flex gap-4 justify-center">
              <div id="add-file-btn"
                class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center cursor-pointer hover:bg-gray-300">
                <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor" viewBox="0 0 16 20">
                  <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                  <path
                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Z" />
                </svg>
              </div>
              <div id="add-text-btn"
                class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center cursor-pointer hover:bg-gray-300">
                <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 18 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 2V1h10v1M6 1v12m-2 0h4m3-6V6h6v1m-3-1v7m-1 0h2" />
                </svg>
              </div>
              <div id="add-sub-btn"
                class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center cursor-pointer hover:bg-gray-300">
                <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="m14.707 4.793-4-4a1 1 0 0 0-1.416 0l-4 4a1 1 0 1 0 1.416 1.414L9 3.914V12.5a1 1 0 0 0 2 0V3.914l2.293 2.293a1 1 0 0 0 1.414-1.414Z" />
                  <path
                    d="M18 12h-5v.5a3 3 0 0 1-6 0V12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                </svg>
              </div>
            </div>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400 font-semibold">
              Choose a subsection
            </p>
          </div>
        </div>

        {{-- Add section toggle --}}
        <div class="flex items-center justify-center w-full">
          <button id="add-section-btn"
            class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
              <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 1v16M1 9h16" />
              </svg>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Add a section</span>
              </p>
            </div>
            <a href="#" class="hidden"></a>
          </button>
        </div>

      </div>

    </div>
  </div>
</x-app-layout>

<script>
  const addSectionBtn = document.getElementById('add-section-btn');
  const closeAddSectionBtn = document.getElementById('close-add-section-btn');
  const addSectionForm = document.getElementById('add-section-form');
  
  const addFileBtn = document.getElementById('add-file-btn');
  const addTextBtn = document.getElementById('add-text-btn');
  const addSubBtn = document.getElementById('add-sub-btn');

  addSectionBtn.addEventListener('click', function () {
    addSectionForm.classList.remove('hidden');
    addSectionBtn.classList.add('hidden');
  });
  closeAddSectionBtn.addEventListener('click', function () {
    addSectionForm.classList.add('hidden');
    addSectionBtn.classList.remove('hidden');
  })
</script>