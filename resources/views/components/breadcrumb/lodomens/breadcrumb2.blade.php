@props(['name','href'])
@if (isset($href))
<li>
    <div class="flex items-center">
      <svg class="w-2 h-2 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
      </svg>
      <a href="{{$href}}" wire:navigate class="ml-1 text-sm font-medium text-gris-10 hover:text-blue-600 md:ml-2 dark:text-gris-40 dark:hover:text-white">{{$name}}</a>
    </div>
  </li>
@else
<li aria-current="page">
    <div class="flex items-center">
      <svg class="w-2 h-2 mx-1 text-gris-40" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
      </svg>
      <span class="text-sm font-medium  md:ml-1 dark:text-gris-30">{{$name}}</span>
    </div>
  </li>
@endif




