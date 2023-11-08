<x-app-layout>
    @if ($user->role != 1)
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My courses') }}
        </h2>
    </x-slot>
    @endif

    <div class="{{ $user->role == 1 ? 'grid lg:grid-cols-6 h-screen' : 'py-12' }}">
        <div class="{{ $user->role == 1 ? 'hidden' : '' }} max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                {{-- <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div> --}}
                {{-- @foreach ($classes as $class)
                <li>{{ $class->class_name }} of {{ $class->course->course_name }}</li>
                @endforeach --}}
                <h2 class="mt-8 ml-8 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    Học kỳ 1 (2023-2024)
                </h2>

                <section class="bg-white dark:bg-gray-900">
                    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                        <div class="grid gap-8 lg:grid-cols-3">
                            @foreach ($classes as $class)
                            <article
                                class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex justify-between items-center mb-5 text-gray-500">
                                    <span
                                        class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                        <svg class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                            </path>
                                        </svg>
                                        Tutorial
                                    </span>
                                    <span class="text-sm">14 days ago</span>
                                </div>
                                <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                                        href="#">{{ $class->course->course_name }}</a></h2>
                                <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                                    Class: {{ $class->class_name }}
                                </p>
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-4">
                                        <div
                                            class="relative w-8 h-8 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                            <svg class="absolute w-10 h-10 text-gray-400 -left-1" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <span class="font-medium dark:text-white">
                                            {{ $class->members->where('role', 3)[1]->name }}
                                        </span>
                                    </div>
                                    <a href="#"
                                        class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                        More
                                        <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </article>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar"
                    aria-controls="default-sidebar" type="button"
                    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button> --}}
            </div>
        </div>
    </div>
</x-app-layout>