<ul class="p-0 mb-4 mt-0">
    <li class="w-full flex py-[25px] px-0 space-x-5">
        <div class="flex-none w-[50px]"><img style="border-radius: 50%!important"
                src="{{asset('storage/'.$reply->user->profile_photo_path)}}" alt="alt" /></div>
        <div class="w-full">
            <div>
                <div class="w-full flex space-x-2">
                    <div class="font-bold">{{$reply->user->name}}</div>
                    <div class="item__date">- {{Carbon\Carbon::parse($reply->created_at)->isoformat('DD MMM YYYY, h:mm
                        a')}}</div>
                        @if($reply->user->user_type_id < 3)
                        <div>
                            <img src="{{ asset('storage/crown/'.$reply->user->userType->file) }}" alt="">
                        </div>
                        @endif
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
                                <div class="w-full" >
                                    <x-text-area comment="comment2" save="save2({{ $reply->id }})" click="xyz = !xyz"/>
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
