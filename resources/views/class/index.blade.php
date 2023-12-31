@props([
'class' => $props['class']
])

<x-app-layout>
  {{-- header===================================================== --}}
  <x-slot name="header">
    <div class="flex items-center">
      <x-goback-btn href="/dashboard" />
      <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
          {{ __($class->course_name . " (Class: " . $class->class_name . ")") }}
      </h2>
    </div>
  </x-slot>

  {{-- sections=================================================== --}}
  <div class="py-12">
    <div class="max-w-7xl mx-auto  ">

      {{-- loop to render all sections in the class --}}
      @foreach ($class->sections($class->id) as $section)
      <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="mb-6 flex justify-between items-center">
          <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
            {{ $section->section_title }}
          </h3>
        </div>

        <div class="flex flex-col gap-2">
          @foreach ($section->subsections as $subsection)
          <div class="flex gap-4 items-center">

            @if ($subsection->type == 1)
            <x-subsection-text 
              :title="$subsection->title" 
              :content="$subsection->text_content"
              :id="$subsection->id" />
            @endif

            @if ($subsection->type == 2)
            <x-subsection-file 
              :href="$subsection->file" 
              :title="$subsection->title"
              :id="$subsection->id" />
            @endif

            @if ($subsection->type == 3)
            <x-subsection-link 
              :href="$subsection->url" 
              :title="$subsection->title" 
              :id="$subsection->id"/>
            @endif

            @if ($subsection->type == 4)
            <x-subsection-assignment 
              :title="$subsection->title"
              :deadline="$subsection->deadline"
              :instruction="$subsection->instruction"
              :id="$subsection->id" />
            @endif
          </div>
          @endforeach
        </div>
      </div>
      @endforeach
    </div>
  </div>
</x-app-layout>