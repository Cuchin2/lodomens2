<x-app-layout>

    <x-slot name="slot1">
        <x-breadcrumb.title title='Editar Footer'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2  name='Footer'/>
        </x-breadcrumb.breadcrumb>
    </x-slot>


    <x-slot name="slot2"> @if (session()->has('info'))
        <div x-data="{ open: true }" x-show="open" x-init="setTimeout(() => open = false, 2000)"
            :class="!open" x-collapse
            class="mb-[20px]">
            <div class="items-center flex rounded-lg border border-green-600 bg-green-900 bg-opacity-20 py-2 px-2 text-green-600 sm:px-5 text-[12px]">
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
        <form method="POST" action="{{ route('mypage.update',1) }}" name="formulario" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 " id="miDiv">

                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-6 ">

                        <div class="my-3">
                            <x-label class="mb-2">Título:</x-label>
                            <x-input name="title" value="{{$footer->title ?? ''}}" placeholder="Escribir título "></x-input>
                        </div>

                        <div class="my-3">
                            <x-label class="my-2">Contenido:</x-label>
                            <x-input-textarea placeholder="Contenido" name="content" col="4">
                                {{$footer->content ?? ''}}
                                </x-imput-textarea>
                                <span class="dark:text-[12px] text-gris-40 text-center flex m-1">Se recomienda de 200 a 300
                                    caracteres</span>
                        </div>
                    </div>
                </div>
                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-6 ">
                        <div class="my-3">
                            <x-label class="mb-2">Logo:</x-label>
                           {{--  pruebas  --}}
                           <div class="py-3">

                            <!-- If you wish to reference an existing file (i.e. from your database), pass the url into imageData() -->
                           <x-specials.upload-file url="{{ $url }}"/>
                          </div>

                           {{--  fin de pruebas  --}}

                        </div>
                        <div class="my-3 dark:text-gray-200">
                            <x-label class="my-2">Redes sociales</x-label>
                             @if ($user->socialMedia->isNotEmpty())
                            <livewire-socialmedia-profile :redes="$user->socialMedia" />
                           @else
                           <livewire-socialmedia-profile />
                           @endif
                        </div>
                    </div>
                </div>
                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-6 h-full">
                        <div class="my-3">
                        <x-label  value="{{ __('Información:') }}" />
                    </div>
                        <div class="my-3">

                            <div class="text-base text-gris-10 flex my-3 items-center">
                                <x-icons.address class="h-[20px] mr-3"/>
                                <x-input name="address" value="{{ $footer->address ?? '' }}" placeholder="Ubicación "></x-input>
                            </div>
                        </div>
                        <div class="my-3">
                            <div class="text-base text-gris-10 flex  my-3 items-center">
                            <x-icons.phone class="h-[20px] mr-3"/>
                            <x-input name="phone" value="{{ $footer->phone ?? '' }}" placeholder="Teléfono "></x-input>
                            </div>
                        </div>

                        <div class="my-3">
                            <div class="text-base text-gris-10 flex my-3 items-center">
                            <x-icons.mail class="h-[20px] mr-3"/>
                            <x-input name="email" value="{{ $footer->email ?? '' }}" placeholder="Correo electrónico "></x-input>
                        </div>

                        </div>
                        <div class="my-3">
                            <div class="text-base text-gris-10 flex my-3 items-center">
                                <x-icons.pedidos class="h-[20px]  mr-3 "/>
                                <x-input name="order_message" value="{{ $footer->order_message ?? '' }}" placeholder="Mensaje de envios "></x-input>
                            </div>

                        </div>

                        <x-button.corp1 type="buttom" class="ml-auto mt-auto">Actualizar</x-button.corp1>

                    </div>
                </div>
            </div>
        </form>

    </x-slot>

</x-app-layout>
