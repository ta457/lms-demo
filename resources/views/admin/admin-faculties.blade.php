<x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-admin-sidebar />

    <x-admin-table :props="$props">Faculties</x-admin-table>

    <!-- Main modal -->
    <x-modal-addFaculty />
  </div>
</x-app-layout>