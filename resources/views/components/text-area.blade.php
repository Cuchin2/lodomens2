@props(['comment'=>'','save'=>'','cancel'=>'','click'=>''])

<div x-data="{ count: 0 }" x-init="count = $refs.countme.value.length">
    <textarea wire:model="{{ $comment }}" type="text"
        class="w-full border-gris-70  mt-2 bg-black text-gris-10  focus:border-gris-50 placeholder-gris-40 focus:ring-gris-50 rounded-lg shadow-sm text-[13px]"
        placeholder="Dejanos un comentario" rows="3" maxlength="225" x-ref="countme"
        x-on:keyup="count = $refs.countme.value.length">{{ $comment }}</textarea>

    <div class="d-inline-flex ml-2">
        <template x-if="count < 20">
            <small id="helpId" class="text-corp-30 font-bold" x-html="count">
                /</small>

        </template>
        <template x-if="count >= 20">
            <small id="helpId" class="font-bold" x-html="count"></small>
        </template> <small id="helpId" class="form-text text-muted" style="margin: auto 5px;">/</small>
        <small id="helpId" class="form-text text-muted" x-html="$refs.countme.maxLength"></small>
        <x-button.webprimary class="w-fit float-right !h-[25px] !text-[14px] mt-1" wire:click="{{ $save }}" @click="{{ $click }}"> Comentar</x-button.webprimary>

        <button type="button" class="btn  gris2  hv-turkey mt-1 float-right br-20" wire:click="{{ $cancel }}" @click="{{ $click }}"
            style="border-radius:8px;font-size:14px; width:90px; order: 2;">Cancelar</button>
    </div>
    </div>
