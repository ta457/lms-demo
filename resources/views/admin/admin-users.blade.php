<x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-admin-sidebar />

    <x-admin-table :props="$props" />

    <!-- Main modal -->
    <x-modal-addUser :props="$props"/>
  </div>
</x-app-layout>