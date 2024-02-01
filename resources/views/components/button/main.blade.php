@props(['buttonType'=>'submit'])
<button {{ $attributes->merge(['type' => $buttonType, 'class' => 'p-[3px] h-[32px] mx-auto bg-gradient-to-b cursor-pointer from-corp-20 via-corp-50 to-corp-90 text-white px-4 rounded']) }}>
    {{ $slot }}
</button>
