<x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-admin-sidebar />

    <x-admin-table :props="$props">Classes</x-admin-table>

    <!-- Main modal -->
    <x-modal-addClass :props="$props"/>
  </div>
</x-app-layout>