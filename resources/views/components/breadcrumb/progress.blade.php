
<div class="fixed w-full z-40">
<div class="bg-gris-90 py-[3px] border-b-[1px] border-gris-80
text-gris-10 md:py-[10px] text-center h-[60px] items-center flex">

    <div class="h-[22px] md:h-[25.19px] mx-auto items-center flex">
        <nav class="flex px-9 mt-[4px ]md:mt-[8px] dark:border-gris-70  font-normal text-[12px]"
            aria-label="Breadcrumb">
            <ol class="mx-auto">
                <div class="w-full mx-auto flex space-x-3">

                    <div class="rounded-full h-5 w-5 {{ request()->routeIs('web.shop.checkout.index') ? 'bg-gris-10 text-gris-90' : 'text-gris-30 bg-gris-70' }} text-center text-[14px] font-bold flex items-center justify-center">1</div>
                    <div class="{{ request()->routeIs('web.shop.checkout.index') ? 'text-gris-10' : 'text-gris-40' }}">Facturación</div>
                    <div class="rounded-full h-5 w-5  {{ request()->routeIs('web.shop.checkout.shipping') ? 'bg-gris-10 text-gris-90' : 'text-gris-30 bg-gris-70' }} text-center text-[14px] font-bold flex items-center justify-center">2</div>
                    <div class="{{ request()->routeIs('web.shop.checkout.shipping') ? 'text-gris-10' : 'text-gris-40' }}">Envíos</div>
                    <div class="rounded-full h-5 w-5 {{ request()->routeIs('web.shop.checkout.pay') ? 'bg-gris-10 text-gris-90' : 'text-gris-30 bg-gris-70' }} text-center text-[14px] font-bold flex items-center justify-center">3</div>
                    <div class="{{ request()->routeIs('web.shop.checkout.pay') ? 'text-gris-10' : 'text-gris-40' }}">Pagos</div>
                    <div class="rounded-full h-5 w-5 {{ request()->routeIs('web.shop.gracias') ? 'bg-gris-10 text-gris-90' : 'text-gris-30 bg-gris-70' }} text-center text-[14px] font-bold flex items-center justify-center">4</div>
                    <div class="{{ request()->routeIs('web.shop.gracias') ? 'text-gris-10' : 'text-gris-40' }}">Confirmación</div>

                </div>
            </ol>
        </nav>
    </div>
</div>
</div>
