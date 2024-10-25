@props(['step'=>1])

@if ($step == 5)

        @else
        <div class="mx-auto my-8 w-11/12">
            <div class="bg-gray-200 bg-gray-700 h-1 flex items-center justify-between relative">
                <div class="w-1/2 {{ $step >1 ? 'bg-indigo-700 h-1' : '' }} flex items-center">
                    <div class="bg-indigo-700 h-6 w-6 rounded-full shadow flex items-center justify-center">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/thin_with_steps-svg1.svg" alt="check"/>
                    </div>
                </div>
                @if ($step == 1)
                <div class="absolute  bg-gray-800 shadow-lg px-2 py-1 rounded mt-16 left-[-32px]">
                    <p tabindex="0" class="focus:outline-none  text-indigo-400 text-xs font-bold">1: Pagado</p>
                </div>
                @endif
                <div class="w-1/2 flex justify-between {{ $step == 3 || $step == 4 ? 'bg-indigo-700 h-1 ' :''  }} items-center relative">
                    @if ($step == 3)
                    <div class="absolute right-0 -mr-2">
                        <div class="relative  bg-gray-800 shadow-lg px-2 py-1 rounded mt-16 -mr-12">
                            <p tabindex="0" class="focus:outline-none  text-indigo-400 text-xs font-bold">3: En camino</p>
                        </div>
                    </div>
                    <div class="bg-indigo-700 h-6 w-6 rounded-full shadow flex items-center justify-center -ml-2">
                        <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/thin_with_steps-svg1.svg" alt="check"/>
                    </div>
                    <div class=" bg-gray-700 h-6 w-6 rounded-full shadow flex items-center justify-center -mr-3 relative">
                        <div class="h-3 w-3 bg-indigo-700 rounded-full"></div>
                    </div>

                    @else
                        @if($step == 4)
                        <div class="bg-indigo-700 h-6 w-6 rounded-full shadow flex items-center justify-center -ml-2">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/thin_with_steps-svg1.svg" alt="check"/>
                        </div>
                        <div class="bg-indigo-700 h-6 w-6 rounded-full shadow flex items-center justify-center -ml-2">
                            <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/thin_with_steps-svg1.svg" alt="check"/>
                        </div> @elseif ( $step == 2)
                        <div class="absolute  bg-gray-800 shadow-lg px-2 py-1 rounded mt-16 left-[-48px]">
                            <p tabindex="0" class="focus:outline-none  text-indigo-400 text-xs font-bold">2: En proceso</p>
                        </div>
                        <div class=" bg-gray-700 h-6 w-6 rounded-full shadow flex items-center justify-center">
                            <div class="h-3 w-3 bg-indigo-700 rounded-full"></div>
                        </div>
                        <div class=" bg-gray-700 h-6 w-6 rounded-full shadow"></div>
                        @else
                        <div class=" bg-gray-700 h-6 w-6 rounded-full shadow"></div>
                        <div class=" bg-gray-700 h-6 w-6 rounded-full shadow"></div>
                        @endif

                    @endif

                </div>
                <div class="w-1/2 flex justify-end {{ $step == 4 ? 'bg-indigo-700 h-1 items-center relative' : ''}}">
                    @if ($step == 4)
                    <div class=" bg-gray-700 h-6 w-6 rounded-full shadow flex items-center justify-center -mr-3 relative">
                        <div class="h-3 w-3 bg-indigo-700 rounded-full"></div>
                    </div>
                    <div class="absolute  bg-gray-800 shadow-lg px-2 py-1 rounded mt-[68px] mr-[-15px]">
                        <p tabindex="0" class="focus:outline-none  text-indigo-400 text-xs font-bold">4: Entregado</p>
                    </div>
                    @else
                    <div class=" bg-gray-700 h-6 w-6 rounded-full shadow"></div>
                    @endif

                </div>
            </div>
        </div>
        @endif
