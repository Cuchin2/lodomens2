<div>
    <div class="flex mb-4 gap-2">
        @foreach ($socials as $social)
        <button type="button" wire:click="add('{{$social}}')" onclick="this.disabled = true;">
            <img class="h-8 mx-0.5 cursor-pointer filterit"
                src="{{asset('image/SVG_ecowaste//iconos/socialmedia/'.$social.'.svg')}}" alt="">
        </button>


        @endforeach
    </div>
    @if (!empty($newsocials))
    @foreach ($newsocials as $key => $social)
    <div class="flex items-center mb-[10px]" x-data x-init="$refs.answer.focus()">
        <img class="h-8 mx-1 filterit" src="{{asset('image/SVG_ecowaste/iconos/socialmedia/'.$social['name'].'.svg')}}"
            alt="">
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

