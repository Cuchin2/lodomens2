@props(['url'=>'','stock'=>'','name'=>'','text'=>'text-[14px]','color'=>'','img'=>'','param'=>'top-3 left-3'])

<lodo {{ $attributes->merge(['class' => ' relative items-center  flex max-w-[200px] max-h-[200px] mx-auto overflow-hidden']) }}
    x-data="{ showBtn: false,
      imageUrl: '{{ asset('storage/'.($url ?? '')) }}',
        isVideo: false,
        checkextension() {
        const extension = this.imageUrl.split('.').pop().toLowerCase();
        const videoExtensions = ['mp4', 'webm', 'mov','avi'];
        this.isVideo = videoExtensions.includes(extension);
                                           },
    }" x-init="checkextension()"
    class="relative overflow-hidden"
    @mouseenter="showBtn = true"
    @mouseleave="showBtn = false"
    >
    {{ $slot }}
<img class="absolute {{$param}} z-10" src="{{ asset('storage').'/'.$img }}" alt="">
<template x-if="isVideo">
    <video src="{{ asset('storage/'.($url ?? '')) }}" class="rounded-[3px]" controls>
</template>
<template x-if="!isVideo">
    <img src="{{ asset('storage/'.($url ?? '')) }}" class="rounded-[3px] transition duration-500 mx-auto w-full h-full" :class="showBtn ? 'scale-125' : ''"
    alt="{{ $name }}" >
</template>

    <div
    class=" absolute top-0 left-0 w-[100%] h-full flex items-center justify-center  {{ $stock > 0 ? 'border-[2px]  rounded-[3px]':'bg-black/80 border-[2px] rounded-[3px]' }}   " style="border-color: {{ $color }}"> @if ($stock < 1)
        <span class="text-gris-20 {{ $text }} font-bold  bg-gris-90 p-2 border-[2px]   rounded-[3px]" style="border-color: {{ $color }}">SIN STOCK</span>  @endif
    </div>
</lodo>
