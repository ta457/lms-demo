<x-app-layout>
  <form action="/admin-dashboard/classes/{{ $props['class']->id }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="grid lg:grid-cols-6 h-screen">
      <x-modal-editClass :props="$props"/>
    </div>
  </form>
</x-app-layout>
