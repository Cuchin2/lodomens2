<x-app-layout>
    <x-slot name="slot1">
        <x-breadcrumb.breadcrumb />
    </x-slot>


    <x-slot name="slot2">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
        <x-welcome />
        </div>
    </x-slot>
</x-app-layout>
