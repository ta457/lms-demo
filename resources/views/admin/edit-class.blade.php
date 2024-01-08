{{-- <x-app-layout>
  <form action="/admin-dashboard/classes/{{ $props['class']->id }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="grid lg:grid-cols-6 h-screen">
      
      <x-modal-editClass :props="$props"/>
      <x-delete-modal :props="$props" />

    </div>
  </form>
</x-app-layout> --}}


@props([
'class' => $props['class'],
'schedule' => $props['class']->schedule,
'courses' => $props['courses'],
'members' => $props['members'],
'users' => $props['users']
])

<x-admin-layout>
  <x-slot name="header">
    <div class="flex items-center">
      <x-goback-btn href="/admin-dashboard/classes" />
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Admin Panel / Class ID = ') }}{{ $class->id }}
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
        Update Class 
      </h3>
    </div>
    <!-- Modal body -->
    <div class="grid gap-4 mb-4 md:grid-cols-2">
      <div>
        <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Created at</label>
        <input type="text" name="created_at" id="created_at"
          class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
          placeholder="{{ $class->created_at }}" readonly>
      </div>
      <div>
        <label for="updated_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Updated at</label>
        <input type="text" name="updated_at" id="updated_at"
          class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
          placeholder="{{ $class->updated_at }}" readonly>
      </div>
    </div>
    <form action="/admin-dashboard/classes/{{ $class->id }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="grid gap-4 mb-4 md:grid-cols-2">
        <div>
          <label for="class_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class name</label>
          <input type="text" name="class_name" id="class_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            value="{{ $class->class_name }}" required>
        </div>
        <div>
          <label for="course_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course</label>
          <select id="course_id" name="course_id"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            @foreach ($courses as $course)
              <option value="{{ $course->id }}" @if ($course->id == $class->course_id) @selected(true) @endif>
                {{ $course->course_name }}
              </option>         
            @endforeach
          </select>
        </div>
        <div>
          <label for="day_of_week" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Day of week</label>
          <select id="day_of_week" name="day_of_week"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option @if ($schedule->day_of_week == 1) @selected(true) @endif value="1">Monday</option>
            <option @if ($schedule->day_of_week == 2) @selected(true) @endif value="2">Tuesday</option>
            <option @if ($schedule->day_of_week == 3) @selected(true) @endif value="3">Wednesday</option>
            <option @if ($schedule->day_of_week == 4) @selected(true) @endif value="4">Thursday</option>
            <option @if ($schedule->day_of_week == 5) @selected(true) @endif value="5">Friday</option>
          </select>
        </div>
        <div>
          <label for="start_period" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start period</label>
          <select id="start_period" name="start_period"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option @if ($schedule->start_period == 1) @selected(true) @endif value="1">1</option>
            <option @if ($schedule->start_period == 2) @selected(true) @endif value="2">2</option>
            <option @if ($schedule->start_period == 3) @selected(true) @endif value="3">3</option>
            <option @if ($schedule->start_period == 4) @selected(true) @endif value="4">4</option>
            <option @if ($schedule->start_period == 5) @selected(true) @endif value="5">5</option>
            <option @if ($schedule->start_period == 6) @selected(true) @endif value="6">6</option>
            <option @if ($schedule->start_period == 7) @selected(true) @endif value="7">7</option>
            <option @if ($schedule->start_period == 8) @selected(true) @endif value="8">8</option>
            <option @if ($schedule->start_period == 9) @selected(true) @endif value="9">9</option>
            <option @if ($schedule->start_period == 10) @selected(true) @endif value="10">10</option>
          </select>
        </div>
        <div>
          <label for="end_period" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End period</label>
          <select id="end_period" name="end_period"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option @if ($schedule->end_period == 1) @selected(true) @endif value="1">1</option>
            <option @if ($schedule->end_period == 2) @selected(true) @endif value="2">2</option>
            <option @if ($schedule->end_period == 3) @selected(true) @endif value="3">3</option>
            <option @if ($schedule->end_period == 4) @selected(true) @endif value="4">4</option>
            <option @if ($schedule->end_period == 5) @selected(true) @endif value="5">5</option>
            <option @if ($schedule->end_period == 6) @selected(true) @endif value="6">6</option>
            <option @if ($schedule->end_period == 7) @selected(true) @endif value="7">7</option>
            <option @if ($schedule->end_period == 8) @selected(true) @endif value="8">8</option>
            <option @if ($schedule->end_period == 9) @selected(true) @endif value="9">9</option>
            <option @if ($schedule->end_period == 10) @selected(true) @endif value="10">10</option>
          </select>
        </div>
      </div>
      <div class="flex items-center justify-between">
        <button type="submit"
          class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          Save
        </button>
        <a href="/admin-dashboard/classes/{{ $class->id }}/members"
          class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
          Edit class members
        </a>
      </div>
    </form>
  </div>
</x-admin-layout>