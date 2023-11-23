@props([
'class' => $props['class'],
'users' => $props['users']
])

<x-app-layout>
  {{-- header===================================================== --}}
  <x-slot name="header">
    <div class="flex items-center">
      <x-goback-btn href="/class/{{ $class->id }}/edit" />
      <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
          {{ __($class->class_name . " / Members") }}
      </h2>
    </div>
  </x-slot>

  {{-- sections=================================================== --}}
  <div class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="overflow-auto">
          <x-teach-classMem-table-header action="/class/{{ $class->id }}/members">
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
          </x-teach-classMem-table-header>
        
          {{-- users/members table------------------------------------------------- --}}
          <form action="/class/{{ $class->id }}/members" method="POST">
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
                  <td></td>
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
    </div>
  </div>
</x-app-layout>