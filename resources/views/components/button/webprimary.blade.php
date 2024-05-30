<button {{ $attributes->merge(['class' => 
    'bg-gradient-to-b from-corp-10 via-corp-50 to-corp-80
    
    hover:from-corp-20 hover:via-corp-60 hover:to-corp-90
    active:from-corp-50 active:via-corp-50 active:to-corp-50 
    focus:from-corp-30 focus:via-corp-70 focus:to-corp-90
     
    text-gris-10 rounded-[3px] px-4 font-bold h-[36px]']) }}>
    {{ $slot }}
</button>