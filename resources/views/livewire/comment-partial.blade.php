<ul class="p-0 mb-4 mt-0">
    <li class="w-full flex py-[25px] px-0 space-x-5">
        <div class="flex-none w-[50px]"><img style="border-radius: 50%!important"
                src="{{asset('storage/'.$reply->user->profile_photo_path)}}" alt="alt" /></div>
        <div class="w-full">
            <div>
                <div class="w-full flex">
                    <div class="font-bold">{{$reply->user->name}}</div>
                    <div class="item__date">- {{Carbon\Carbon::parse($reply->created_at)->isoformat('DD MMM YYYY, h:mm
                        a')}}</div>
                </div>
                <p class="mt-[revert] mb-[10px]">{{$reply->body}}</p>

                <div x-data="{ xyz:false }">
                    <div class="flex items-center space-x-3 no-select">
                        @if (auth()->check())
                        @php
                        $ver1 = App\Models\Like::where('user_id', auth()->user()->id)
                        ->where('likeable_type', 'App\Models\Comment')
                        ->where('likeable_id', $reply->id);
                        $ver = $ver1->exists(); $ver1=$ver1->pluck('id');
                        @endphp
                        @else
                        @php
                        $ver = false;
                        @endphp
                        @endif

                        @if($ver)
                        <div @if (auth()->check()) wire:click="removeLike({{ $ver1[0]}})" @endif class=" {{$ver?
                            'text-corp-30':
                            'likec'}}" >

                            @else
                            <div @if (auth()->check()) wire:click="addLike({{ $reply->id }})" @endif class=" {{$ver ?
                                'text-corp-30': 'likec'}}" >

                                @endif
                                <div class="flex space-x-3 cursor-pointer hover:text-corp-30">
                                    @if($ver)
                                    <x-icons.heart2 class="w-[18px]"/>
                                    @else
                                    <x-icons.heart class="w-[18px]"/>
                                    @endif
                                    <p class="my-0 p-0">{{$reply->likes()->count() === 0 ? '': $reply->likes()->count()
                                        }} {{$reply->likes()->count() <= 1 ? 'Me gusta' : 'Me gustas' }} </p>
                                </div>
                            </div>
                            <p class="my-0 ml-5 p-0 cursor-pointer hover:text-corp-30" @if(auth()->check()) @click="xyz
                                = !xyz"
                                @endif>Responder</p>
                        </div>
                        @if (auth()->check())
                        <ul class="py-4" x-show="xyz">
                            <li class="flex justify-center space-x-4">
                                <div class="flex-none w-[50px]"><img style="border-radius: 50%!important"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </div>
                                <div class="w-full" x-data="{ count: 0 }"
                                    x-init="count = $refs.countme.value.length">
                                    <textarea wire:model="comment2" type="text" class="w-full border-gray-300 dark:border-gray-700 dark:bg-black dark:text-gris-30 focus:border-gris-50 dark:focus:border-gris-50 focus:ring-gris-50 dark:focus:ring-gris-50 rounded-lg shadow-sm text-[12px]"
                                        placeholder="Dejanos un comentario" rows="3" maxlength="225" x-ref="countme"
                                        x-on:keyup="count = $refs.countme.value.length">{{ $comment }}</textarea>

                                    <div class="d-inline-flex ml-2">
                                        <template x-if="count < 20">
                                            <small id="helpId" class="form-text text-corp-30"
                                                x-html="count"> /</small>

                                        </template>
                                        <template x-if="count >= 20">
                                            <small id="helpId" class="form-text text-muted" x-html="count"></small>
                                        </template> <small id="helpId" class="form-text text-muted"
                                            style="margin: auto 5px;">/</small>
                                        <small id="helpId" class="form-text text-muted"
                                            x-html="$refs.countme.maxLength"></small>

                                    </div>

                                    <button wire:click="save2({{ $reply->id }})" @click="xyz = !xyz" type="button"
                                        class="bg-corp-50 rounded-[3px] float-right br-20"
                                        style="border-radius:8px;font-size:14px; width:90px; order: 1;">Comentar</button>
                                    <button @click="xyz = !xyz" type="button" wire:click="clean"
                                        class="btn  gris2  hv-turkey mt-3 float-right br-20"
                                        style="border-radius:8px;font-size:14px; width:90px; order: 2;">Cancelar</button>

                                </div>
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
                @if ($reply->replies->count() > 0)
                @foreach ($reply->replies->reverse() as $reply)

                @include('livewire.comment-partial', ['replies' => $reply->replies])

                @endforeach
                @endif




            </div>
    </li>
</ul>
