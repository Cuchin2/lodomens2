@props(['value','name'])

<div x-data="data()" class="my-2 w-full">
    <a @click.prevent @dblclick="toggleEditingState" x-show="!isEditing" x-text="text" class="select-none cursor-pointer underline text-corp-30 block font-bold text-sm" ></a>
    <input type="text" x-model="text" name="{{$name}}" x-show="isEditing" @click.away="toggleEditingState" @keydown.enter="disableEditing" @keydown.window.escape="disableEditing" class="w-full border-gray-300 h-[30px] dark:border-gray-700 dark:bg-gris-90 dark:text-gris-30 focus:border-cop-50 dark:focus:border-corp-70 focus:ring-corp-50 dark:focus:ring-corp-70 rounded-md shadow-sm text-[12px]" x-ref="input">
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
