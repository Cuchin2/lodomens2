@extends('layouts.web')

@section('breadcrumb')

<x-breadcrumb.lodomens.breadcrumb title="Checkout">
    <x-breadcrumb.lodomens.breadcrumb2 name='Checkout' />
</x-breadcrumb.lodomens.breadcrumb>

@endsection

{{--  <x-lodomens.video />  --}}
@section('content')

<div class="md:mx-5 lg:mx-auto lg:w-[987px] bg-black/75  pb-1 2xl:min-h-[374px] lg:min-h-[278px]">
    <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 md:col-span-2">
            <div>
                <h5 class="p-2">DETALLES DE FACTURACIÓN</h5>
                <div class="bg-gris-90 p-4 rounded-[3px]">
                    <div class=" grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-labelweb>Nombre</x-labelweb>
                            <x-input placeholder="Ingrese su nombre"></x-input>
                        </div>
                        <div>
                            <x-labelweb>Apellido</x-labelweb>
                            <x-input placeholder="Ingrese su apellido"></x-input>
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-labelweb>Número del a empresa (opcional)</x-labelweb>
                        <x-input placeholder="Ingrese el número de la empresa"></x-input>
                    </div>
                    <div class=" grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-labelweb>Documento</x-labelweb>
                            <x-input placeholder="Ingrese su documento"></x-input>
                        </div>
                        <div>
                            <x-labelweb>N° de documento</x-labelweb>
                            <x-input placeholder="Ingrese su N° de documento"></x-input>
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-labelweb>Dirección</x-labelweb>
                        <x-input placeholder="Ingrese su dirección"></x-input>
                    </div>
                    <div class="mb-4">
                        <x-labelweb>Referencia (opcional)</x-labelweb>
                        <x-input placeholder="Ingrese su referencia"></x-input>
                    </div>
                    <div class=" grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <div class="mb-4">
                                <x-labelweb>Ciudad</x-labelweb>
                                <x-input placeholder="Ingrese su ciudad"></x-input>
                            </div>
                            <div class="mb-4">
                                <x-labelweb>Teléfono</x-labelweb>
                                <x-input placeholder="Ingrese su teléfono"></x-input>
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <x-labelweb>Distrito/Provincia</x-labelweb>
                                <x-input placeholder="Ingrese su distrito/provincia"></x-input>
                            </div>
                            <div class="mb-4">
                                <x-labelweb>Código Postal</x-labelweb>
                                <x-input placeholder="Ingrese su Código Postal"></x-input>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-labelweb>Correo electrónico</x-labelweb>
                        <x-input placeholder="Ingrese su correo"></x-input>
                    </div>
                    <div class=" grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <x-labelweb>Fecha de entrega</x-labelweb>
                            <x-input placeholder=""></x-input>
                        </div>
                        <div>
                            <x-labelweb>Rango de entrega</x-labelweb>
                            <x-input placeholder=""></x-input>
                        </div>
                    </div>
                    <div>
                        <h5 class="p-2">DETALLES DE ENVIO</h5>
                        <p>¿Enviar a una dirección diferente?</p>
                    </div>
                </div>

            </div>
        </div>
        <div>
            <div>
                <h5 class="p-2">TU PEDIDO</h5>
                <div class="bg-gris-90 p-4 rounded-[3px] mb-4">
                    <div>
                        <h5>Resumen de pedido</h5>
                        <div class="flex justify-between my-8">
                            <p>Subtotal({{ Cart::instance('cart')->content()->count() }})</p>
                            <p>S/.{{ Cart::instance('cart')->subtotal() }}</p>
                        </div>
                        {{-- <div class="flex justify-between my-2">
                            <p>IVA</p>
                            <p>S/.{{ Cart::instance('cart')->tax() }}</p>
                        </div> --}}
                        <div class="flex justify-between my-2 text-white">
                            <p>Total</p>
                            <p>S/.{{ Cart::instance('cart')->total() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gris-90 p-4 rounded-[3px]" x-data="{selectedFruit: ['izipay']}">
                <h5 class="mb-4">Métodos de Pago</h5>
                <div class="mb-4">
                    <input x-model="selectedFruit"
                    value="izipay" id="radio1" type="radio" name="radio" class="hidden" />
                    <label for="radio1" class="flex items-center cursor-pointer">
                    <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                    Tarjeta de crédit o débito - IZIPAY</label>
                        <div class="flex space-x-4 mt-4">
                            <img class="h-10" src="{{ asset('image/payment/visa.png') }}" alt="">
                            <img class="h-10" src="{{ asset('image/payment/mastercard.png') }}" alt="">
                        </div>
                </div>
                <div class="mb-4">
                    <input x-model="selectedFruit"
                    value="paypal" id="radio2" type="radio" name="radio" class="hidden" />
                    <label for="radio2" class="flex items-center cursor-pointer">
                    <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                    Paypal</label>
                </div>
                <div>
                    <input x-model="selectedFruit"
                    value="yape" id="radio3" type="radio" name="radio" class="hidden" />
                    <label for="radio3" class="flex items-center cursor-pointer">
                    <span class="w-4 h-4 inline-block mr-2 rounded-full border flex-no-shrink"></span>
                    Yape</label>
                    <img class="h-10 rounded-[3px] mt-2" src="{{ asset('image/payment/yape.png') }}" alt="">
                </div>
                <div class="my-4">
                    <span>Sus datos personales se utilizarán para procesar su pedido, respaldar su experiencia en este sitio web y para otros fines descritos en nuestra <r class="text-corp-30 font-bold">política de privacidad</r> </span>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" id="check" name="terms">
                    <label  for="check"></label><label class="form-check-label"
                        >Al registrarte estás
                        aceptando los<a href="#"><b class="hover:text-corp-30"> Términos y
                            Condiciones</b></a></label>
                </div>
                <x-button.websecondary class="w-full mt-4">Realizar Pedido</x-button.websecondary>
            </div>
        </div>
    </div>
</div>

@endsection
