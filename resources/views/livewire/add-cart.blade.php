<div class="flex justify-left space-x-3" x-data="{count:1, color:{{ $color }}, see : true,
changestock(a) {
    stock = skus.find(function (sku) {
        return sku.color_id === a ;
      }).stock; this.limit();
},
limit(){
    if(this.count < 1) { this.count = 1; this.see = true}
    if(this.count >= stock) { this.count = stock; this.see = true}
    if(this.count === 0) { this.see = false}
}
}"  x-show="see" x-cloak
x-init="stock = skus.find(function (sku) {
    return sku.color_id === color ;
  }).stock; console.log(stock)">
    <div class="flex" @sku.window="color=$event.detail.parm; changestock(color)">
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

    <x-button.webprimary class="w-full" x-on:click="$wire.add(count,color)"> Añadir a Carrito</x-button.webprimary>

</div>
