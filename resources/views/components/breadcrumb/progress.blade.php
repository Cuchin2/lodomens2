@props(['id' => ''])
@php
$currentStep = '';
if (request()->routeIs('web.shop.checkout.index')) {
    $currentStep = 'index';
} elseif (request()->routeIs('web.shop.checkout.shipping')) {
    $currentStep = 'shipping';
} elseif (request()->routeIs('web.shop.checkout.pay')) {
    $currentStep = 'pay';
} elseif (request()->routeIs('web.shop.gracias')) {
    $currentStep = 'gracias';
}

$steps = [
    'index' => [
        'title' => 'Facturación',
        'route' => 'web.shop.checkout.index',
        'number' => 1,
        'params' => []
    ],
    'shipping' => [
        'title' => 'Envíos',
        'route' => 'web.shop.checkout.shipping',
        'number' => 2,
        'params' => ['id' => $id]
    ],
    'pay' => [
        'title' => 'Pagos',
        'route' => 'web.shop.checkout.pay',
        'number' => 3,
        'params' => ['id' => $id]
    ],
    'gracias' => [
        'title' => 'Confirmación',
        'route' => 'web.shop.gracias',
        'number' => 4,
        'params' => []
    ],
];
@endphp

<div class="fixed w-full z-40">
    <div class="bg-gris-90 py-[3px] border-b-[1px] border-gris-80 text-gris-10 md:py-[10px] text-center h-[60px] items-center flex">
        <div class="h-[22px] md:h-[25.19px] mx-auto items-center flex">
            <nav class="flex px-9 mt-[4px] md:mt-[8px] dark:border-gris-70 font-normal text-[12px]" aria-label="Breadcrumb">
                <ol class="mx-auto">
                    <div class="w-full mx-auto flex space-x-3">
                        @foreach($steps as $step => $data)
                            @php
                                $isActive = $currentStep == $step;
                                $isClickable = array_search($currentStep, array_keys($steps)) >= array_search($step, array_keys($steps));
                                $isFutureStep = array_search($currentStep, array_keys($steps)) < array_search($step, array_keys($steps));
                                $route = route($data['route'], $data['params'] ?? []);
                                $linkClass = $isClickable ? '' : 'cursor-not-allowed';
                                $numberHoverClass = $isClickable ? 'hover:bg-gris-10 hover:text-gris-90' : '';
                                $numberCursorClass = $isFutureStep ? 'cursor-not-allowed' : '';
                            @endphp

                            <a href="{{ $isClickable ? $route : '#' }}" class="rounded-full h-5 w-5 {{ $isActive ? 'bg-gris-10 text-gris-90' : 'text-gris-30 bg-gris-70' }} text-center text-[14px] font-bold flex items-center justify-center {{ $numberHoverClass }} {{ $numberCursorClass }}" @if($isClickable && request()->routeIs('mweb.shop.checkout.pay')) @click="$dispatch('heart')" @endif>
                                {{ $data['number'] }}
                            </a>
                            <a href="{{ $isClickable ? $route : '#' }}" class="{{ $isActive ? 'text-gris-10' : 'text-gris-40' }} {{ $linkClass }}" @if($isClickable && request()->routeIs('web.shop.checkout.pay')) @click="$dispatch('heart')" @endif>
                                {{ $data['title'] }}
                            </a>
                        @endforeach
                    </div>
                </ol>
            </nav>
        </div>
    </div>
</div>
