<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container mx-auto p-6">
        <div class="space-y-6">
            @livewire('admin.user-management')
            @livewire('admin.task-management')
            @livewire('admin.send-notification')
        </div>
    </div>
    <script>
        window.userId = "{{ auth()->id() }}";
    </script>
</x-app-layout>
