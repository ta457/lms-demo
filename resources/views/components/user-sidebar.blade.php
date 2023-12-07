<aside id="default-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
  aria-label="Sidenav">
  <div class="overflow-y-auto h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <a href="{{ route('dashboard') }}" class="shrink-0 flex items-center bg-slate-100 dark:bg-gray-900 py-4 mb-5">
      <div>
        <x-application-logo class="ml-5 block h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
      </div>
      <p class="ml-2 text-2xl font-bold text-gray-600 dark:text-gray-200">LMS</p>
    </a>
    <div class="px-4">
      <ul class="space-y-2">
        <x-admin-sidebar-item 
          :active="Str::contains(request()->route()->uri, 'dashboard')"
          href="/dashboard"
          label="My Courses">
          <x-icon-course :active="Str::contains(request()->route()->uri, 'dashboard')" />
        </x-admin-sidebar-item>
      </ul>
    </div>
  </div>
</aside>