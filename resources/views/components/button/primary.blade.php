
<button {{ $attributes->merge(['class' => 'w-[90px] h-[24px] border border-solid border-azul-30 rounded-[20px] overflow-hidden flex justify-center items-center gap-4 hover:bg-azul-30 hover:bg-opacity-[12%]']) }}>
    <div class="text-azul-30 text-center text-[12px] font-inter font-normal leading-4">
        {{$slot}}
    </div>
</button>
