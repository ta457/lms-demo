<x-app-layout>

  <div class="grid lg:grid-cols-6 h-screen">

    <x-modal-editUser :props="$props"/>
    <x-delete-modal :props="$props" />

  </div>
</x-app-layout>
