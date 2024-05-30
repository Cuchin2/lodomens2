<div>
<div class="flex justify-left space-x-3" x-data="{count:1, color:{{ $color }}, see : true,
changestock(a) {
    stock = skus.find(function (sku) {
        return parseInt(sku.color_id) === a ;
      }).stock; this.limit();
},
limit(){
    if(this.count < 1) { this.count = 1; this.see = true}
    if(this.count >= stock) { this.count = stock; this.see = true}
    if(this.count === 0) { this.see = false}
}
}"  x-show="see" x-cloak
x-init="changestock(color)">
    <div class="flex" @sku.window="color=$event.detail.parm; changestock(color);">
        <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[36px] border-[1px] text-[12px] rounded-l-[3px]  border-gris-30 w-[30px] flex items-center"
            @click="count > 0 ? count-- : null; limit()">
            <x-icons.chevron-left grosor="1" height="20px" width="20px" class="p-1 mx-auto fill-gris-30" />
        </div>
        <div>
            <input type="text"
                class="text-gris-10 font-bold bg-black h-[36px] mx-auto text-[14px] p-2 focus:ring-gris-50 focus:border-gris-50 w-[52px] border-gris-30 text-center border-x-0"
                placeholder=" " required="" x-model="count" x-on:change="limit()">
        </div>
        <div class="cursor-pointer hover:border-gris-10 text-gris-60 bg-black h-[36px] border-[1px] text-[12px] rounded-r-[3px]  border-gris-30 w-[30px] flex items-center"
            @click="count++;  limit()">
            <x-icons.chevron-right grosor="1" height="20px" width="20px" class="p-1 mx-auto fill-gris-30" />
        </div>
    </div>

    <x-button.webprimary class="w-full !md:mr-[65px]" x-on:click="$wire.add(count,color)"> Añadir a Carrito</x-button.webprimary>


</div>
    {{--  modal  --}}
    <x-dialog-modal wire:model="showCreateModal" maxWidth="fit">
        <x-slot name="title">
            Iniciar Sesión para agregar al Wishlist
        </x-slot>
        <x-slot name="content">
            <div class="flex justify-center">
            <form  action="{{ route('login') }}" method="POST" class="w-fit">
                @csrf
                <div class="relative mb-3 text-gris-50" x-data="{ fly: false, inputValue: '' }">
                    <label class="absolute  left-[10px] pointer-events-none transition-all duration-300"
                        :class="fly ? 'text-[10px] top-[-6px] px-[3px] bg-gris-90 text-gris-10' : 'text-[14px] top-[10px]'">Correo
                        electrónico</label>
                    <input type="email" name="email" @click=" fly=true" @input="inputValue = $event.target.value"
                        @click.away="inputValue === null || inputValue === '' ? fly=false : null " x-on:change="fly=true"
                        class="bg-gris-90 rounded-[3px] w-[233px] border-gris-50 focus:ring-gris-50 focus:border-gris-50 text-gris-10" autocomplete="off" placeholder=" ">
                </div>
                <div class="relative mb-2 text-center text-gris-50" x-data="{ fly: false, inputValue: '' }">
                    {{-- <label for="exampleDropdownFormPassword1" class="form-label label-eco mb0">Contraseña</label> --}}
                    <input type="password" name="password" class=" text-gris-10 bg-gris-90 rounded-[3px] w-[233px] border-gris-50 focus:ring-gris-50 focus:border-gris-50"
                        autocomplete="off" placeholder=" " @click=" fly=true" @input="inputValue = $event.target.value"
                        @click.away="inputValue === null || inputValue === '' ? fly=false : null " x-on:change="fly=true">
                    <label class="absolute left-[10px]  pointer-events-none transition-all"
                        :class="fly ? 'text-[10px] top-[-6px] px-[3px] bg-gris-90 text-gris-10' : 'text-[14px] top-[10px]'">Contraseña</label>
    
    
                </div>
                <a class="text-[14px] text-corp-50" href="{{ route('web.recover_password') }}">¿Olvidaste la contraseña?</a>
                <div class="mt-6 text-[14px]">
    
                    <button type="submit"
                        class="w-full rounded-[3px]  text-white bg-corp-50 h-[33px] hover:bg-corp-70 ">Iniciar
                        sesión</button>
                    <div class="flex mt-1">
                        <eco style="margin-right:5px">¿No tienes cuenta?</eco>
                        <a class="text-corp-50" href="{{ route('web.login_register') }}">Registrate</a>
                    </div>
                </div>
    
            </form>
           </div>
    
        </x-slot>
    
        <x-slot name="footer">
    
    </x-slot>
    </x-dialog-modal>
</div>
