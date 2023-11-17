@props([
'subsection' => $props['subsection'],
'section' => $props['section'],
'class' => $props['class'],
'submissions' => $props['submissions']
])

<x-app-layout>
  {{-- header===================================================== --}}
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __($subsection->title . ' / Student submissions') }}
    </h2>
  </x-slot>

  {{-- sections=================================================== --}}
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mb-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">

        <div class="text-sm text-gray-900">
          @if (\Carbon\Carbon::now()->lt($subsection->deadline))
          <!-- Code to display when the current date is before the model's datetime -->
          <strong>Deadline:
            <p class="inline-block text-emerald-500">
              {{ $subsection->deadline }}
            </p>
          </strong>
          @else
          <!-- Code to display when the current date is after or equal to the model's datetime -->
          <strong>Deadline:
            <p class="inline-block text-rose-500">
              {{ $subsection->deadline }}
            </p>
          </strong>
          @endif
        </div>

        <div class="mt-2 text-sm text-gray-900pb-2">
          <strong>Instruction: </strong>
          <p class="mt-2">{{ $subsection->instruction }}</p>
        </div>

        <table class="mt-4 w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-4 py-3">student ID</th>
              <th scope="col" class="px-4 py-3">student name</th>
              <th scope="col" class="px-4 py-3">file</th>
              <th scope="col" class="px-4 py-3">submitted at</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($submissions->groupBy('student_id') as $userId => $userSubmissions)
              @foreach ($userSubmissions as $submission)
              <tr class="border-b bg-gray-50 dark:border-gray-700">
                @if ($loop->first)
                <td class="px-4 py-3" rowspan="{{ $userSubmissions->count() }}">{{ $userId }}</td>
                <td class="px-4 py-3" rowspan="{{ $userSubmissions->count() }}">{{ $submission->student->name }}</td>
                @endif

                <td class="px-4 py-3">
                  <a class="text-primary-600" href="/storage/student-submissions/{{ $submission->file }}" target="_blank">
                    {{ $submission->file }}
                  </a>
                </td>
                <td @if (!$submission->updated_at->greaterThan($subsection->deadline))
                  class="px-4 py-3 text-emerald-500"
                  @else
                  class="px-4 py-3 text-rose-500"
                  @endif
                  >
                  {{ $submission->updated_at }}
                </td>
              </tr>
              @endforeach
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>