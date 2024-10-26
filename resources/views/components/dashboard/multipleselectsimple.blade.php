@props(['id'=>'','selected'=>'','unselected'=>'','param'=>'1','placeholder'=>'','name'=>''])
<div class="msa-wrapper border-gris-70 border-[1px]  bg-gris-90 text-gray-300 w-full focus:border-corp-50  rounded-lg shadow-sm"
x-data="multiselectComponent{{ $id }}()"
x-init="$watch('selected', value => selectedString = value.join(','))">

<input x-model="selectedString" name="{{ $name }}" type="text" id="msa-input"
    aria-hidden="true" x-bind:aria-expanded="listActive.toString()"
    aria-haspopup="tag-list" hidden>
<div class="input-presentation" @click="listActive = !listActive"
    @click.away="listActive = false" x-bind:class="{ 'active': listActive }">
    <span class="placeholder text-gris-30 text-[12px]" x-show="selected.length == 0">{{ $placeholder }}</span>
    <template x-for="(tag, index) in selected">
        <div class="tag-badge bg-gris-60">
            <span x-text="tag"></span>
            <button type="button" x-bind:data-index="index"
                @click.stop="removeMe($event)">x</button>
        </div>
    </template>
    <div class="text-gris-30 ml-auto ">
        <x-icons.chevron-down />
         </div>
</div>
<ul id="tag-list" x-show.transition="listActive" role="listbox">
    <template x-for="(tag, index, collection) in unselected">
        <li x-show="!selected.includes(tag)" x-bind:value="tag" x-text="tag" class="text-gris-30 text-[12px]"
            aria-role="button" @click.stop="addMe($event)" x-bind:data-index="index"
            role="option"></li>
    </template>
</ul>
</div>
@push('scripts')
    <script>
        function multiselectComponent{{$id}}() {

            return {
                listActive: false,
                selectedString: @json($selected),
                selected: @json($selected),
                unselected: @json($unselected),
                addMe(e) {
                    const index = e.target.dataset.index;
                    const extracted = this.unselected.splice(index, 1);
                    this.selected.push(extracted[0]);
                },
                removeMe(e) {
                    const index = e.target.dataset.index;
                    const extracted = this.selected.splice(index, 1);
                    this.unselected.push(extracted[0]);
                }

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
                        background: #16AC9F;
                        color: white;
                    }
                }
            }
        }
    </style>
    @endpush
@endif
