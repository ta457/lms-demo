@props([
'subsection' => $props['subsection'],
'section' => $props['section'],
'class' => $props['class'],
'submissions' => $props['submissions']
])

<x-app-layout>
  {{-- header===================================================== --}}
  <x-slot name="header">
    <div class="flex items-center">
      <x-goback-btn href="/class/{{ $class->id }}" />
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __($section->section_title).' / '.$subsection->title }}
      </h2>
    </div>
  </x-slot>

  {{-- main =================================================== --}}
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="mb-6 flex justify-between items-center">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $subsection->title }}
          </h3>
        </div>

        <div class="text-sm text-gray-900 dark:text-white">
          @if (\Carbon\Carbon::now()->lt($subsection->deadline))
          <!-- Code to display when the current date is before the model's datetime -->
          <strong>Deadline:
            <p class="inline-block text-emerald-500">
              {{ $subsection->deadline }}
            </p>
          </strong>
          @else
          <!-- Code to display when the current date is after or equal to the model's datetime -->
          <strong>Deadline:
            <p class="inline-block text-rose-500">
              {{ $subsection->deadline }}
            </p>
          </strong>
          @endif
        </div>

        <div class="mt-2 text-sm text-gray-900 dark:text-white border-b border-gray-200 pb-2">
          <strong>Instruction: </strong>
          <p>{{ $subsection->instruction }}</p>
        </div>

        <div class="mt-2 text-sm text-gray-900 dark:text-white border-b border-gray-200 pb-2">
          <strong>Your submissions: </strong>
          <div class="flex gap-4 mt-2">
            @forelse ($submissions as $submission)
              @if ($submission->student->id == Auth::user()->id)
              <div
                class="relative hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 group flex flex-col gap-2 p-2 block w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24 bg-gray-200 rounded-lg">
                <a href="/storage/student-submissions/{{ $submission->file }}" target="_blank"
                  class="text-sm text-gray-700 dark:text-gray-400 dark:hover:text-white w-full hover:font-semibold hover:underline">
                  {{ $submission->shortened_file_name }}
                </a>
                <div class="flex flex-col justify-center items-center">
                  <svg class="group-hover:text-gray-700 w-6 h-6 text-gray-400 dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                    <path
                      d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Z" />
                  </svg>
                  <p class="mt-0.5 text-sm font-bold text-gray-600 dark:text-gray-400 dark:group-hover:text-white">
                    {{ $submission->file_extension }}
                  </p>
                </div>

                <button id="/submission/{{ $submission->id }}"
                  class="absolute bottom-2 right-2 p-1 shadow-md text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                  <svg class="w-4 h-4 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 18 20">
                    <path
                      d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                  </svg>
                </button>
              </div>
              @endif
            @empty
              <p class="text-sm">You haven't submitted anything.</p>
            @endforelse
          </div>
        </div>

        <div class="mt-2 text-sm text-gray-900 dark:text-white">
          <strong>Upload: </strong>
        </div>
        <form action="/assignment/{{ $subsection->id }}" method="POST" enctype="multipart/form-data">
          @csrf
          <article aria-label="File Upload Modal" class="relative h-full flex flex-col bg-white dark:bg-gray-800"
            ondrop="dropHandler(event);" ondragover="dragOverHandler(event);" ondragleave="dragLeaveHandler(event);"
            ondragenter="dragEnterHandler(event);">
            <!-- overlay -->
            <div id="overlay"
              class="w-full h-full absolute top-0 left-0 pointer-events-none z-50 flex flex-col items-center justify-center rounded-md">
              <i>
                <svg class="fill-current w-12 h-12 mb-3 text-blue-700" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" viewBox="0 0 24 24">
                  <path
                    d="M19.479 10.092c-.212-3.951-3.473-7.092-7.479-7.092-4.005 0-7.267 3.141-7.479 7.092-2.57.463-4.521 2.706-4.521 5.408 0 3.037 2.463 5.5 5.5 5.5h13c3.037 0 5.5-2.463 5.5-5.5 0-2.702-1.951-4.945-4.521-5.408zm-7.479-1.092l4 4h-3v4h-2v-4h-3l4-4z" />
                </svg>
              </i>
              <p class="text-lg text-blue-700">Drop files to upload</p>
            </div>

            <!-- scroll area -->
            <section class="h-full mt-2 w-full h-full flex flex-col">
              <header
                class="rounded-lg bg-gray-50 dark:bg-gray-900 border-dashed border-2 border-gray-400 py-12 flex flex-col justify-center items-center">
                <p class="dark:text-gray-200 mb-3 font-semibold text-sm text-gray-900 flex flex-wrap justify-center">
                  <span>Drag and drop your</span>&nbsp;<span>files here or</span>
                </p>

                <input id="hidden-input" type="file" name='files[]' multiple class="hidden" required />

                <button id="button" type="button"
                  class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                  Upload a file
                </button>
              </header>

              {{-- <h1 class="pt-2 pb-3 font-semibold sm:text-sm text-gray-900">
                To Upload
              </h1> --}}

              <ul id="gallery" class="my-3 flex flex-1 flex-wrap -m-1">
                <li id="empty" class="h-full w-full text-center flex flex-col items-center justify-center items-center">
                  {{-- <img class="mx-auto w-32"
                    src="https://user-images.githubusercontent.com/507615/54591670-ac0a0180-4a65-11e9-846c-e55ffce0fe7b.png"
                    alt="no data" /> --}}
                    <svg class="w-16 h-16 mx-auto mt-6 mb-2 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                      <path d="M5 9V4.13a2.96 2.96 0 0 0-1.293.749L.879 7.707A2.96 2.96 0 0 0 .13 9H5Zm11.066-9H9.829a2.98 2.98 0 0 0-2.122.879L7 1.584A.987.987 0 0 0 6.766 2h4.3A3.972 3.972 0 0 1 15 6v10h1.066A1.97 1.97 0 0 0 18 14V2a1.97 1.97 0 0 0-1.934-2Z"/>
                      <path d="M11.066 4H7v5a2 2 0 0 1-2 2H0v7a1.969 1.969 0 0 0 1.933 2h9.133A1.97 1.97 0 0 0 13 18V6a1.97 1.97 0 0 0-1.934-2Z"/>
                    </svg>
                  <span class="text-sm font-semibold text-gray-500">No files selected</span>
                </li>
              </ul>
            </section>

            <!-- sticky footer -->
            <footer class="flex justify-end">
              <button id="submit" type="submit"
                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Upload
              </button>
            </footer>
          </article>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
{{-- confirm delete modal ========================================================= --}}
<button class="hidden" id="deleteButton" data-modal-target="deleteModal" data-modal-toggle="deleteModal"></button>
<!-- Main modal -->
<div id="deleteModal" tabindex="-1" aria-hidden="true"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
  <div class="relative p-4 w-full max-w-md h-full md:h-auto">
    <!-- Modal content -->
    <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
      <button type="button"
        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
        data-modal-toggle="deleteModal">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
            clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close modal</span>
      </button>
      <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor"
        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd"
          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
          clip-rule="evenodd"></path>
      </svg>
      <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this file?</p>
      <div class="flex justify-center items-center space-x-4">
        <button data-modal-toggle="deleteModal" type="button"
          class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
          No, cancel
        </button>
        <form id="delete-file" action="" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit"
            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
            Yes, I'm sure
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- upload files component========================================================== -->
<!-- using two similar templates for simplicity in js code -->
<template id="file-template">
  <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
    <article tabindex="0"
      class="group w-full h-full rounded-lg focus:outline-none focus:shadow-outline elative bg-gray-100 cursor-pointer relative shadow-sm">
      <img alt="upload preview" class="img-preview hidden w-full h-full sticky object-cover rounded-lg bg-fixed" />

      <section class="flex flex-col rounded-lg text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
        <h1 class="flex-1 group-hover:text-blue-800"></h1>
        <div class="flex">
          <span class="p-1 text-blue-800">
            <i>
              <svg class="fill-current w-4 h-4 ml-auto pt-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path d="M15 2v5h5v15h-16v-20h11zm1-2h-14v24h20v-18l-6-6z" />
              </svg>
            </i>
          </span>
          <p class="p-1 size text-xs text-gray-700"></p>
          <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-lg text-gray-800">
            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24">
              <path class="pointer-events-none"
                d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
            </svg>
          </button>
        </div>
      </section>
    </article>
  </li>
