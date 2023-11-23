@props([
'class' => $props['class']
])

<x-app-layout>
  {{-- header===================================================== --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
        {{ __($class->course_name . " / " . $class->class_name) }}
    </h2>
  </x-slot>

  {{-- sections=================================================== --}}
  <div class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

      {{-- loop to render all sections in the class --}}
      @foreach ($class->sections($class->id) as $section)
      <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="mb-6 flex justify-between items-center">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $section->section_title }}
          </h3>
          <a class="hover:cusor-pointer" href="/section/{{ $section->id }}/edit">
            <svg class="w-5 h-5 text-gray-400 hover:text-gray-700 dark:text-gray-400 dark:hover:text-white" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
              <path
                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
              <path
                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
            </svg>
          </a>
        </div>

        <div class="flex flex-col gap-2">
          @foreach ($section->subsections as $subsection)
          <div class="flex gap-4 items-center">

            @if ($subsection->type == 1)
            <x-subsection-text 
              :title="$subsection->title" 
              :content="$subsection->text_content"
              :id="$subsection->id" />
            @endif

            @if ($subsection->type == 2)
            <x-subsection-file 
              :href="$subsection->file" 
              :title="$subsection->title"
              :id="$subsection->id" />
            @endif

            @if ($subsection->type == 3)
            <x-subsection-link 
              :href="$subsection->url" 
              :title="$subsection->title" 
              :id="$subsection->id"/>
            @endif

            @if ($subsection->type == 4)
            <x-subsection-assignment 
              :title="$subsection->title"
              :deadline="$subsection->deadline"
              :instruction="$subsection->instruction"
              :id="$subsection->id" />
            @endif
          </div>
          @endforeach
          {{-- add new subsection --}}
          <div class="flex gap-4 items-center">
            <div id="choose-subsec-{{ $section->id }}" onclick="openSubsecBtns({{ $section->id }})"
              class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 flex items-center justify-center hover:cursor-pointer hover:bg-gray-300 group">
              <svg class="w-4 h-4 text-gray-400 dark:text-white group-hover:text-gray-700 dark:group-hover:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 1v16M1 9h16" />
              </svg>
            </div>

            <div id="subsec-btn-{{ $section->id }}" class="hidden flex gap-4 items-center">
              
              <div onclick="openAddSubsectionModal('/section/{{ $section->id }}/store-text', {{ $section->id }}, 'text')"
                class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 flex items-center justify-center hover:cursor-pointer hover:bg-gray-300 group">
                <svg class="w-5 h-5 text-gray-400 dark:text-white group-hover:text-gray-700 dark:group-hover:text-white" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 2V1h10v1M6 1v12m-2 0h4m3-6V6h6v1m-3-1v7m-1 0h2" />
                </svg>
              </div>
              
              <div onclick="openAddSubsectionModal('/section/{{ $section->id }}/store-file', {{ $section->id }}, 'file')"
                class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 flex items-center justify-center hover:cursor-pointer hover:bg-gray-300 group">
                <svg class="w-5 h-5 text-gray-400 dark:text-white group-hover:text-gray-700 dark:group-hover:text-white" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                  <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                  <path
                    d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Z" />
                </svg>
              </div>
              
              <div onclick="openAddSubsectionModal('/section/{{ $section->id }}/store-link', {{ $section->id }}, 'link')"
                class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 flex items-center justify-center hover:cursor-pointer hover:bg-gray-300 group">
                <svg class="w-5 h-5 text-gray-400 dark:text-white group-hover:text-gray-700 dark:group-hover:text-white" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                </svg>
              </div>
              
              <div onclick="openAddSubsectionModal('/section/{{ $section->id }}/store-assignment', {{ $section->id }}, 'assignment')"
                class="w-10 h-10 rounded-lg bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 flex items-center justify-center hover:cursor-pointer hover:bg-gray-300 group">
                <svg class="w-5 h-5 text-gray-400 dark:text-white group-hover:text-gray-700 dark:group-hover:text-white" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="m14.707 4.793-4-4a1 1 0 0 0-1.416 0l-4 4a1 1 0 1 0 1.416 1.414L9 3.914V12.5a1 1 0 0 0 2 0V3.914l2.293 2.293a1 1 0 0 0 1.414-1.414Z" />
                  <path
                    d="M18 12h-5v.5a3 3 0 0 1-6 0V12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                </svg>
              </div>
            </div>

          </div>

        </div>
      </div>
      @endforeach


      {{-- section template --}}
      {{-- <div class="mb-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="mb-4">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            Section title
          </h3>
        </div>
        <div class="flex flex-col gap-2">
          <div class="flex gap-4 items-center">
            <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
              <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 18 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M1 2V1h10v1M6 1v12m-2 0h4m3-6V6h6v1m-3-1v7m-1 0h2" />
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-900">This is a text sub-section</p>
            </div>
          </div>

          <div class="flex gap-4 items-center">
            <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
              <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 16 20">
                <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                <path
                  d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Z" />
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-900">
                This is a file
              </p>
            </div>
          </div>

          <div class="flex gap-4 items-center">
            <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
              <svg class="w-6 h-6 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
              </svg>
            </div>
            <div>
              <p class="text-sm font-medium text-gray-900">
                This is a link
              </p>
            </div>
          </div>

          <div class="flex gap-4 items-center">
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
              <p class="text-sm font-medium text-gray-900">Student submission sub-section</p>
            </div>
          </div>
        </div>
      </div> --}}

      {{-- add section form --}}
      <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <form id="add-section-form" class="hidden" action="/class/{{ $class->id }}/edit" method="POST">
          @csrf
          <div class="max-w-xl">
            {{-- Add section header --}}
            <div class="flex justify-between items-center rounded-t sm:mb-3.5 dark:border-gray-600">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                New section
              </h3>
            </div>
            {{-- Add section main --}}
            <input type="number" name="class_id" id="class_id" class="hidden" value="{{ $class->id }}">
            <div class="flex flex-col">
              <label class="block font-medium text-sm text-gray-700 dark:text-white" for="section_title">Section title</label>
              <input required
                class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                type="text" name="section_title" id="section_title">
            </div>
            {{-- Add section footer --}}
            <button type="submit"
              class="px-3.5 py-2 mt-4 text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
              Save
            </button>
            <button id="close-add-section-btn" type="button"
              class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
              Cancel
            </button>
          </div>
        </form>

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
@include('class.modals.addText')
@include('class.modals.addFile')
@include('class.modals.addLink')
@include('class.modals.addAssignment')

<script>
  // handling text editor in add text modal
  function markUp( markup ) {
    document.execCommand( markup, false, url );
  }
  const textEditor = document.getElementById('editor');
  let textEditorFlag = 0;
  textEditor.addEventListener('click', function() {
    if(textEditorFlag === 0) {
      textEditor.innerHTML = '';
      textEditorFlag = 1;
    }
  });
  function updateTextarea() {
    var editorContent = document.getElementById("editor").innerHTML;
    document.querySelector(".formTextarea").value = editorContent;
  }
</script>