@props(['placeholder','message','name','selected','data'])

<div >
    <div x-data="select({ data: {{ json_encode($data) }}, emptyOptionsMessage: '{{$message}}', name: 'country', placeholder: '{{$placeholder}}',value:'{{$selected}}' })" x-init="init()" @click.away="closeListbox()" @keydown.escape="closeListbox()"
        class="relative">
        <span class="inline-block w-full rounded-md shadow-sm">
            <button type="button" x-ref="button" @click="toggleListboxVisibility()" :aria-expanded="open"
                aria-haspopup="listbox" @click.away="$wire.change(value)"
                class="relative h-[30px] z-0 w-full py-1 pl-3 pr-10 text-left transition duration-150 ease-in-out dark:bg-gris-90 border border-gray-700 rounded-md cursor-default focus:outline-none focus:shadow-outline-teal focus:border-corp-50 sm:text-sm sm:leading-5">
                <span x-show="! open" x-text="value in options ? options[value] : placeholder"
                    :class="{ 'text-gris-30': !(value in options) }" class="block truncate dark:text-gris-30"></span>
                <input type="hidden" name="{{$name}}" x-model="value">
                <input x-ref="search" x-show="open" x-model="search"  @keydown.enter.stop.prevent="selectOption()"
                    @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()"
                    type="search"
                    class="w-full border-gris-30 h-[20px] dark:border-gray-700 dark:bg-gris-90 dark:text-gris-30 focus:border-cop-50 dark:focus:border-corp-70 focus:ring-corp-50 dark:focus:ring-corp-70 rounded-md shadow-sm text-[12px]"
                     />

                <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                    <svg class="w-5 h-4 text-gris-30" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round"></path>
                    </svg>
                </span>
            </button>
        </span>

        <div x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" x-cloak
            class="absolute z-10 w-full mt-1 dark:bg-gris-90 rounded-md shadow-lg">
            <ul x-ref="listbox" @keydown.enter.stop.prevent="selectOption()"
                @keydown.arrow-up.prevent="focusPreviousOption()" @keydown.arrow-down.prevent="focusNextOption()"
                role="listbox" :aria-activedescendant="focusedOptionIndex ? name + 'Option' + focusedOptionIndex : null"
                tabindex="-1"
                class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-24 focus:outline-none sm:text-sm sm:leading-5 bar">
                <template x-for="(key, index) in Object.keys(options)" :key="index">
                    <li :id="name + 'Option' + focusedOptionIndex" @click="selectOption()"
                        @mouseenter="focusedOptionIndex = index" @mouseleave="focusedOptionIndex = null" role="option"
                        :aria-selected="focusedOptionIndex === index"
                        :class="{
                            'text-gris-30 bg-corp-50': index === focusedOptionIndex,
                            'text-gray-900': index !==
                                focusedOptionIndex
                        }"
                        class="relative py-1 pl-3 text-gray-900 cursor-default select-none pr-9">
                        <span x-text="Object.values(options)[index]"
                            :class="{ 'font-semibold': index === focusedOptionIndex, 'font-normal': index !==
                                focusedOptionIndex }"
                            class="block font-normal truncate dark:text-gris-30"></span>

                        <span x-show="key === value"
                            :class="{ 'text-white': index === focusedOptionIndex, 'text-corp-50': index !==
                                focusedOptionIndex }"
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-corp-50">
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
    </div>

    <script>
        function select(config) {
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

                closeListbox: function() {
                    this.open = false

                    this.focusedOptionIndex = null

                    this.search = ''
                },

                focusNextOption: function() {
                    if (this.focusedOptionIndex === null) return this.focusedOptionIndex = Object.keys(this.options)
                        .length - 1

                    if (this.focusedOptionIndex + 1 >= Object.keys(this.options).length) return

                    this.focusedOptionIndex++

                    this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                        block: "center",
                    })
                },

                focusPreviousOption: function() {
                    if (this.focusedOptionIndex === null) return this.focusedOptionIndex = 0

                    if (this.focusedOptionIndex <= 0) return

                    this.focusedOptionIndex--

                    this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                        block: "center",
                    })
                },

                init: function() {
                    this.options = this.data

                    if (!(this.value in this.options)) this.value = null

                    this.$watch('search', ((value) => {
                        if (!this.open || !value) return this.options = this.data

                        this.options = Object.keys(this.data)
                            .filter((key) => this.data[key].toLowerCase().includes(value.toLowerCase()))
                            .reduce((options, key) => {
                                options[key] = this.data[key]
                                return options
                            }, {})
                    }))
                },

                selectOption: function() {
                    if (!this.open) return this.toggleListboxVisibility()

                    this.value = Object.keys(this.options)[this.focusedOptionIndex]

                    this.closeListbox()
                },

                toggleListboxVisibility: function() {
                    if (this.open) return this.closeListbox()

                    this.focusedOptionIndex = Object.keys(this.options).indexOf(this.value)

                    if (this.focusedOptionIndex < 0) this.focusedOptionIndex = 0

                    this.open = true

                    this.$nextTick(() => {
                        setTimeout(() => {
                        this.$refs.search.focus()

                        this.$refs.listbox.children[this.focusedOptionIndex].scrollIntoView({
                            block: "nearest"
                        })
                        }, 100);
                    })
                },
            }
        }
    </script>

</div>
