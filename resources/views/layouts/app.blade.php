<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Learn2Code') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
  </script>

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased flex h-screen bg-gray-200 dark:bg-gray-900"
  style="{{ Str::contains(request()->route()->uri,'admin-dashboard') ? 'overflow:hidden;' : ''}}">

  <div 
    @if (!Str::contains(request()->route()->uri,'profile'))
      class="w-full h-screen md:grid" style="grid-template-columns: 16rem 1fr;"
    @else
      class="w-full h-screen flex justify-items-center"
    @endif>
    
    @if (!Str::contains(request()->route()->uri,'profile'))
      <div class="w-64">
        <x-user-sidebar />
      </div>
    @endif

    <div class="h-full flex-1 flex flex-col overflow-hidden">
      {{-- Top navbar --}}
      @include('layouts.navigation')

      <!-- Page Heading -->
      @if (isset($header))
      <div id="site-header" class="z-10 w-full bg-white dark:bg-gray-800 shadow">
        <header class="w-full lg:w-5/6 px-2 ">
          <div class="mx-auto py-6 px-4 sm:px-6 lg:px-8">
            {{ $header }}
          </div>
        </header>
      </div>
      @endif

      <!-- Page Content -->
      <main id="site-main" class="pt-4 pb-4 sm:pt-6 flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900">
        <div 
          @if (!Str::contains(request()->route()->uri,'profile'))
            class="w-full grid grid-cols-4 mt-20 pt-2 px-4 sm:px-4 sm:pt-4"
          @else
            class="pt-12"
          @endif>
          <div class="col-span-4 xl:col-span-3">
          {{ $slot }}
          </div>
        </div>
        
        {{-- paginate --}}
        @if (isset($data))
          <div id="admin-paginate" class="w-full lg:w-5/6 mt-4 px-4 dark:text-white">
            {{ $data->links() }}
          </div>
        @endif
      </main>
    </div>
  </div>
</body>

<script>
  // handle toggle sidebar ===============================================================
//   const toggleSidebarBtn = document.getElementById('toggle-sidebar-btn');
//   const sidebar = document.getElementById('default-sidebar');
//   toggleSidebarBtn.addEventListener('click', function() {
//     sidebar.classList.toggle('hidden');
//   });
//   document.addEventListener('click', function(event) {
//     const isClickInside = sidebar.contains(event.target) || toggleSidebarBtn.contains(event.target);
//     if (!isClickInside && !sidebar.classList.contains('hidden')) {
//       sidebar.classList.add('hidden');
//     }
//   });

  // handle delete modal ==============================================================
  function changeDeleteFormAction(url, id) {
    var form = document.getElementById('deleteRecordForm');
    var deleteMessage = document.getElementById('deleteMessage'); 
    form.action = url + id;
    deleteMessage.textContent ='ID = ' + id;
  }

  // handle delete all btn ===========================================================
  function clickDeleteAllBtn() {
    realBtn = document.getElementById('realDeleteAllBtn');
    realBtn.click();
  }

  // handle hide header on scroll =====================================================
  let prevScrollPos = document.getElementById("site-main").scrollTop;
  const header = document.getElementById("site-header");
  const scrollableDiv = document.getElementById("site-main");

  scrollableDiv.onscroll = function() {
    const currentScrollPos = scrollableDiv.scrollTop;

    if (prevScrollPos > currentScrollPos) {
        header.style.top = "65px"; /* Adjust this value based on the height of your navbar */
    } else {
        header.style.top = `-${header.offsetHeight}px`;
    }

    prevScrollPos = currentScrollPos;
  };

  // handle backward/forward btn
  function clickBackwardBtn(id) {
    realBtn = document.getElementById('backward-btn-' + id);
    realBtn.click();
  }
  function clickForwardBtn(id) {
    realBtn = document.getElementById('forward-btn-' + id);
    realBtn.click();
  }

  // handle add new subsec btns in class/edit.blade ===================================
  function openSubsecBtns(id) {
    const subsecBtnGroup = document.getElementById('subsec-btn-' + id);
    subsecBtnGroup.classList.toggle('hidden');
  }

  function openAddSubsectionModal(id, sectionId, type) {
    let btn; let form;
    if(type == 'text') {
      btn = document.getElementById('defaultModalButton1');
      form = document.getElementById('subsec-form1');
    }
    if(type == 'file') {
      btn = document.getElementById('defaultModalButton2');
      form = document.getElementById('subsec-form2');
    }
    if(type == 'link') {
      btn = document.getElementById('defaultModalButton3');
      form = document.getElementById('subsec-form3');
    }
    if(type == 'assignment') {
      btn = document.getElementById('defaultModalButton4');
      form = document.getElementById('subsec-form4');
    }
    const div = form.childNodes[3];
    const sectionIdInp = div.childNodes[1];
    sectionIdInp.setAttribute('value', sectionId);
    form.action = id;
    btn.click();
  }

  // handle add section form toggle in class/edit.blade =================================
  const addSectionBtn = document.getElementById('add-section-btn');
  const closeAddSectionBtn = document.getElementById('close-add-section-btn');
  const addSectionForm = document.getElementById('add-section-form');
  addSectionBtn.addEventListener('click', function () {
    addSectionForm.classList.remove('hidden');
    addSectionBtn.classList.add('hidden');
  });
  closeAddSectionBtn.addEventListener('click', function () {
    addSectionForm.classList.add('hidden');
    addSectionBtn.classList.remove('hidden');
  })
</script>

</html>