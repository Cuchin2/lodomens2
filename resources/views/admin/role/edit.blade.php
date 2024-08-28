<x-app-layout>
    <x-slot name="slot1">
        <x-breadcrumb.title title='Modificar Permisos del Rol : {{ $role->name }}'/>
        <x-breadcrumb.breadcrumb>
            <x-breadcrumb.breadcrumb2 name='Roles' href="{{ route('roles.index') }}" />
            <x-breadcrumb.breadcrumb2 name="{{ $role->name }}" />
        </x-breadcrumb.breadcrumb>
    </x-slot>

    <x-slot name="slot2">
        <form method="POST" action="{{ route('roles.update', $role) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 " id="miDiv">

                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-12 ">

                        <div class="my-2">
                            <x-label class="mb-2">Nombre</x-label>
                            <x-input name="name" value='{{ $role->name }}' placeholder="Nombre del rol"></x-input>
                        </div>


                        <x-label class="dark:text-gray-200 mb-4">Permisos especiales</x-label>


                        <div class="dark:text-gray-200">
                            <x-checkbox id="todos" onchange="cambiaGrupo(this)" rule="{{$tieneTodosLosPermisos}}">TODOS / NINGUNO</x-checkbox>

                            <x-label class="my-4">Lista de permisos</x-label>
                            <div>
                                <h3 class="my-4"> Permisos para "Usuarios"</h3>
                                <p class="my-2 mx-3">
                                    <x-checkbox id="all" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>

                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'usuario')
                                        <label class="flex">
                                            <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>

                                        </label>
                                    @endif
                                @endforeach

                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Dashboard"</h3>

                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'dashboard')
                                        <label class="flex">
                                            <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                        </label>
                                    @endif
                                @endforeach

                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Marcas"</h3>
                                <x-checkbox id="all2" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'marcas')
                                        <label class="flex">
                                            <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                        </label>
                                    @endif
                                @endforeach

                            </div>
                            <div>

                                <h3 class="my-4"> Permisos para "Etiquetas"</h3>
                                <x-checkbox id="all3" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'etiquetas')
                                        <label class="flex">
                                            <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Categorias"</h3>
                                <x-checkbox id="all4" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'categorias')
                                        <label class="flex">
                                            <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Suscripción"</h3>
                                <x-checkbox id="all5" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'suscripción')
                                        <label class="flex">
                                            <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Imagenes"</h3>
                                <x-checkbox id="all6" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'imagenes')
                                        <label class="flex">
                                            <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                            <div>
                                <h3 class="my-4"> Permisos para "Archivos"</h3>
                                @foreach ($permissions as $key => $permission)
                                    @if ($permission->type === 'archivos')
                                        <label class="flex">
                                            <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                        </label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg dark:text-gray-200">
                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Productos"</h3>
                            <x-checkbox id="all7" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'productos')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Blog"</h3>
                            <x-checkbox id="all8" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'blog')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Redes sociales"</h3>
                            <x-checkbox id="all9" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'redes sociales')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Carrusel"</h3>
                            <x-checkbox id="all10" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'carrusel')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="mx-auto max-w-screen-xl px-4 py-2 lg:px-12 ">
                        <div>
                            <h3 class="my-4"> Permisos para "Promociones"</h3>
                            <x-checkbox id="all11" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'promociones')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Notificaciones"</h3>
                            <x-checkbox id="all12" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'notificaciones')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Reportes"</h3>
                            <x-checkbox id="all13" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'reportes')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Empresa"</h3>
                            <x-checkbox id="all14" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'empresa')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class=" bg-white dark:bg-gris-80 overflow-hidden shadow-xl sm:rounded-lg dark:text-gray-200">
                    <div class="mx-auto max-w-screen-xl px-4 py-4 lg:px-12 ">

                        <div>
                            <h3 class="my-4"> Permisos para gestión de "Clientes"</h3>
                            <x-checkbox id="all15" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'clientes')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Cliente"</h3>
                            <x-checkbox id="all16" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'cliente')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Provedores"</h3>
                            <x-checkbox id="all17" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'provedores')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Roles"</h3>
                            <x-checkbox id="all18" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'roles')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Impresora"</h3>
                            <x-checkbox id="all19" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'impresora')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Pedidos"</h3>
                            <x-checkbox id="all20s" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'pedidos')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Compras"</h3>
                            <x-checkbox id="all21" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'compras')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>
                        <div>
                            <h3 class="my-4"> Permisos para "Ventas"</h3>
                            <x-checkbox id="all22" onchange="cambiaGrupo2(this)" >TODOS / NINGUNO</x-checkbox>
                            @foreach ($permissions as $key => $permission)
                                @if ($permission->type === 'ventas')
                                    <label class="flex">
                                        <x-checkbox id="{{$permission->id}}" name="permissions[]" rule="{{ $role->hasPermissionTo($permission) }}" value="{{ $permission->id }}">{{ $permission->description }}</x-checkbox>
                                    </label>
                                @endif
                            @endforeach
                        </div>


                        <div class="my-4 flex float-right">
                            <x-button.corp1 type="submit">
                                Actualizar
                            </x-button.corp1>
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