</template>
<template id="image-template">
  <li class="block p-1 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/6 xl:w-1/8 h-24">
    <article tabindex="0"
      class="group hasImage w-full h-full rounded-lg focus:outline-none focus:shadow-outline bg-gray-100 cursor-pointer relative text-transparent hover:text-white shadow-sm">
      <img alt="upload preview" class="img-preview w-full h-full sticky object-cover rounded-lg bg-fixed" />

      <section class="flex flex-col rounded-lg text-xs break-words w-full h-full z-20 absolute top-0 py-2 px-3">
        <h1 class="flex-1"></h1>
        <div class="flex">
          <span class="p-1">
            <i>
              <svg class="fill-current w-4 h-4 ml-auto pt-" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24">
                <path
                  d="M5 8.5c0-.828.672-1.5 1.5-1.5s1.5.672 1.5 1.5c0 .829-.672 1.5-1.5 1.5s-1.5-.671-1.5-1.5zm9 .5l-2.519 4-2.481-1.96-4 5.96h14l-5-8zm8-4v14h-20v-14h20zm2-2h-24v18h24v-18z" />
              </svg>
            </i>
          </span>

          <p class="p-1 size text-xs"></p>
          <button class="delete ml-auto focus:outline-none hover:bg-gray-300 p-1 rounded-lg">
            <svg class="pointer-events-none fill-current w-4 h-4 ml-auto" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" viewBox="0 0 24 24">
              <path class="pointer-events-none"
                d="M3 6l3 18h12l3-18h-18zm19-4v2h-20v-2h5.711c.9 0 1.631-1.099 1.631-2h5.316c0 .901.73 2 1.631 2h5.711z" />
            </svg>
          </button>
        </div>
      </section>
    </article>
  </li>
