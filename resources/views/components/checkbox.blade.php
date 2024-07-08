{{-- <input type="checkbox" {!! $attributes->merge(['class' => 'rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800']) !!}>
--}}
@props(['name'=>'','id'=>'','value'=>'','rule'=>false, 'onchange'=>''])

<input class="hidden" type="checkbox" name="{{$name}}" value="{{ $value }}" id="{{$id}}" {{ $rule ? 'checked' : '' }} onchange="{{$onchange}}" {{ $attributes }}>
<label class="flex text-[12px] relative mb-[5px]" for="{{$id}}">
<span class="pan" x-cloak></span>
{{ $slot }}
</label>
