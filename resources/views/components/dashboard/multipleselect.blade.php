@props(['id'=>'','colorSelect'=>'','colorUnSelect'=>'','param'=>'1', 'placeholder'=>'','name'=>''])
<div class="msa-wrapper border-gris-70 border-[1px] dark:border-gris-70 dark:bg-gris-90 dark:text-gray-300 w-full focus:border-corp-50 dark:focus:border-corp-50 focus:ring-corp-50 dark:focus:ring-corp-50 rounded-lg shadow-sm"
x-data="multiselectComponent{{ $id }}()" x-init="
selectedString = selected.map(item => item.name);
$watch('selected', value => selectedString = value.map(item => item.name)); init();"
@send.window="selected = send"
>
<input x-model="selectedString" name="{{ $name }}" type="text" id="msa-input2"
    aria-hidden="true" x-bind:aria-expanded="listActive.toString()"
    aria-haspopup="tag-list" hidden>
<div class="input-presentation" @click="listActive = !listActive"
    @click.away="listActive = false" x-bind:class="{ 'active': listActive }">
    <span class="placeholder dark:text-gris-30 dark:text-[12px]" x-show="selected.length == 0">{{ $placeholder }}</span>
    <div id="gallery"
        class="flex flex-wrap gap-[6px] items-center relative cursor-pointer">
        <template x-for="(tag, index) in selected">
            <div class="tag-badge" :data-id="index"
                x-bind:style="`background: ${tag.hex};`">
                <span x-text="tag.name"></span>
                <button type="button" x-bind:data-index="index"
                    @click.stop="removeMe($event)">x</button>
            </div>
        </template>
    </div>
    <div class="text-gris-30 ml-auto ">
    <x-icons.chevron-down />
     </div>
</div>
<ul id="tag-list" x-show.transition="listActive" role="listbox">
    <template x-for="(tag, index, collection) in unselected">
        <li x-show="!selected.includes(tag.name)" x-bind:value="tag.name" class="dark:text-gris-30 dark:text-[12px]"
            x-text="tag.name" aria-role="button" @click.stop="addMe($event)"
            x-bind:data-index="index" role="option"></li>
    </template>
</ul>
</div>

@push('scripts')
    <script>
        function multiselectComponent{{ $id }}() {
            return {
                sortableList:  document.getElementById('gallery'),
                listActive: false,
                selectedString: @json($colorSelect),
                selected: @json($colorSelect),
                unselected: @json($colorUnSelect),
                order: [],
                send: '',
                addMe(e) {
                    const index = e.target.dataset.index;
                    const extracted = this.unselected.splice(index, 1);
                    this.selected.push(extracted[0]);
                },
                removeMe(e) {
                    const index = e.target.dataset.index;
                    const extracted = this.selected.splice(index, 1);
                    this.unselected.push(extracted[0]);
                },
                init(){
                    Sortable.create(this.sortableList, {
                    animation: 150,
                    store:{
                        set: (sortable) => {
                        this.order = sortable.toArray().slice(1);
                            const elementos = this.selected;
                            this.send = this.order.map(index => elementos[index]);
                        }
                    }
                });
                },
            };
        }
    </script>
@endpush

@if($param > '0')
    @push('styles')
    <style>
        .msa-wrapper {


            &:focus-within {
                .input-presentation {
                    border-bottom-right-radius: 0;
                    border-bottom-left-radius: 0;
                }
            }

            &>* {
                display: block;
                width: 100%;
            }

            .input-presentation {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
                align-items: center;
                min-height: 30px;
                padding: 0px 10px;
                border-radius: 10px;
                position: relative;
                cursor: pointer;


                &.active {
                    border-bottom-left-radius: 0;
                    border-bottom-right-radius: 0;
                    border-color: #16AC9F;
                }

                .tag-badge {
                    height: 20px;
                    padding-left: 14px;
                    padding-right: 28px;
                    color: white;
                    border-radius: 14px;
                    position: relative;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    span {
                        font-size: 12px;
                        line-height: 20px;
                    }

                    button {
                        display: inline-block;
                        padding: 0;
                        -webkit-appearance: none;
                        appearance: none;
                        background: transparent;
                        border: none;
                        color: rgba(255, 255, 255, .8);
                        font-size: 12px;
                        position: absolute;
                        right: 0px;
                        padding-right: 10px;
                        padding-left: 5px;
                        cursor: pointer;
                        line-height: 26px;
                        height: 26px;
                        font-weight: 600;

                        &:hover {
                            background-color: rgba(255, 255, 255, .2);
                            color: white;
                        }
                    }
                }
            }

            ul {
                border: 1px solid rgba(0, 0, 0, 0.3);
                font-size: 1rem;
                margin: 0;
                padding: 0;
                border-top: none;
                list-style: none;
                border-bottom-right-radius: 10px;
                border-bottom-left-radius: 10px;

                li {
                    padding: 6px 12px;
                    text-transform: capitalize;
                    cursor: pointer;
              
                    &:hover {
                        background: #292929;
                        color: #D1D1D1;
                    }
                }
            }
        }
    </style>
    @endpush
@endif
