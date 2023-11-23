{{-- <x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-admin-sidebar />

    <x-admin-table :props="$props">Classes</x-admin-table>

    <!-- Main modal -->
    <x-modal-addClass :props="$props"/>
  </div>
</x-app-layout> --}}

@props([
'classes' => $props['classes'],
'courses' => $props['courses']
])

<x-admin-layout :data="$classes">
  {{-- Page header ----------------------------------------------------------- --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Admin Panel / Classes') }} 
        <x-header-message />
    </h2>
  </x-slot>

  {{-- Table header ---------------------------------------------------------- --}}
  <x-admin-table-header action="/admin-dashboard/classes">
    <select name="course_id"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
      <option @if (request('course_id') == 0) @selected(true) @endif  value="0">All</option>
      @foreach ($courses as $course)
        <option value="{{ $course->id }}"
          @if (request('course_id') == $course->id)
            @selected(true)  
          @endif  
        >
          {{ $course->course_name }}
        </option>
      @endforeach
    </select>
  </x-admin-table-header>

  {{-- Table body ------------------------------------------------------------ --}}
  <div class="overflow-x-auto">
    <x-admin-table-body action='/admin-dashboard/classes' :heads="['ID','Class Name','Course']">
      <tbody>
        @foreach ($classes as $class)
        <tr class="border-b dark:border-gray-700">
          <td class="px-4 py-3">
            <input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" 
              type="checkbox" name="selected[]" value="{{ $class->id }}">
          </td>
          <td class="px-4 py-3">
            {{ $class->id }}
          </td>
          <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $class->class_name }}
          </th>
          <td class="px-4 py-3">
            {{ $class->course->course_name }}
          </td>
          <x-admin-table-dropdown action='/admin-dashboard/classes' :id="$class->id" />
        </tr>
        @endforeach
      </tbody>
    </x-admin-table-body>
  </div>

  <!-- Create User modal ------------------------- -->
  <x-admin-create-modal action="/admin-dashboard/classes" header="Create new class">
    {{-- modal form input fields --}}
    <div>
      <label for="class_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Name</label>
      <input type="text" name="class_name" id="class_name"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Database class 1" required>
    </div>
    <div>
      <label for="course_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
      <select id="course_id" name="course_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option selected="">Select course</option>
        @foreach ($courses as $course)
          <option value="{{ $course->id }}">{{ $course->course_name }}</option>         
        @endforeach
      </select>
    </div>
  </x-admin-create-modal>

  <!-- Delete modal ------------------------------ -->
  <x-admin-delete-modal />
  <x-admin-delete-all-modal />
</x-admin-layout>