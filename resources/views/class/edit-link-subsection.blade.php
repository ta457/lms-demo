@props([
'subsection' => $props['subsection'],
'url' => $props['url']
])

<x-app-layout>
  {{-- header===================================================== --}}
  <x-slot name="header">
    <div class="flex items-center">
      <x-goback-btn href="/class/{{ $subsection->section->class->id }}/edit" />
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __($subsection->title . ' / Edit') }}
      </h2>
    </div>
  </x-slot>

  {{-- sections=================================================== --}}
  <div class="py-12">
    <div class="max-w-7xl mx-auto ">
      <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

        <div class="max-w-2xl px-4 ">
          <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Update subsection</h2>
          <form action="/subsection/{{ $subsection->id }}/edit-link" method="POST">
            @csrf
            @method('PATCH')
            <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
              <div class="sm:col-span-2">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                  New title
                </label>
                <input type="text" name="title" id="title"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                  value="{{ $subsection->title }}">
              </div>
              <div class="sm:col-span-2">
                <label for="url" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                  New link
                </label>
                <input type="text" name="url" id="url"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                  value="{{ $subsection->url }}">
              </div>
            </div>
            <div class="flex items-center space-x-4">
              <button type="submit"
                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Update
              </button>
              <button type="button" id="deleteButton" data-modal-toggle="deleteModal" 
                class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">
                <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd"
                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                    clip-rule="evenodd"></path>
                </svg>
                Delete
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

<x-delete-modal :props="$props" />