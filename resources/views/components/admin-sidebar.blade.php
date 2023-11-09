<aside id="default-sidebar" class="left-0 w-full transition-transform -translate-x-full sm:translate-x-0"
  aria-label="Sidenav">
  <div
    class="overflow-y-auto pt-20 px-3 h-full bg-gray-100 border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <ul class="space-y-2">

      <li>
        <a href="/admin-dashboard/users"
          class="{{ Request::is('admin-dashboard/users') ? 'bg-white shadow-md' : '' }} 
                hover:bg-white flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white dark:hover:bg-gray-700 group">
          <svg
            class="{{ Request::is('admin-dashboard/users') ? 'text-gray-900' : 'text-gray-400' }} w-5 h-5 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 14 18">
            <path
              d="M7 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9Zm2 1H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
          </svg>
          <span class="ml-3">Users</span>
        </a>
      </li>

      <li>
        <a href="/admin-dashboard/faculties"
          class="{{ Request::is('admin-dashboard/faculties') ? 'bg-white shadow-md' : '' }} 
                    flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group">
          <svg
            class="{{ Request::is('admin-dashboard/faculties') ? 'text-gray-900' : 'text-gray-400' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
            <path
              d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
          </svg>
          <span class="ml-3">Faculties</span>
        </a>
      </li>

      <li>
        <a href="/admin-dashboard/courses"
          class="{{ Request::is('admin-dashboard/courses') ? 'bg-white shadow-md' : '' }} 
                    flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-white dark:hover:bg-gray-700 group">
          <svg
            class="{{ Request::is('admin-dashboard/courses') ? 'text-gray-900' : 'text-gray-400' }} flex-shrink-0 w-5 h-5 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
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

      {{-- expandable item --}}
      {{-- <li>
        <button type="button"
          class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
          aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
            <path
              d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
          </svg>
          <span class="flex-1 ml-3 text-left whitespace-nowrap">Faculties</span>
          <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
              clip-rule="evenodd"></path>
          </svg>
        </button>
        <ul id="dropdown-pages" class="hidden py-2 space-y-2">
          <li>
            <a href="#"
              class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Settings</a>
          </li>
          <li>
            <a href="#"
              class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Kanban</a>
          </li>
          <li>
            <a href="#"
              class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Calendar</a>
          </li>
        </ul>
      </li> --}}
    </ul>
    <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
      <li>
        <a href="#"
          class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-white dark:hover:bg-gray-700 dark:text-white group">
          <svg aria-hidden="true"
            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
            <path fill-rule="evenodd"
              d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
              clip-rule="evenodd"></path>
          </svg>
          <span class="ml-3">Docs</span>
        </a>
      </li>
      {{-- <li>
        <a href="#"
          class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-white dark:hover:bg-gray-700 dark:text-white group">
          <svg aria-hidden="true"
            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
            </path>
          </svg>
          <span class="ml-3">Components</span>
        </a>
      </li> --}}
      <li>
        <a href="#"
          class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg transition duration-75 hover:bg-white dark:hover:bg-gray-700 dark:text-white group">
          <svg aria-hidden="true"
            class="flex-shrink-0 w-6 h-6 text-gray-400 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
              clip-rule="evenodd"></path>
          </svg>
          <span class="ml-3">Help</span>
        </a>
      </li>
    </ul>
  </div>
</aside>