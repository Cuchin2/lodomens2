<div>
    @if (auth()->check())
    <!-- Verificar si el usuario está autenticado -->

    {{-- comentarios --}}
    <li class="flex justify-center space-x-4">
        <div class="item__avatar w-[70px]"><img style="border-radius: 50%!important"
                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" /></div>
        <div class="w-full">
            <div class="flex ml-1 space-x-2">
            <p class="font-bold">{{ auth()->user()->name }}</p>
            <p>{{ Carbon\Carbon::now()->isoformat('DD MMM YYYY, h:mm a') }}</p>
            </div>
            {{--  <x-rating />  --}}
            <x-text-area comment="comment" save='save'/>
        </div>
    </li>
    @else
    <!-- Contenido para usuarios no autenticados -->
    <p>Inicia sesión para acceder a contenido exclusivo, o<a href="{{--  {{ route('web.login_register') }}  --}}">
            registrate</a></p>
    @endif
    <h6 class="">{{ $total }} {{ $total === 1 ? 'Comentario' : 'Comentarios' }}</h6>

    <ul class="p-0 mb-4 mt-0 pt-[25px]">
        @foreach ($co as $com)
        <li class="w-full flex mb-2 px-0 space-x-5" x-data="{ abc: false }">
            <div class="flex-none w-[50px]"><img style="border-radius: 50%!important"
                    src="{{ asset('storage/'.$com->user->profile_photo_path) }}" alt="" /></div>
            <div class="w-full">
                <div class="flex space-x-2">
                    <div class="font-bold">{{ $com->user->name }}</div>
                    <div class="item__date">- {{ Carbon\Carbon::parse($com->created_at)->isoformat('DD MMM YYYY, h:mm
                        a') }}
                    </div>
                    @if($com->user->user_type_id < 3)
                    <div>
                        <img src="{{ asset('storage/crown/'.$com->user->userType->file) }}" alt="">
                    </div>
                    @endif
                </div>
                <p class="mt-[revert] mb-[10px]"> {{ $com->body }}</p>
                <div class="flex items-center space-x-3 no-select">
                    @if (auth()->check())
                    @php
                    $ver1 = App\Models\Like::where('user_id', auth()->user()->id)
                    ->where('likeable_type', 'App\Models\Comment')
                    ->where('likeable_id', $com->id);
                    $ver = $ver1->exists();
                    $ver1 = $ver1->pluck('id');
                    @endphp
                    @else
                    @php
                    $ver = false;
                    @endphp
                    @endif

                    @if ($ver)
                    <div @if (auth()->check()) wire:click="removeLike({{ $ver1[0] }})" @endif
                        class=" {{ $ver ? 'text-corp-30' : 'likec' }}">
                        @else
                        <div @if (auth()->check()) wire:click="addLike({{ $com->id }})" @endif
                            class=" {{ $ver ? 'text-corp-30' : 'likec' }}">
                            @endif
                            <div class="flex space-x-3 cursor-pointer hover:text-corp-30">
                                @if($ver)
                                <x-icons.heart2 class="w-[18px]" />
                                @else
                                <x-icons.heart class="w-[18px]" />
                                @endif

                                <p class="my-0 p-0 ">{{ $com->likes()->count() === 0 ? '' : $com->likes()->count() }}
                                    {{ $com->likes()->count() <= 1 ? 'Me gusta' : 'Me gustas' }} </p>
                            </div>
                        </div>


                        <p class="my-0 ml-5 p-0 cursor-pointer hover:text-corp-30" @if (auth()->check()) @click="abc =
                            !abc" @endif>Responder</p>
                    </div>
                    @if (auth()->check())
                    <ul class="py-4" x-show="abc">
                        <li class="flex justify-center space-x-4">
                            <div class="flex-none w-[50px]"><img style="border-radius: 50%!important"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </div>
                            <div class="w-full">
                                <x-text-area comment="comment2" save="save2({{ $com->id }})" cancel="clean" click="abc = !abc"/>
                            </div>
                        </li>
                    </ul>
                    @endif
                    @if ($com->replies->count() > 0)
                    @foreach ($com->replies->reverse() as $reply)
                        @include('livewire.comment-partial', ['replies' => $com->replies])
                    @endforeach
                    @endif

                </div>
        </li>
        @endforeach

    </ul>

</div>
