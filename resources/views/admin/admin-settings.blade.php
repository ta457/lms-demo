@props([
  'backgroundExtension' => $props['backgroundExtension']
])

<x-admin-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('Admin Panel / Settings') }} 
      <x-header-message />
    </h2>
  </x-slot>

  <div class="pb-5 sm:px-4 sm:pb-8 sm:pt-4">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
      Log in background
    </h2>
  
    <div class="max-w-xl">
      <div class="mt-6">
        <p class="block font-medium text-sm text-gray-700 dark:text-gray-300">
          Preview
        </p>
        <div class="mt-1 relative grid place-items-center">
          <div class="absolute bg-white dark:bg-gray-800 w-1/3 h-1/3 z-50 rounded-sm p-2 flex flex-col justify-between">
            <p class="text-gray-900 dark:text-white font-semibold" style="font-size: 10px">Log in</p>
            <div>
              <div style="height: 16px" 
                class="rounded-sm w-full border border-gray-200 dark:border-gray-600">
              </div>
              <div style="height: 16px" 
                class="rounded-sm w-full border border-gray-200 dark:border-gray-600 mt-2">
              </div>
            </div>
            <div style="height: 16px" class="rounded-sm w-full bg-primary-700"></div>
          </div>
          @if (is_null($backgroundExtension))
            <img 
              class="z-0 max-h-96 rounded-lg w-full filter brightness-75 dark:brightness-50" 
              src="/img/background.jpg" alt="bg"
            >
          @else
            <img class="z-0 max-h-96 rounded-lg w-full filter brightness-75 dark:brightness-50" 
              src="/storage/login-background/background.{{ $backgroundExtension }}" alt="bg"
            >
          @endif
        </div>
      </div>

      <form action="/admin-dashboard/settings" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mt-6">
          <label for="loginbg" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
            Upload new background image (under 2MB)
          </label>
          <input type="file" name="loginbg" id="loginbg"
            class="mt-1 block w-full font-normal text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
          >
        </div>
        <button class="mt-6 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          Save
        </button>
      </form>
    </div>
  </div>
</x-admin-layout>