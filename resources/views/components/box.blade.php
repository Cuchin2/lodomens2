@props(['title'=>'','href'=>''])

<div  class="bg-gris-90 lg:w-[658px] rounded px-4 py-2 md:px-8 md:py-5 mx-auto br-10 relative border-gris-70 border-[1px]"
>
<a href="{{$href}}"
    class=" absolute h-6 w-6 cursor-pointer bg-corp-50"
    style="top:12px; right:12px">
    <x-icons.cross grosor="1" class="w-3 h-3 mx-auto mt-[6.4px] cursor-pointer"
        fill="white" />
</a>
<h1 class="font-bold mb-[19px] w-fit mx-auto" style="font-size: 22px">{{$title}}</h1>
<div class="modal-body">

    {{$slot}} 
  
</div>

</div>