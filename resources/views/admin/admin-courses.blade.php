<x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-admin-sidebar />

    <x-admin-table :props="$props">Courses</x-admin-table>

    <!-- Main modal -->
    <x-modal-addCourse :props="$props" />
  </div>
</x-app-layout>