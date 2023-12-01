<x-app-layout>
    <x-slot name="slot1">
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Roles' href="{{ route('roles.index') }}" />
            <x-breadcrumb.breadcrumb2 name="Crear rol" />
        </x-breadcrumb.breadcrumb>
    </x-slot>

    <x-slot name="slot2">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf
          
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 " id="miDiv">

                <div class=" bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-12 ">
                        <h3 class="dark:text-gray-300"> Creando un rol nuevo</h3>
                        <div class="my-2">
                            <x-label class="mb-2">Nombre</x-label>
                            <x-input name="name"  placeholder="Nombre del rol"></x-input>
                        </div>


                        <h4 class="dark:text-gray-200 mb-4">Permisos especiales</h4>


                        <div class="dark:text-gray-200">

                            <p> <input type="checkbox" id="all" onchange="cambiaGrupo(this)"
                                     /> TODOS / NINGUNO</p>
                            <h4 class="my-4">Lista de permisos</h4>
                            <div>
                                <h3 class="my-4"> Permisos para "Usuarios"</h3>
                                <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                        onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'usuario')
                                        <label class="flex">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="mx-3"
                                                >
                                            {{ $permission->description }}
                                        </label>
                                    @endif
                                @endforeach

                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Dashboard"</h3>

                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'dashboard')
                                        <label class="flex">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="mx-3"
                                                >
                                            {{ $permission->description }}
                                        </label>
                                    @endif
                                @endforeach

                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Marcas"</h3>
                                <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                        onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'marcas')
                                        <label class="flex">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="mx-3"
                                                >
                                            {{ $permission->description }}
                                        </label>
                                    @endif
                                @endforeach

                            </div>
                            <div>

                                <h3 class="my-4"> Permisos para "Etiquetas"</h3>
                                <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                        onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'etiquetas')
                                        <label class="flex">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="mx-3"
                                                >
                                            {{ $permission->description }}
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Categorias"</h3>
                                <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                        onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'categorias')
                                        <label class="flex">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="mx-3"
                                                >
                                            {{ $permission->description }}
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Suscripción"</h3>
                                <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                        onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'suscripción')
                                        <label class="flex">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="mx-3"
                                                >
                                            {{ $permission->description }}
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Imagenes"</h3>
                                <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                        onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'imagenes')
                                        <label class="flex">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="mx-3"
                                                >
                                            {{ $permission->description }}
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Archivos"</h3>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'archivos')
                                        <label class="flex">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                class="mx-3" >
                                            {{ $permission->description }}
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class=" bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg dark:text-gray-200">
                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Productos"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all" onchange="cambiaGrupo2(this)">
                                TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'productos')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Blog"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all" onchange="cambiaGrupo2(this)">
                                TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'blog')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Redes sociales"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'redes sociales')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Carrusel"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'carrusel')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Promociones"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'promociones')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Notificaciones"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'notificaciones')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Reportes"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'reportes')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Empresa"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'empresa')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class=" bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg dark:text-gray-200">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-12 ">

                        <div>
                            <h3 class="my-4"> Permisos para gestión de "Clientes"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'clientes')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Cliente"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'cliente')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Provedores"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'provedores')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Roles"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'roles')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Impresora"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'impresora')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Pedidos"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'pedidos')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Compras"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'compras')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Ventas"</h3>
                            <p class="my-2 mx-3"> <input type="checkbox" id="all"
                                    onchange="cambiaGrupo2(this)"> TODOS / NINGUNO</p>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'ventas')
                                    <label class="flex">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            class="mx-3" >
                                        {{ $permission->description }}
                                    </label>
                                @endif
                            @endforeach
                        </div>


                        <div class="my-4 flex float-right">
                            <x-button>
                                Crear
                            </x-button>
                          </div>
                    </div>

                </div>
            </div>
            </form>
                <script>
                    function cambiaGrupo(chk) {
                        var padreDIV = document.getElementById("miDiv");
                        /* var padreDIV = chk; */
                        while (padreDIV.nodeType == 1 && padreDIV.tagName.toUpperCase() != "DIV")
                            padreDIV = padreDIV.parentNode;
                        //ahora que padreDIV es el DIV, cogeremos todos sus checkboxes
                        var padreDIVinputs = padreDIV.getElementsByTagName("input");
                        for (var i = 0; i < padreDIVinputs.length; i++) {
                            if (padreDIVinputs[i].getAttribute("type") == "checkbox")
                                padreDIVinputs[i].checked = chk.checked;
                        }
                    }

                    function cambiaGrupo2(chk) {
                        var padreDIV = chk;
                        while (padreDIV.nodeType == 1 && padreDIV.tagName.toUpperCase() != "DIV")
                            padreDIV = padreDIV.parentNode;
                        //ahora que padreDIV es el DIV, cogeremos todos sus checkboxes
                        var padreDIVinputs = padreDIV.getElementsByTagName("input");
                        for (var i = 0; i < padreDIVinputs.length; i++) {
                            if (padreDIVinputs[i].getAttribute("type") == "checkbox")
                                padreDIVinputs[i].checked = chk.checked;
                        }
                    }
                </script>

    </x-slot>

</x-app-layout>
