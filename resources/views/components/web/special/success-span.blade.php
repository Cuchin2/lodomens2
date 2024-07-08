

<div x-data="{ open: false, show() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth' // Para un desplazamiento suave
    });
this.open=true; setTimeout(() => { this.open = false; }, 2000); } }" x-show="open"
    :class="!open" x-collapse
    class="mb-[20px]">
    <div
class="items-center flex rounded-lg border border-green-600 bg-green-900 bg-opacity-20 py-2 px-2 text-green-600 sm:px-5 text-[12px]" @success.window="show();"
>
<svg
xmlns="http://www.w3.org/2000/svg"
class="h-5 w-5"
viewBox="0 0 20 20"
fill="currentColor"
>
<path
fill-rule="evenodd"
d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
clip-rule="evenodd"
/>
</svg>
<p class="mx-1 ">Se actualizaron los datos</p>
</div>

</div>


