<aside id="default-sidebar"
  class="shadow relative hidden md:block z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
  aria-label="Sidenav">
  <div class="overflow-y-auto h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    {{-- logo ===================================================== --}}
    <a href="{{ route('dashboard') }}" class="shrink-0 flex items-center bg-slate-100 dark:bg-gray-900 py-4 mb-5">
      <div>
        <x-application-logo class="ml-5 block h-8 w-auto fill-current text-gray-800 dark:text-gray-200" />
      </div>
      <p class="ml-2 text-2xl font-bold text-gray-600 dark:text-gray-200">LMS</p>
    </a>
    {{-- menu 1 ==================================================== --}}
    <div class="px-4">
      <ul class="space-y-2">

        {{-- item 1 ================ --}}
        <x-admin-sidebar-item 
          :active="Str::contains(request()->route()->uri, '/users')"
          href="/admin-dashboard/users"
          label="Users">
          <x-icon-user :active="Str::contains(request()->route()->uri, '/users')" />
        </x-admin-sidebar-item>

        {{-- item 2 ================ --}}
        <x-admin-sidebar-item 
          :active="Str::contains(request()->route()->uri, '/faculties')"
          href="/admin-dashboard/faculties"
          label="Faculties">
          <x-icon-faculty :active="Str::contains(request()->route()->uri, '/faculties')" />
        </x-admin-sidebar-item>

        {{-- item 3 ================ --}}
        <x-admin-sidebar-item 
          :active="Str::contains(request()->route()->uri, '/courses')"
          href="/admin-dashboard/courses"
          label="Courses">
          <x-icon-course :active="Str::contains(request()->route()->uri, '/courses')" />
        </x-admin-sidebar-item>

        {{-- item 4 ================ --}}
        <x-admin-sidebar-item 
          :active="Str::contains(request()->route()->uri, '/classes')"
          href="/admin-dashboard/classes"
          label="Classes">
          <x-icon-class :active="Str::contains(request()->route()->uri, '/classes')" />
        </x-admin-sidebar-item>
      </ul>
      {{-- menu 2 ==================================================== --}}
      <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
        <x-admin-sidebar-item 
          :active="Str::contains(request()->route()->uri, '/settings')"
          href="/admin-dashboard/settings"
          label="Settings">
          <x-icon-setting :active="Str::contains(request()->route()->uri, '/settings')" />
        </x-admin-sidebar-item>
        
        <li>
          <a href=""
            class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
            <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" 
              aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
              <path d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM5 12a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm0-3a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm10 6H9a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2Zm0-3H9a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Zm0-3H9a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/>
            </svg>
            <span class="ml-3">Logs</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</aside>