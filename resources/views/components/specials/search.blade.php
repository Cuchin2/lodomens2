<div {{ $attributes->merge(['class' => 'relative w-[260px] ml-auto']) }}>
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <x-icons.search class="w-[14px] h-[14px]  text-gris-40" />
    </div>
    <input
        wire:model.live.debounce.300ms="search"
        type="text"
        class="bg-gris-90  border-gris-70 border h-[30px] text-gris-40 text-[12px] rounded-[20px] focus:ring-gris-50 focus:border-gris-50 block w-full pl-10 p-2 "
        placeholder="Buscar" required="">
</div>
