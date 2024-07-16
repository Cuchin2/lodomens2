<div class="w-fit border border-gris-30 px-1 flex items-center space-x-2 rounded-[3px]">
    <p class="text-[10px]">{{ $slot }}</p>
    <div class="hover:text-white cursor-pointer" {{ $attributes }}>
    <x-icons.cross class="h-2 w-2 mt-[2px]" />
    </div>
</div>
