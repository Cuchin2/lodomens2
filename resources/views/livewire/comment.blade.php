<div>
    @if (auth()->check())
    <!-- Verificar si el usuario está autenticado -->
    {{-- estrellas --}}
    <div class=" mx-auto w-fit  my-auto  pb-4">
        <div class="flex items-center">
            <h2 class="mr-2">4.7</h2>
            <div class="ml-2">
            <livewire:star-show />
            <p class="text-gris-30 text-center"> Basado en 14 calificaciones</p>
            </div>
        </div>
        <div class="flex items-center">
            <p class="w-3">5</p> <x-icons.star class="h-6 w-6 fill-corp2-30"/>
            <div class="w-full ml-2 bg-gris-70 max-w-sm h-[10px] mx-auto rounded-lg overflow-hidden">
                <div class="bg-corp2-30 text-xs leading-none py-1" style="width: 40%"></div>
            </div>
            <p class="w-3 ml-2">14</p>
        </div>
        <div class="flex items-center">
            <p class="w-3">4</p> <x-icons.star class="h-6 w-6 fill-corp2-30"/>
            <div class="w-full ml-2 bg-gris-70 max-w-sm h-[10px] mx-auto rounded-lg overflow-hidden">
                <div class="bg-corp2-30 text-xs leading-none py-1" style="width: 40%"></div>
            </div>
            <p class="w-3 ml-2">7</p>
        </div>
        <div class="flex items-center">
            <p class="w-3">3</p> <x-icons.star class="h-6 w-6 fill-corp2-30"/>
            <div class="w-full ml-2 bg-gris-70 max-w-sm h-[10px] mx-auto rounded-lg overflow-hidden">
                <div class="bg-corp2-30 text-xs leading-none py-1" style="width: 40%"></div>
            </div>
            <p class="w-3 ml-2">3</p>
        </div>
        <div class="flex items-center">
            <p class="w-3">2</p> <x-icons.star class="h-6 w-6 fill-corp2-30"/>
            <div class="w-full ml-2 bg-gris-70 max-w-sm h-[10px] mx-auto rounded-lg overflow-hidden">
                <div class="bg-corp2-30 text-xs leading-none py-1" style="width: 40%"></div>
            </div>
            <p class="w-3 ml-2">1</p>
        </div>
        <div class="flex items-center">
            <p class="w-3">1</p> <x-icons.star class="h-6 w-6 fill-corp2-30"/>
            <div class="w-full ml-2 bg-gris-70 max-w-sm h-[10px] mx-auto rounded-lg overflow-hidden">
                <div class="bg-corp2-30 text-xs leading-none py-1" style="width: 40%"></div>
            </div>
            <p class="w-3 ml-2">0</p>
        </div>
    </div>
    {{-- comentarios --}}
    <li class="flex justify-center space-x-4">
        <div class="item__avatar w-[70px]"><img style="border-radius: 50%!important"
                src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" /></div>
        <div class="w-full" x-data="{ count: 0 }" x-init="count = $refs.countme.value.length">
            <div class="flex ml-1 space-x-2">
            <p class="font-bold">{{ auth()->user()->name }}</p>
            <p>{{ Carbon\Carbon::now()->isoformat('DD MMM YYYY, h:mm a') }}</p>
            </div>
            <x-rating />
            <textarea wire:model="comment" type="text"
                class="w-full border-gray-300 dark:border-gray-700 dark:bg-black dark:text-gris-30 focus:border-gris-50 dark:focus:border-gris-50 focus:ring-gris-50 dark:focus:ring-gris-50 rounded-lg shadow-sm text-[12px]"
                placeholder="Dejanos un comentario" rows="3" maxlength="225" x-ref="countme"
                x-on:keyup="count = $refs.countme.value.length">{{ $comment }}</textarea>

            <div class="d-inline-flex ml-2">
                <template x-if="count < 20">
                    <small id="helpId" class="text-corp-30 font-bold" x-html="count">
                        /</small>

                </template>
                <template x-if="count >= 20">
                    <small id="helpId" class="font-bold" x-html="count"></small>
                </template> <small id="helpId" class="form-text text-muted" style="margin: auto 5px;">/</small>
                <small id="helpId" class="form-text text-muted" x-html="$refs.countme.maxLength"></small>

            </div>
            <button wire:click="save" type="button" class=" mt-3 float-right bg-corp-50 rounded-[3px]"
                style="font-size:14px; width:90px; order: 1;">Comentar</button>
            <button type="button" class="btn  gris2  hv-turkey mt-3 float-right br-20"
                style="border-radius:8px;font-size:14px; width:90px; order: 2;">Cancelar</button>
        </div>
    </li>
    @else
    <!-- Contenido para usuarios no autenticados -->
    <p>Inicia sesión para acceder a contenido exclusivo, o<a href="{{--  {{ route('web.login_register') }}  --}}">
            registrate</a></p>
    @endif
    <h6 class="">{{ $total }} Comentarios</h6>

    <ul class="p-0 mb-4 mt-0 pt-[25px]">
        @foreach ($co as $com)
        <li class="w-full flex  px-0 space-x-5" x-data="{ abc: false }">
            <div class="flex-none w-[50px]"><img style="border-radius: 50%!important"
                    src="{{ asset('storage/'.$com->user->profile_photo_path) }}" alt="" /></div>
            <div class="w-full">
                <div class="flex">
                    <div class="font-bold">{{ $com->user->name }}</div>
                    <div class="item__date">- {{ Carbon\Carbon::parse($com->created_at)->isoformat('DD MMM YYYY, h:mm
                        a') }}
                    </div>
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
                            <div class="w-full" x-data="{ count: 0 }" x-init="count = $refs.countme.value.length">
                                <textarea wire:model="comment2" type="text"
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-black dark:text-gris-30 focus:border-gris-50 dark:focus:border-gris-50 focus:ring-gris-50 dark:focus:ring-gris-50 rounded-lg shadow-sm text-[12px]"
                                    placeholder="Dejanos un comentario" rows="3" maxlength="225" x-ref="countme"
                                    x-on:keyup="count = $refs.countme.value.length">{{ $comment }}</textarea>

                                <div class="d-inline-flex ml-2">
                                    <template x-if="count < 20">
                                        <small id="helpId" class="form-text text-muted text-corp-30" x-html="count">
                                            /</small>

                                    </template>
                                    <template x-if="count >= 20">
                                        <small id="helpId" class="form-text text-muted" x-html="count"></small>
                                    </template> <small id="helpId" class="form-text text-muted"
                                        style="margin: auto 5px;">/</small>
                                    <small id="helpId" class="form-text text-muted"
                                        x-html="$refs.countme.maxLength"></small>

                                </div>
                                <button wire:click="save2({{ $com->id }})" @click="abc = !abc" type="button"
                                    class="bg-corp-50 rounded-[3px] mt-3 float-right "
                                    style="border-radius:8px;font-size:14px; width:90px; order: 1;">Comentar</button>
                                <button @click="abc = !abc" type="button" wire:click="clean"
                                    class="btn  gris2  hv-turkey mt-3 float-right br-20"
                                    style="border-radius:8px;font-size:14px; width:90px; order: 2;">Cancelar</button>
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
