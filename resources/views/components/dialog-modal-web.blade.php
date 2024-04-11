@props(['id' => null, 'maxWidth' => null])

<x-modal-web :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-gray-900 dark:text-gris-10">
            {{ $title }}
        </div>

        <div class="mt-4 text-[15px] text-gray-600 dark:text-gray-400">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gris-90 text-end">
        {{ $footer }}
    </div>
</x-modal-web>
