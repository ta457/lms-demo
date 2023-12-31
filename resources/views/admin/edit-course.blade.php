{{-- <x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-modal-editCourse :props="$props"/>
    <x-delete-modal :props="$props" />

  </div>
</x-app-layout> --}}

@props([
'course' => $props['course'],
'faculties' => $props['faculties']
])

<x-admin-layout>
  <x-slot name="header">
    <div class="flex items-center">
      <x-goback-btn href="/admin-dashboard/courses" />
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Admin Panel / Course ID = ') }}{{ $course->id }}
          <x-header-message />
      </h2>
    </div>
  </x-slot>

  <!-- Update modal -->
  {{-- <div class="relative p-4 w-full max-w-2xl max-h-full">
    <!-- Modal content -->

  </div> --}}
  <div class="bg-white dark:bg-gray-800 px-5 pb-8">
    <!-- Modal header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        Update Course 
      </h3>
    </div>
    <!-- Modal body -->
    <div class="grid gap-4 mb-4 md:grid-cols-2">
      <div>
        <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Created at</label>
        <input type="text" name="created_at" id="created_at"
          class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
          placeholder="{{ $course->created_at }}" readonly>
      </div>
      <div>
        <label for="updated_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Updated at</label>
        <input type="text" name="updated_at" id="updated_at"
          class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
          placeholder="{{ $course->updated_at }}" readonly>
      </div>
    </div>
    <form action="/admin-dashboard/courses/{{ $course->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PATCH')
      <div class="grid gap-4 mb-4 md:grid-cols-2">
        
        <div>
          <label for="course_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course name</label>
          <input type="text" name="course_name" id="course_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            value="{{ $course->course_name }}" required>
        </div>
        
        <div>
          <label for="faculty_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Faculty</label>
          <select id="faculty_id" name="faculty_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            @foreach ($faculties as $f)
              <option value="{{ $f->id }}" @if ($f->id == $course->faculty_id) @selected(true) @endif>
                {{ $f->faculty_name }}
              </option>         
            @endforeach
          </select>
        </div>

        <div>
          <label for="img" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course background (under 2MB)</label>
          
          @if (is_null($course->img))
            <img class="max-w-md rounded-lg" 
              src="/storage/courses-bg/default.jpg" alt="course-bg">
          @else
            <img class="max-w-md rounded-lg" 
              src="/storage/{{ $course->img }}" alt="course-bg">
          @endif
          <input type="file" name="img" id="img"
            class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        </div>
      </div>
      
      <button type="submit"
        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
        Save
      </button>
    </form>
  </div>
</x-admin-layout>