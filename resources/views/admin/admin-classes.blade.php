<x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-admin-sidebar>
      <li>
        <a href="/admin-dashboard/users"
          class="
              hover:bg-white flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
          <svg
            class="w-5 h-5 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
            <path
              d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
          </svg>
          <span class="ml-3">Users</span>
        </a>
      </li>

      <li>
        <a href="/admin-dashboard/faculties"
          class="
                  flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
            <path
              d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
          </svg>
          <span class="ml-3">Faculties</span>
        </a>
      </li>

      <li>
        <a href="/admin-dashboard/courses"
          class="{{ url()->current() == route('adminCourses') ? 'bg-white' : '' }} 
                  flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
            <path
              d="M16 14V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 0 0 0-2h-1v-2a2 2 0 0 0 2-2ZM4 2h2v12H4V2Zm8 16H3a1 1 0 0 1 0-2h9v2Z" />
          </svg>
          <span class="ml-3">Courses</span>
        </a>
      </li>

      <li>
        <a href="/admin-dashboard/classes"
          class="{{ Request::is('admin-dashboard/classes') ? 'bg-white shadow-md' : '' }}
                  flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group">
          <svg
            class="{{ Request::is('admin-dashboard/classes') ? 'text-gray-900' : 'text-gray-400' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
            <path
              d="M9 1.334C7.06.594 1.646-.84.293.653a1.158 1.158 0 0 0-.293.77v13.973c0 .193.046.383.134.55.088.167.214.306.366.403a.932.932 0 0 0 .5.147c.176 0 .348-.05.5-.147 1.059-.32 6.265.851 7.5 1.65V1.334ZM19.707.653C18.353-.84 12.94.593 11 1.333V18c1.234-.799 6.436-1.968 7.5-1.65a.931.931 0 0 0 .5.147.931.931 0 0 0 .5-.148c.152-.096.279-.235.366-.403.088-.167.134-.357.134-.55V1.423a1.158 1.158 0 0 0-.293-.77Z" />
          </svg>
          <span class="ml-3">Classes</span>
        </a>
      </li>
    </x-admin-sidebar>

    <x-admin-table :props="$props" />
  </div>
</x-app-layout>