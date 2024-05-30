<div>
    <div class="flex mb-4 gap-2">
        @foreach ($socials as $social)
        <button type="button" wire:click="add('{{$social}}')" onclick="this.disabled = true;">
            <x-dynamic-component :component="'icons.socialmedia.'.$social" class="mt-4 w-7 h-7 fill-corp-50 hover:fill-corp-70" />
        </button>

        @endforeach
    </div>
    @if (!empty($newsocials))
    @foreach ($newsocials as $key => $social)
    <div class="flex items-center mb-[10px]" x-data x-init="$refs.answer.focus()">
        <x-dynamic-component :component="'icons.socialmedia.'.$social['name']" class="w-7 h-7 mr-2 fill-corp-50 hover:fill-corp-70" />
        <x-input type="text" x-ref="answer" name="redes[{{$key}}]['url']" value="{{$social['url']}}" id="{{$social['name']}}"
            placeholder="Red social {{$social['name']}}" class="w-full"> </x-input>
        <input type="text" name="redes[{{$key}}]['name']" value="{{$social['name']}}" hidden>
        <button type="button" wire:click="delete('{{$social['name']}}')" onclick="this.disabled = true;">
            <x-icons.trash class="w-5 h-5"></x-icons.trash>
        </button>
    </div>
    @endforeach

    @endif

</div>

