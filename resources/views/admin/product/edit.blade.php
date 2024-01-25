<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Editar producto "{{$product->name}}"'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 href="{{route('products.index')}}" name='Productos'/>
            <x-breadcrumb.breadcrumb2  name='{{$product->name}}'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>
    <x-slot name="slot2"> @if (session()->has('info'))
        <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 2000)"
            :class="!open" x-collapse
            class="mb-[20px]">
            <div
    class="items-center flex rounded-lg border border-green-600 bg-green-900 bg-opacity-20 py-2 px-2 text-green-600 sm:px-5 text-[12px]"
  >
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="h-5 w-5"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        fill-rule="evenodd"
        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
        clip-rule="evenodd"
      />
    </svg>
    <p class="mx-1 ">{{session()->get('info')}}</p>
  </div>

        </div>

    @endif
        <form method="POST" action="{{ route('products.update', $product) }}" name="formulario" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 " id="miDiv">

                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg: ">

                        <div class="my-3">
                            <x-label class="mb-2">Primer nombre</x-label>
                            <x-input name="name" value="{{ $product->name }}" placeholder="Primer nombre "></x-input>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Nivel de stock</x-label>
                            <x-input name="middle_name" value="{{ $product->stock}}" placeholder="Nivel de stock "></x-input>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Preocio de venta</x-label>
                            <x-input name="last_name" value="{{ $product->sell_price }}" placeholder="Precio de venta "></x-input>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Visualizaciones</x-label>
                            <x-label>{{ $product->views }}</x-label>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Categoría</x-label>
                            <div class="mt-3">
                                <x-select-search placeholder="Selecciona la categoría"
                                    message="Ninguna categoría coincide con la búsqueda" name="category_id" :data="$categories"
                                    selected="{{ $product->category->id }}">
                                </x-select-search>
                            </div>
                           {{--   <x-input name="ruc" placeholder="RUC "
                                value="{{ optional($product->profile)->ruc }}"
                                ></x-input>
                            <span class="dark:text-gris-50 text-[12px] flex m-1">Este campo es opcional</span>  --}}
                        </div>
                    </div>
                </div>
                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg: ">
                        <div class="my-3">
                            <x-label class="mb-2">Teléfono / Celular</x-label>
                            <x-input name="phone" value="{{ optional($product->profile)->phone }}" type="number" placeholder="Teléfono / Celular"></x-input>
                            <span class="dark:text-gris-50 text-[12px] flex m-1">Este campo es opcional</span>
                        </div>
                        <div class="my-3">
                            <x-label class="my-2">Descripción corta</x-label>
                            <x-input-textarea placeholder="Descripción corta" name="shot_description" col="8">
                                {{ $product->short_description }}
                                </x-imput-textarea>
                                <span class="dark:text-gris-50 text-[12px] flex m-1">Se recomienda de 200 a 300
                                    caracteres</span>
                        </div>
                    </div>
                </div>
                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg: ">

                        <div class="my-3">
                            <x-label for="password_confirmation" value="{{ __('Nueva contraseña') }}" />
                            <div class="mt-1 items-center password-input" x-data="{ show: true }">
                                <input class="w-full border-gray-300 h-[30px] dark:border-gray-700 dark:bg-gris-90 dark:text-gris-30 focus:border-cop-50 dark:focus:border-corp-70 focus:ring-corp-50 dark:focus:ring-corp-70 rounded-md shadow-sm text-[12px] pr-[30px]

                                " :type="show ? 'password' : 'text'" placeholder="Contraseña" name="password" >

                                <div class="password-icon dark:text-gray-400  px-1  text-sm leading-5">
                                    <x-icons.eye_open x-cloak class="h-4 cursor-pointer" @click="show = !show" x-bind:class="{ 'hidden': show, 'block': !show }"/>
                                    <x-icons.eye_close x-cloak class="h-4 cursor-pointer" @click="show = !show" x-bind:class="{ 'hidden': !show, 'block': show }"/>
                                </div>

                            </div>
                            @error('password')
                            <small class="text-sm dark:text-red-500">
                                {{$message}}
                            </small>
                            @enderror
                        </div>

                        <div class="my-3">
                            <x-label for="password_confirmation" value="{{ __('Confirmar nueva Contraseña') }}" />
                            <div class="mt-1 items-center password-input" x-data="{ show: true }">
                                <input class="w-full border-gray-300 h-[30px] dark:border-gray-700 dark:bg-gris-90 dark:text-gris-30 focus:border-cop-50 dark:focus:border-corp-70 focus:ring-corp-50 dark:focus:ring-corp-70 rounded-md shadow-sm text-[12px] pr-[30px]

                                " :type="show ? 'password' : 'text'" placeholder="Repetir contraseña"  name="password_confirmation">

                                <div class="password-icon dark:text-gray-400  px-1  text-sm leading-5">
                                    <x-icons.eye_open x-cloak class="h-4 cursor-pointer" @click="show = !show" x-bind:class="{ 'hidden': show, 'block': !show }"/>
                                    <x-icons.eye_close x-cloak class="h-4 cursor-pointer" @click="show = !show" x-bind:class="{ 'hidden': !show, 'block': show }"/>

                                </div>

                            </div>
                            @error('password')
                                    <small class="text-sm dark:text-red-500">
                                        {{$message}}
                                    </small>
                                    @enderror
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Correo electrónico</x-label>
                            <x-input name="email" type="email" value="{{ $product->email }}" placeholder="correo electrónico"></x-input>
                            <span class="dark:text-gris-50 text-[12px] flex m-1">Este campo es opcional</span>
                        </div>
                        <div class="my-3">
                            <x-label class="mb-2">Fecha de nacimiento</x-label>
                            <input type="date"
                                class="border-gray-300 dark:border-gris-60 dark:bg-gris-90 dark:text-gris-30 focus:border-corp-50 dark:focus:border-corp-50 focus:ring-corp-50 dark:focus:ring-corp-60 rounded-lg shadow-sm text-[12px] h-[30px]
                                block"
                                name="birthday" id="birthday">
                            <span class="dark:text-gris-50 text-[12px] flex m-1">Este campo es opcional</span>
                        </div>
                        <div class="mt-4 dark:text-gray-300">

                        </div>

                        <x-button.corp1 class="ml-auto">Actualizar</x-button.corp1>

                    </div>
                </div>
            </div>
        </form>
        <style>
            .password-input {
          position: relative;
        }

        .password-input input[type="password"] {
          padding-right: 40px; /* Espacio para el icono */
        }

        .password-input .password-icon {
          position: absolute;
          top: 50%;
          right: 5px;
          transform: translateY(-50%);
          pointer-events: pointer; /* Evita que el icono sea interactivo */
        }
        </style>
    </x-slot>

</x-app-layout>
