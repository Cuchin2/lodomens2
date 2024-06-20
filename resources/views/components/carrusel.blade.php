@props(['sliders','time'=>'8000'])
      <div
        x-data="{ activeSlide: 1, slideCount: {{ $sliders->count() }} , time:'{{ $time }}'}"
        class="overflow-hidden relative"
      >
        <!-- Slider -->
        <!-- You can remove x-init if you dont want to autoplay -->
          <div
            class="whitespace-nowrap transition-transform duration-700 ease-in-out"
            :style="'transform: translateX(-' + (activeSlide - 1) * 100.5 + '%)'"
            x-init="setInterval(() => { activeSlide = activeSlide < slideCount ? activeSlide + 1 : 1 }, time )"
          >
{{--              <!-- Item 1 -->
            <div class="inline-block w-full relative ">
              <img width="100%" height="50%" src="{{ asset('image/lodomens/Banner_Carrusel_1.png') }}" alt="" />
              <div class="absolute inset-0 flex items-center justify-center text-white">
                <div class="bg-black/50 p-4 rounded">
                  <div class="flex items-center space-x-2">
                    <h1 class="uppercase">El vampiro de Lima</h1>
                    <a @click="alert('Hola')" class="cursor-pointer underline hover:text-red-600">hola bb</a>
                  </div>
                </div>
              </div>
            </div>  --}}
            @foreach ($sliders as $slider )
            <div class="inline-block w-full">
                <a href="{{ $slider->href }}">
                <img width="100%" class="max-h-[547px]"
                  src="{{ asset('storage/'.$slider->url) }}"
                  alt="{{ $slider->name }}"
                /></a>
              </div>
            @endforeach
{{--              <!-- Item 3 -->
            <div class="inline-block w-full">
                <img width="100%" height="50%"
                  src="{{ asset('image/lodomens/Banner_Carrusel_1.png') }}"
                  alt=""
                />
             </div>  --}}
          </div>

        <!-- Prev/Next Arrows -->
        <div class="absolute inset-y-1/2  flex items-center justify-between px-4 w-full">
          <button
            @click="activeSlide = activeSlide > 1 ? activeSlide - 1 : slideCount"
            class=" flex items-center bg-gris-70/30 hover:text-gris-10 hover:border-gris-10 active:border-gris-5 active:text-gris-5 text-gris-30 p-2 rounded-[3px] border-[2px] border-gris-30"
          >
            <x-icons.chevron-left grosor="2" class=" w-[12px] h-[12px]"/>
          </button>
          <button
            @click="activeSlide = activeSlide < slideCount ? activeSlide + 1 : 1"
            class=" flex items-center bg-gris-70/30 hover:text-gris-10 hover:border-gris-10 active:border-gris-5 active:text-gris-5 text-gris-30 p-2 rounded-[3px] border-[2px] border-gris-30"
          >
            <x-icons.chevron-right  grosor="2" class=" w-[12px] h-[12px]"/>
          </button>
        </div>

        <!-- Dots Navigation -->
        <div
          class="absolute bottom-0 left-0 right-0 flex justify-center space-x-2 p-4"
        >
          <template x-for="slideIndex in slideCount" :key="slideIndex">
            <button
              @click="activeSlide = slideIndex"
              class="h-2 w-2 rounded-full"
              :class="{'bg-corp-30': activeSlide === slideIndex, 'bg-gris-10': activeSlide !== slideIndex}"
            ></button>
          </template>
        </div>
      </div>
