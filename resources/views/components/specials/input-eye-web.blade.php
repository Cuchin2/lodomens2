<div class="relative mt-0 " x-data="{ show: true }">
    <input class="w-full focus:ring-black bg-transparent border-0 border-b-[1px] border-gris-70 focus:border-b-[1px] focus:border-gris-70 focus:placeholder-gris-50 placeholder-gris-50 md:text-[14px] text-[12px]

" :type="show ? 'password' : 'text'" placeholder="Contraseña" {{ $attributes }}>

    <div class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 cursor-pointer">
        <x-icons.eye_close class="h-4 text-gris-30" />
        <x-icons.eye_open class="h-4 text-gris-30" />
    </div>

</div>
