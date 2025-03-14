@props(['placeholder','message','name'=>'','selected','data', 'livewire'=>false, 'set'=>'','altura'=>'200px'])
<div class="text-gris-5">
    <div x-data="select{{ $set }}({
        data: {{ json_encode($data) }},
        emptyOptionsMessage: '{{$message}}',
        name: 'country',
        placeholder: '{{$placeholder}}',
        value:'{{$selected}}'
    })" x-init="init();" @click.away="closeListbox()" @keydown.escape="closeListbox()"
        class="relative">
        <span class="inline-block w-full rounded-md shadow-sm">
            <button type="button" x-ref="button" @click="toggleListboxVisibility()" :aria-expanded="open"
                aria-haspopup="listbox"
                class="relative h-[30px] z-0 w-full py-1 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-gris-90 border focus:ring-gris-50 border-gris-70 rounded-md cursor-default focus:outline-none focus:shadow-outline-teal focus:border-gris-50 text-[12px]">
                <span x-show="! open" x-text="value in options ? options[value] : placeholder"
                    :class="{ 'text-gris-30': !(value in options) }" class="block truncate text-gris-30"></span>
                <input type="hidden" x-model="value" name="{{$name}}" />
                <input x-ref="search" x-show="open" x-model="search" @keydown.enter.stop.prevent="selectOption();"
                    @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()"
                    type="search"
                    class="w-full  h-[20px] border-gray-700 bg-gris-90 text-gris-30 focus:border-cop-50 focus:border-corp-70 focus:ring-corp-50  rounded-md shadow-sm text-[12px]" />
                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <div class="text-gris-30 ml-auto">
                        <x-icons.chevron-down />
                    </div>
                </span>
            </button>
        </span>
        <div x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" @rest{{ $set }}.window="value = null"
            x-transition:leave-end="opacity-0" x-cloak
            class="absolute z-10 w-full mt-1 bg-gris-90 rounded-md shadow-lg">
            <ul x-ref="listbox" @keydown.enter.stop.prevent="selectOption()"
                @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()"
                role="listbox" :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                tabindex="-1"
                class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs focus:outline-none text-[12px] sm:leading-5 bar" style="max-height:{{ $altura }};">
                <template x-for="(key, index) in Object.keys(options)" :key="index">
                    <li :id="name + 'Option' + focusedOptionIndex" @click="selectOption()"
                        @mouseenter="focusedOptionIndex = index" @mouseleave="focusedOptionIndex = null" role="option"
                        :aria-selected="focusedOptionIndex === index"
                        :class="{
                            'text-gris-5 bg-gris-80': index === focusedOptionIndex,
                            'text-gris-10': index !== focusedOptionIndex
                        }"
                        class="relative py-1 pl-3 text-gris-20 cursor-default select-none pr-9">
                        <span x-text="Object.values(options)[index]"
                            :class="{ 'font-normal': index === focusedOptionIndex, 'font-normal': index !==
                                focusedOptionIndex }"
                            class="block font-normal truncate text-gris-20 hover:text-gris-5"></span>
                        <span x-show="key === value"
                            :class="{ 'text-gris-5': index === focusedOptionIndex, 'text-gris-10': index !==
                                focusedOptionIndex }"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-gris-10">
                            <svg class="w-5 h-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </li>
                </template>
                <div x-show="! Object.keys(options).length" x-text="emptyOptionsMessage"
                    class="px-3 py-1 text-gris-20 cursor-default select-none text-[12px]"></div>
            </ul>
        </div>
        <button @click="$wire.selection(value,{{ $set }})" id="btn{{ $set }}" class="hidden" type="submit"></button>
    </div>
    <script>
        function select{{ $set }}(config) {
            return {
                data: config.data,
                emptyOptionsMessage: config.emptyOptionsMessage ?? 'No results match your search.',
                focusedOptionIndex: null,
                name: config.name,
                open: false,
                options: {},
                placeholder: config.placeholder ?? 'Select an option',
                search: '',
                value: config.value,
                livewire: '{{ $livewire }}',
                closeListbox: function() {
                    this.open = false;
                    this.focusedOptionIndex = null;
                    this.search = '';
                },
                focusNextOption: function() {
                    if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options)
                        .length - 1;
                    if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return;
                    this.focusedOptionIndex++;
                    this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                        block: "center",
                    });
                },
                focusPreviousOption: function() {
                    if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0;
                    if (this.focusedOptionIndex <= 0) return;
                    this.focusedOptionIndex--;
                    this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                        block: "center",
                    });
                },
                init: function() {
                    this.options = this.data;
                    if (!(this.value in this.options)) this.value = null;
                    this.$watch('search', ((value) => {
                        if (!this.open || !value) return this.options = this.data;
                        this.options = Object.keys(this.data)
                            .filter((key) => this.data[key].toLowerCase().includes(value.toLowerCase()))
                            .reduce((options, key) => {
                                options[key] = this.data[key];
                                return options;
                            }, {});
                    }));
                },
                selectOption: function() {
                    const selectedKey = Object.keys(this.options)[this.focusedOptionIndex];

                    // Si la opción seleccionada ya está seleccionada, limpia el valor
                    if (this.value === selectedKey) {
                        this.value = null; // Limpia el valor
                        this.closeListbox(); // Cierra el menú desplegable
                        return;
                    }

                    // Si no, selecciona la nueva opción
                    this.value = selectedKey;

                    // Si está habilitado Livewire, envía el evento
                    if (this.livewire == 'true') {
                        const miBoton = document.getElementById('btn' + '{{ $set }}');
                        miBoton.click();
                    }

                    this.closeListbox();
                },
                toggleListboxVisibility: function() {
                    if (this.open) return this.closeListbox();
                    this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value);
                    if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0;
                    this.open = true;
                    this.$nextTick(() => {
                        setTimeout(() => {
                            this.$refs.search.focus();
                            this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                                block: "nearest"
                            });
                        }, 100);
                    });
                },
            }
        }
    </script>
</div>
