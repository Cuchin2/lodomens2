@props(['step'=>1,'pay_date'=>''])

@if ($step == 5)

        @else
        <div class="mx-auto my-8 w-full scale-75">
            <div class=" bg-gris-70 h-1 flex items-center justify-between relative">
                <div class="w-1/2 {{ $step >1 ? 'bg-gris-10 h-1' : '' }} flex items-center">
                    <div class="bg-gris-10 h-5 w-5 rounded-full shadow flex items-center justify-center">
                        {{--  <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/thin_with_steps-svg1.svg" alt="check"/>  --}}
                    </div>
                </div>
                {{--  @if ($step == 1)  --}}
                <div class="absolute  bg-transparent shadow-lg px-2 py-1 rounded mt-16 left-[-32px]">
                    <p tabindex="0" class="focus:outline-none text-gris-10  text-xs font-bold">Pagado</p>
                </div>
                {{--  @endif  --}}
                <div class="w-1/2 flex justify-between {{ $step == 3 || $step == 4 ? 'bg-gris-10 h-1 ' :''  }} items-center relative">
                    <div class="absolute right-0 -mr-2">
                        <div class="relative  bg-transparent shadow-lg px-2 py-1 rounded mt-16 -mr-12">
                            <p tabindex="0" class="focus:outline-none text-gris-10  text-xs font-bold">En camino</p>
                        </div>
                    </div>
                    <div class="absolute  bg-transparent shadow-lg px-2 py-1 rounded mt-16 left-[-48px]">
                        <p tabindex="0" class="focus:outline-none text-gris-10  text-xs font-bold">En proceso</p>
                    </div>

                    @if ($step == 3)
                    {{--  <div class="absolute right-0 -mr-2">
                        <div class="relative  bg-transparent shadow-lg px-2 py-1 rounded mt-16 -mr-12">
                            <p tabindex="0" class="focus:outline-none text-gris-10 text-gris-30text-xs font-bold">3: En camino</p>
                        </div>
                    </div>  --}}
                    <div class="bg-gris-10 h-5 w-5 rounded-full shadow flex items-center justify-center -ml-2">
                        {{--  <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/thin_with_steps-svg1.svg" alt="check"/>  --}}
                    </div>
                    <div class=" bg-gris-70 h-5 w-5 rounded-full shadow flex items-center justify-center -mr-3 relative">
                        <div class="h-5 w-5 bg-gris-10 rounded-full"></div>
                    </div>

                    @else
                        @if($step == 4)
                        <div class="bg-gris-10 h-5 w-5 rounded-full shadow flex items-center justify-center -ml-2">
                           {{--   <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/thin_with_steps-svg1.svg" alt="check"/>  --}}
                        </div>
                        <div class="bg-gris-10 h-5 w-5 rounded-full shadow flex items-center justify-center -ml-2">
                           {{--   <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/thin_with_steps-svg1.svg" alt="check"/>  --}}
                        </div>
                        @elseif ( $step == 2)
                        {{--  <div class="absolute  bg-transparent shadow-lg px-2 py-1 rounded mt-16 left-[-48px]">
                            <p tabindex="0" class="focus:outline-none text-gris-10 text-gris-30text-xs font-bold">2: En proceso</p>
                        </div>  --}}
                        <div class=" bg-gris-70 h-5 w-5 rounded-full shadow flex items-center justify-center">
                            <div class="h-5 w-5 bg-gris-10 rounded-full"></div>
                        </div>
                        <div class=" bg-gris-70 h-5 w-5 rounded-full shadow"></div>
                        @else
                        <div class=" bg-gris-70 h-5 w-5 rounded-full shadow"></div>
                        <div class=" bg-gris-70 h-5 w-5 rounded-full shadow"></div>
                        @endif

                    @endif

                </div>

                <div class="w-1/2 flex justify-end relative {{ $step == 4 ? 'bg-gris-10 h-1 items-center ' : ''}}">
                    @if($step < 4)
                    <div class="absolute  bg-transparent shadow-lg px-2 py-1 rounded mt-[28px] right-[-48px]">
                        <p tabindex="0" class="focus:outline-none text-gris-10 text-gris-30text-xs font-bold whitespace-nowrap">Entregado</p>
                    </div>
                    @endif
                    @if ($step == 4)
                    <div class=" bg-gris-10 h-5 w-5 rounded-full shadow flex items-center justify-center -mr-3 relative">
                        {{--  <div class="h-5 w-5 bg-gris-10 rounded-full"></div>  --}}
                    </div>
                    <div class="absolute  bg-transparent shadow-lg px-2 py-1 rounded mt-[68px] mr-[-15px]">
                        <p tabindex="0" class="focus:outline-none text-gris-10 text-gris-30text-xs font-bold">Entregado</p>
                    </div>
                    @else
                    <div class=" bg-gris-70 h-5 w-5 rounded-full shadow"></div>
                    @endif

                </div>
            </div>
        </div>
        @endif
