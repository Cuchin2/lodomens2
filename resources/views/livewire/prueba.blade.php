<div>
    <section class="mt-10">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
            <!-- Start coding here -->
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex items-center justify-between d p-4">
                    <div class="flex">
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-300 dark:text-gray-300"
                                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input
                                wire:model.live.debounce.300ms="search"
                                type="text"
                                class="bg-gray-800 border border-gray-300 text-gray-50 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Buscar" required="">
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <div class="flex space-x-3 items-center">
                            <x-button class="w-52" href="{{route('roles.create')}}" wire:navigate>Nuevo Rol</x-button>
                            <label class="w-60 text-sm font-medium text-gray-100">Tipo de usuario :</label>
                            <select

                                class="bg-gray-800 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option value="">Todos</option>
                                <option value="0">User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-100 uppercase bg-gray-900">
                            <tr>
                                <th scope="col" class="px-4 py-3" >ID</th>
                                <th scope="col" class="px-4 py-3 " wire:click="setSortBy('name')">
                                    Role
                                    </th>
                                <th scope="col" class="px-4 py-3 " wire:click="setSortBy('created_at')">Creado</th>
                                <th scope="col" class="px-4 py-3" wire:click="setSortBy('updated_at')">úlTIMA ACTUALIZACIÓN</th>
                                <th scope="col" class="px-4 py-3 text-center">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)

                            <tr wire:key="{{$role->id}}" class="border-b dark:border-gray-700 dark:hover:bg-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$role->id}}</th>

                                <td class="px-4 py-3 {{$role->name === 'Admin' ? 'text-green-500': 'text-blue-500'}} ">
                                    {{$role->name}}</td>
                                <td class="px-4 py-3">{{$role->created_at}}</td>
                                <td class="px-4 py-3">{{$role->updated_at}}</td>
                                <td class="px-4 py-3 flex items-center justify-center space-x-2">
                                    <x-primary-button href="{{route('roles.edit',$role->id)}}">
                                        <x-icons.edit></x-icons.edit>
                                    </x-primary-button>
                                    <x-danger-button  wire:click="showDeleteModal({{ $role->id }},'{{$role->name}}')" >
                                        <x-icons.trash class="h-5 w-5"></x-icons.trash>
                                    </x-danger-button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="py-4 px-3">
                    <div class="flex ">
                        <div class="flex space-x-4 items-center mb-3">
                            <label class="w-36 text-sm font-medium text-gray-100">Por página</label>
                            <select
                                wire:model.live='perPage'
                                class="bg-gray-800 border border-gray-300 text-gray-100 text-sm rounded-lg focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 ">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    {{$roles->links()}}
                </div>
            </div>
        </div>
        <x-dialog-modal wire:model="showModal">
            <x-slot name="title">
                Confirmar Eliminación
            </x-slot>

            <x-slot name="content">
                ¿Estás seguro de que deseas eliminar el rol de "<b>{{$itemName}}</b>"?
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button  wire:click="$toggle('showModal')" wire:loading.attr="disabled">
                    {{ __('Cancelar') }}
                </x-secondary-button>

                <x-danger-button class="ml-3" wire:click="delete({{$itemIdToDelete}})" wire:loading.attr="disabled">
                    {{ __('Eliminar') }}
                </x-danger-button>
            </x-slot>
        </x-dialog-modal>

    </section>

</div>
