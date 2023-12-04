{{-- <x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-admin-sidebar />

    <x-admin-table :props="$props">Courses</x-admin-table>

    <!-- Main modal -->
    <x-modal-addCourse :props="$props" />
  </div>
</x-app-layout> --}}

@props([
'courses' => $props['courses'],
'faculties' => $props['faculties']
])

<x-admin-layout :data="$courses">
  {{-- Page header ----------------------------------------------------------- --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Admin Panel / Courses') }} 
        <x-header-message />
    </h2>
  </x-slot>

  {{-- Table header ---------------------------------------------------------- --}}
  <x-admin-table-header action="/admin-dashboard/courses">
    <select name="faculty_id"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
      <option @if (request('faculty_id') == 0) @selected(true) @endif  value="0">All</option>
      @foreach ($faculties as $faculty)
        <option value="{{ $faculty->id }}"
          @if (request('faculty_id') == $faculty->id)
            @selected(true)  
          @endif  
        >
          {{ $faculty->faculty_name }}
        </option>
      @endforeach
    </select>
  </x-admin-table-header>

  {{-- Table body ------------------------------------------------------------ --}}
  <div class="overflow-x-auto">
    <x-admin-table-body action='/admin-dashboard/courses/destroy-all' 
      :heads="['ID','Course Name','Faculty']">
      <tbody>
        @foreach ($courses as $course)
        <tr class="border-b dark:border-gray-700">
          <td class="px-4 py-3">
            <input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" 
              type="checkbox" name="selected[]" value="{{ $course->id }}">
          </td>
          <td class="px-4 py-3">
            {{ $course->id }}
          </td>
          <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $course->course_name }}
          </th>
          <td class="px-4 py-3">
            {{ $course->faculty_name }}
          </td>
          <x-admin-table-dropdown action='/admin-dashboard/courses' :id="$course->id" />
        </tr>
        @endforeach
      </tbody>
    </x-admin-table-body>
  </div>

  <!-- Create User modal ------------------------- -->
  <x-admin-create-modal action="/admin-dashboard/courses" header="Create new course">
    {{-- modal form input fields --}}
    <div>
      <label for="course_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Name</label>
      <input type="text" name="course_name" id="course_name"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Database" required>
    </div>
    <div>
      <label for="faculty_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Faculty</label>
      <select id="faculty_id" name="faculty_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option selected="">Select faculty</option>
        @foreach ($faculties as $f)
          <option value="{{ $f->id }}">{{ $f->faculty_name }}</option>         
        @endforeach
      </select>
    </div>
  </x-admin-create-modal>

  <!-- Delete modal ------------------------------ -->
  <x-admin-delete-modal />
  <x-admin-delete-all-modal />
</x-admin-layout>