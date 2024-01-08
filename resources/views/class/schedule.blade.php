@props([
'timeline' => $props['timeline']
])

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto py-6 px-4 rounded-lg bg-white dark:bg-gray-700 shadow-md">
            <table class="w-full border border-gray-300">
                <thead>
                    <tr>
                        <th class="text-gray-900 dark:text-white text-center py-2 px-4 border-b border-r">Period</th>
                        <th class="text-gray-900 dark:text-white text-center py-2 px-4 border-b border-r">Monday</th>
                        <th class="text-gray-900 dark:text-white text-center py-2 px-4 border-b border-r">Tuesday</th>
                        <th class="text-gray-900 dark:text-white text-center py-2 px-4 border-b border-r">Wednesday</th>
                        <th class="text-gray-900 dark:text-white text-center py-2 px-4 border-b border-r">Thursday</th>
                        <th class="text-gray-900 dark:text-white text-center py-2 px-4 border-b">Friday</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($period = 1; $period <= 10; $period++)
                        <tr>
                            @for ($day = 0; $day < 6; $day++)
                                @if ($day == 0) 
                                    <td class="text-gray-900 dark:text-white text-center py-2 px-4 border-b border-r">{{ $period }}</td> 
                                @else
                                    @php $realPeriod = $period + $day*10 - 10 @endphp
                                    {{-- if this cell is not null and the cell before also not null --}}
                                    {{-- means this realPeriod is in a class but not the start => not print (bcs of the rowspan) --}}
                                    @if ($timeline[$realPeriod - 1] != null && $timeline[$realPeriod] != null)
                                    @else
                                        @php $active = $timeline[$realPeriod] != null && $timeline[$realPeriod - 1] == null; @endphp
                                        <td class="text-gray-900 dark:text-white text-center py-2 px-4 border-b border-r border-2
                                                @if ($active) 
                                                    bg-gray-200 dark:bg-gray-800 border-gray-400
                                                @endif
                                            "
                                            @if ($active)
                                                rowspan="{{ $timeline[$realPeriod][0] }}"
                                            @endif
                                        >
                                            @if($timeline[$realPeriod] != null)
                                                <strong>{{$timeline[$realPeriod][1]->course->course_name}}</strong>
                                                <br>
                                                Class: {{$timeline[$realPeriod][1]->class_name}}
                                            @endif
                                        </td>
                                    @endif
                                @endif
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table> 
        </div>
    </div>
</x-app-layout>