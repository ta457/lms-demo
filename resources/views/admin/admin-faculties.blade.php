@props([
'faculties' => $props['faculties']
])

<x-admin-layout :data="$faculties">
  {{-- Page header ----------------------------------------------------------- --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Admin Panel / Faculties') }} 
        <x-header-message />
    </h2>
  </x-slot>

  {{-- Table header ---------------------------------------------------------- --}}
  <x-admin-table-header action="/admin-dashboard/faculties">
  </x-admin-table-header>

  {{-- Table body ------------------------------------------------------------ --}}
  <div class="overflow-x-auto">
    <x-admin-table-body action='/admin-dashboard/faculties/destroy-all' 
      :heads="['ID','Faculty']">
      <tbody>
        @foreach ($faculties as $faculty)
        <tr class="border-b dark:border-gray-700">
          <td class="px-4 py-3">
            <input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" 
              type="checkbox" name="selected[]" value="{{ $faculty->id }}">
          </td>
          <td class="px-4 py-3">
            {{ $faculty->id }}
          </td>
          <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $faculty->faculty_name }}
          </th>
          <x-admin-table-dropdown action='/admin-dashboard/faculties' :id="$faculty->id" />
        </tr>
        @endforeach
      </tbody>
    </x-admin-table-body>
  </div>

  <!-- Create faculty modal ------------------------- -->
  <x-admin-create-modal action="/admin-dashboard/faculties" header="Create new faculty">
    {{-- modal form input fields --}}
    <div>
      <label for="faculty_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Faculty name</label>
      <input type="text" name="faculty_name" id="faculty_name"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="Computer Science" required>
    </div>
  </x-admin-create-modal>

  <!-- Delete modal ------------------------------ -->
  <x-admin-delete-modal />
  <x-admin-delete-all-modal />
</x-admin-layout>