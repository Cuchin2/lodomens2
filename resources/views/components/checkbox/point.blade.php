@props(['model'=>'','id'=>''])

<input {{ $attributes }} id="{{ $id }}" type="radio" class="hidden" />
<label for="{{ $id }}" class="flex items-center cursor-pointer">
<span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
{{ $slot }}
</label>