<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My courses') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 gap-6 flex flex-col md:grid md:grid-cols-2 xl:grid-cols-3">
            @foreach ($classes as $class)
                <a @if (Auth::user()->role == 2)
                    href="/class/{{ $class->id }}"
                    @else
                    href="/class/{{ $class->id }}/edit"
                    @endif
                    id="classLink-{{ $class->id }}"
                    class="card h-fit shadow-lg drop-shadow-lg relative bg-white hover:shadow-xl max-w-sm rounded-lg
                        dark:bg-gray-800 dark:border-gray-700">
                    <div class="relative p-4 z-10 text-gray-900 dark:text-gray-200">
                        <div class="flex justify-between items-center mb-2">
                            {{-- <span
                                class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                    </path>
                                </svg>
                                Tutorial
                            </span>
                            <span class="text-sm">{{ $class->days_difference }} days ago</span> --}}
                            
                            @if (is_null($class->course->img))
                                <img class="w-full h-44 rounded-lg filter dark:brightness-75" 
                                    src="/storage/courses-bg/default.jpg" alt="course-bg">
                            @else
                                <img class="w-full h-44 rounded-lg filter dark:brightness-75" 
                                    src="/storage/{{ $class->course->img }}" alt="course-bg">
                            @endif
                            
                        </div>
                        <h2 class="mb-2 text-2xl font-semibold tracking-tight dark:text-gray-200">
                            {{ $class->course->course_name }}
                        </h2>
                        <p class="mb-5 text-gray-900 dark:text-gray-200">
                            Class: {{ $class->class_name }}
                        </p>
                        <div class="flex gap-4 justify-between">
                            <div class="flex items-center space-x-4">
                                <div
                                    class="ring-2 ring-gray-300 dark:ring-gray-500 relative w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                    <svg class="absolute w-10 h-10 text-gray-400 -left-1" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <span class="font-medium dark:text-gray=200">
                                    GV: {{ $class->members->where('role', 3)[1]->name ?? '' }}
                                </span>
                            </div>
                            <div onclick="enterClass({{ $class->id }})" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                Enter
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <script>
        function enterClass(id) {
            document.getElementById('classLink-' + id).click();
        }
    </script>
</x-app-layout>