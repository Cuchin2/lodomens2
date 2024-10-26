@props(['id' => null, 'maxWidth' => null])

<x-modal-web :id="$id" :maxWidth="$maxWidth" {{ $attributes }} >
    <div class="px-6 py-4">
        <div class="text-lg font-medium  text-gris-10">
            {{ $title }}
        </div>

        <div class="mt-4 text-[15px]  text-gris-10">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-gris-90 text-end">
        {{ $footer }}
    </div>
</x-modal-web>
