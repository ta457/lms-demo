@props([
  'faculty' => $props['faculty']
])

<!-- Main modal -->
<div class="col-span-6 w-full h-screen flex items-center">
<div class="p-4 w-full max-w-2xl h-full md:h-auto mx-auto mb-20">
  <!-- Modal content -->
  <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
    <!-- Modal header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        Update Faculty ID = {{ $faculty->id }}
      </h3>
      <a href="/admin-dashboard/faculties"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
        data-modal-toggle="updateProductModal">
        <svg class="mr-2 w-4 h-4 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
        </svg>
        Go back
      </a>
    </div>
    <!-- Modal body -->
    <form action="/admin-dashboard/faculties/{{ $faculty->id }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="grid gap-4 mb-4 sm:grid-cols-2">
        <div>
          <label for="faculty_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Faculty name</label>
          <input type="text" name="faculty_name" id="faculty_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            value="{{ $faculty->faculty_name }}" required="">
        </div>
      </div>
      <button type="submit"
        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        Update
      </button>
    </form>
  </div>
</div>
</div>