</template>

<script>
  let deleteBtns = document.querySelectorAll('[id^="/submission/"]');
  console.log(deleteBtns);
  deleteBtns.forEach(btn => {
    btn.addEventListener('click', function() {
      const dynamicNumber = btn.id.split("/")[2];
      console.log(dynamicNumber);
      document.getElementById('deleteButton').click();
      const form = document.getElementById('delete-file');
      form.action = `/submission/${dynamicNumber}`;
    })
  });

  const fileTempl = document.getElementById("file-template"),
  imageTempl = document.getElementById("image-template"),
  empty = document.getElementById("empty");

  // use to store pre selected files
  let FILES = {};

  // check if file is of type image and prepend the initialied
  // template to the target element
  function addFile(target, file) {
    const isImage = file.type.match("image.*"),
    objectURL = URL.createObjectURL(file);

    const clone = isImage
    ? imageTempl.content.cloneNode(true)
    : fileTempl.content.cloneNode(true);

    clone.querySelector("h1").textContent = file.name;
    clone.querySelector("li").id = objectURL;
    clone.querySelector(".delete").dataset.target = objectURL;
    clone.querySelector(".size").textContent =
    file.size > 1024
      ? file.size > 1048576
        ? Math.round(file.size / 1048576) + "mb"
        : Math.round(file.size / 1024) + "kb"
      : file.size + "b";

    isImage &&
    Object.assign(clone.querySelector("img"), {
      src: objectURL,
      alt: file.name
    });

    empty.classList.add("hidden");
    target.prepend(clone);

    FILES[objectURL] = file;
  }

  const gallery = document.getElementById("gallery"),
  overlay = document.getElementById("overlay");

  // click the hidden input of type file if the visible button is clicked
  // and capture the selected files
  const hidden = document.getElementById("hidden-input");
  document.getElementById("button").onclick = () => hidden.click();
  hidden.onchange = (e) => {
    for (const file of e.target.files) {
      addFile(gallery, file);
    }
  };

  // use to check if a file is being dragged
  const hasFiles = ({ dataTransfer: { types = [] } }) =>
  types.indexOf("Files") > -1;

  // use to drag dragenter and dragleave events.
  // this is to know if the outermost parent is dragged over
  // without issues due to drag events on its children
  let counter = 0;

  // reset counter and append file to gallery when file is dropped
  function dropHandler(ev) {
    ev.preventDefault();
    for (const file of ev.dataTransfer.files) {
    addFile(gallery, file);
    overlay.classList.remove("draggedover");
    counter = 0;
    }
  }

  // only react to actual files being dragged
  function dragEnterHandler(e) {
    e.preventDefault();
    if (!hasFiles(e)) {
      return;
    }
    ++counter && overlay.classList.add("draggedover");
  }

  function dragLeaveHandler(e) {
    1 > --counter && overlay.classList.remove("draggedover");
  }

  function dragOverHandler(e) {
    if (hasFiles(e)) {
      e.preventDefault();
    }
  }

  // event delegation to caputre delete events
  // fron the waste buckets in the file preview cards
  gallery.onclick = ({ target }) => {
    if (target.classList.contains("delete")) {
      const ou = target.dataset.target;
      document.getElementById(ou).remove(ou);
      gallery.children.length === 1 && empty.classList.remove("hidden");
      delete FILES[ou];
    }
  };

  // print all selected files
  // document.getElementById("submit").onclick = () => {
  //   alert(`Submitted Files:\n${JSON.stringify(FILES)}`);
  //   console.log(FILES);
  // };

  // clear entire selection
  document.getElementById("cancel").onclick = () => {
    while (gallery.children.length > 0) {
    gallery.lastChild.remove();
  }
  FILES = {};
    empty.classList.remove("hidden");
    gallery.append(empty);
  };

  // ===============================================================================

</script>

<style>
  .hasImage:hover section {
    background-color: rgba(5, 5, 5, 0.4);
  }

  .hasImage:hover button:hover {
    background: rgba(5, 5, 5, 0.45);
  }

  #overlay p,
  i {
    opacity: 0;
  }

  #overlay.draggedover {
    background-color: rgba(255, 255, 255, 0.7);
  }

  #overlay.draggedover p,
  #overlay.draggedover i {
    opacity: 1;
  }

  .group:hover .group-hover\:text-blue-800 {
    color: #2b6cb0;
  }
</style>