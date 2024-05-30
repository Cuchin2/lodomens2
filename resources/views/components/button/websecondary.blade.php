<button {{ $attributes->merge(['class' => 'border border-transparent
    bg-gradient-to-b from-corp2-30 via-corp2-50 to-corp2-90 border-corp2-10
    
    hover:from-corp2-40 hover:via-corp2-60 hover:to-corp2-90 hover:border-corp2-10
    active:from-corp2-40 active:via-corp2-50 active:to-corp2-80 
    focus:from-corp2-30 focus:via-corp2-70 focus:to-corp2-90
     
    text-white rounded-[3px] px-4 font-bold h-[36px]']) }}>
    {{ $slot }}
</button>
{{--  <div class="  w-full  bg-gradient-to-b from-oro-30 via-oro-50 to-oro-70 mt-4">
    <button {{ $attributes->merge(['class' => ' rounded-[3px] border-[2px] border-corp2-50  text-white   font-bold h-[56px]']) }}>
        {{ $slot }}
</div>  --}}

{{--  <div class="relative mt-8 group cursor-pointer">
    <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-600 to-purple-600 opacity-75 rounded-lg blur group-hover:opacity-100 transitiom duration-1000 group-hover:duration-200"> </div>
        <div class="relative px-7 py-4 bg-black rounded-lg leading-none flex items-center justify-center">
            {{ $slot }}
        </div>

</div>  --}}
