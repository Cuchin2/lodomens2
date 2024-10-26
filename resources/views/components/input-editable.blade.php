@props(['value','name'])

<div x-data="data()" class="my-2 w-full">
    <a @click.prevent @dblclick="toggleEditingState" x-show="!isEditing" x-text="text" class="select-none cursor-pointer underline text-gris-20 block text-[14px]" ></a>
    <input type="text" x-model="text" name="{{$name}}" x-show="isEditing" @click.away="toggleEditingState" @keydown.enter="disableEditing" @keydown.window.escape="disableEditing" class="w-full  h-[30px] border-gris-70 bg-gris-90 text-gris-30  focus:border-gris-50  focus:ring-gris-50 rounded-md shadow-sm text-[12px]" x-ref="input">
</div>
<script>
    function data() {
    return {
        text: "{{$value}}",
        isEditing: false,
        toggleEditingState() {
            this.isEditing = !this.isEditing;

            if (this.isEditing) {
                this.$nextTick(() => {
                    this.$refs.input.focus();
                });
            }
        },
        disableEditing() {
            this.isEditing = false;
        }
    };
}

</script>
