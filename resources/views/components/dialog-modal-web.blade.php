@props(['id' => null, 'maxWidth' => null])

<x-modal-web :id="$id" :maxWidth="$maxWidth" {{ $attributes }} >
    <div class="px-6 py-4">
        <div class="text-lg font-medium  dark:text-gris-10">
            {{ $title }}
        </div>

        <div class="mt-4 text-[15px]  dark:text-gris-10">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 dark:bg-gris-90 text-end">
        {{ $footer }}
    </div>
</x-modal-web>
