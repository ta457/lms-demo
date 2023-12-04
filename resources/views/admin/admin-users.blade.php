@props([
'users' => $props['users'],
'faculties' => $props['faculties']
])

<x-admin-layout :data="$users">
  {{-- Page header ----------------------------------------------------------- --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Admin Panel / Users') }} 
        <x-header-message />
    </h2>
  </x-slot>

  {{-- Table header ---------------------------------------------------------- --}}
  <x-admin-table-header action="/admin-dashboard/users">
    <select name="filter_role"
      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full px-2 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
      <option @if (request('filter_role') == 0) @selected(true) @endif  value="0">All</option>
      <option value="2" @if (request('filter_role') == 2)
        @selected(true)
        @endif
        >
        Student
      </option>
      <option value="3" @if (request('filter_role') == 3)
        @selected(true)
        @endif
        >
        Teacher
      </option>
    </select>
  </x-admin-table-header>

  {{-- Table body ------------------------------------------------------------ --}}
  <div class="overflow-x-auto">
    <x-admin-table-body 
      action='/admin-dashboard/users/destroy-all' 
      :heads="['ID','Name','Username','Email','Role','Faculty']">
      <tbody>
        @foreach ($users as $user)
        <tr class="border-b dark:border-gray-700">
          <td class="px-4 py-3">
            <input class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" 
              type="checkbox" name="selected[]" value="{{ $user->id }}">
          </td>
          <td class="px-4 py-3">
            {{ $user->id }}
          </td>
          <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $user->name }}
          </th>
          <td class="px-4 py-3">
            {{ $user->username }}
          </td>
          <td class="px-4 py-3">
            {{ $user->email }}
          </td>
          <td class="px-4 py-3">
            {{ $user->role_name }}
          </td>
          <td class="px-4 py-3">
            {{ $user->faculty_name }}
          </td>
          <x-admin-table-dropdown action='/admin-dashboard/users' :id="$user->id" />
        </tr>
        @endforeach
      </tbody>
    </x-admin-table-body>
  </div>

  <!-- Create User modal ------------------------- -->
  <x-admin-create-modal action="/admin-dashboard/users" header="Create new user">
    {{-- modal form input fields --}}
    <div>
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
      <input type="text" name="name" id="name"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="John Doe" required>
    </div>
    <div>
      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
      <input type="text" name="username" id="username"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="johndoe" required>
    </div>
    <div>
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
      <input type="email" name="email" id="email"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="johndoe@gmail.com" required>
    </div>
    <div>
      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
      <input type="password" name="password" id="password"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
        placeholder="12345678" required>
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
    <div>
      <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
      <select id="role" name="role"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
        <option selected="">Select role</option>
        <option value="2">Student</option>
        <option value="3">Teacher</option>
      </select>
    </div>
  </x-admin-create-modal>

  <!-- Delete modal ------------------------------ -->
  <x-admin-delete-modal />
  <x-admin-delete-all-modal />
</x-admin-layout>