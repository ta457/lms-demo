@props([
'class' => $props['class'],
'users' => $props['users']
])

<x-admin-layout :data="$users">
  <x-slot name="header">
    <div class="flex justify-between items-center">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Admin Panel / Class ID = ') }}{{ $class->id }}
          <x-header-message />
      </h2>
      <x-goback-btn href="/admin-dashboard/classes" />
    </div>
  </x-slot>

  <!-- Update modal -->
  {{-- <div class="relative p-4 w-full max-w-2xl max-h-full">
    <!-- Modal content -->

  </div> --}}
  <div class="bg-white dark:bg-gray-800 px-5 pb-8">
    <!-- section header========================================================= -->
    <div id="classMembersHeader" class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
        Class members
      </h3>
    </div>
    <!-- table header----------------------------------------------------------- -->
    <div class="overflow-auto">
      <x-classMembers-table-header action="/admin-dashboard/classes/{{ $class->id }}/members">
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
      </x-classMembers-table-header>
    
      {{-- users/members table------------------------------------------------- --}}
      <form action="/admin-dashboard/classes/{{ $class->id }}/update-members" method="POST">
        @csrf
        @method('PATCH')
        @php $tableHeadline = ['ID','Name','Username','Email','Role']; @endphp
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-4 py-3"></th>
              @foreach ($tableHeadline as $head)
                <th scope="col" class="px-4 py-4">{{ $head }}</th>
              @endforeach
              <th scope="col" class="px-4 py-3">
                <span class="sr-only">Actions</span>
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
            <tr class="border-b dark:border-gray-700">
              <td class="px-4 py-3">
                <input onclick="showMemberChangesMessage('Class members changed!')"
                  @if ($class->isUserInClass($user->id))
                    @checked(true)
                  @endif
                  class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" 
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
              <input type="number" class="hidden" name="class_id" id="class_id" value="{{ $class->id }}">
              <button id="update-member-btn" type="submit" class="hidden"></button>
            </tr>
            @endforeach
          </tbody>
        </table>
        <button id="realDeleteAllBtn" type="submit" class="hidden"></button>
      </form>
    </div>
  </div>
</x-admin-layout>