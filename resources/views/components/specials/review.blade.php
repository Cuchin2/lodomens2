 @props(['class'=>''])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<button x-data="{ isHovered: false }"
        @mouseenter="isHovered = true"
        @mouseleave="isHovered = false"
        class="{{ $class }} group relative overflow-hidden px-2 py-1 bg-transparent border-[0.75px] border-gradient text-gray-200 rounded-[1.5px] font-semibold transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg hover:shadow-amber-400/50 animate-jelly">

    <!-- Efecto de brillo -->
    <div class="absolute inset-0 w-1/4 h-full bg-white/10 skew-x-[45deg] group-hover:translate-x-[400%] transition-transform duration-1000"></div>

    <!-- Contenido del botón -->
    <div class="flex items-center space-x-1.5">
        <i class="fas fa-star text-amber-300 text-base animate-shimmer drop-shadow-[0_0_4px_rgba(251,191,36,0.8)] group-hover:text-amber-200"></i>
        <span class="relative animate-shimmer text-xs">
            Dejar Reseña
            <!-- Decoración inferior -->
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-amber-500/50 transform group-hover:w-full transition-all duration-300"></span>
        </span>
        <i class="fas fa-pencil transform group-hover:rotate-12 transition-transform duration-300 text-amber-200 animate-shimmer text-xs"></i>
    </div>
</button>

<style>
@keyframes shimmer {
    0% {
        filter: brightness(1) drop-shadow(0 0 5px rgba(251, 191, 36, 0.5));
    }
    50% {
        filter: brightness(1.5) drop-shadow(0 0 15px rgba(251, 191, 36, 0.8));
    }
    100% {
        filter: brightness(1) drop-shadow(0 0 5px rgba(251, 191, 36, 0.5));
    }
}

@keyframes jelly {
    0%, 100% { transform: scale(1); }
    25% { transform: scale(1.05, 0.95); }
    50% { transform: scale(0.95, 1.05); }
    75% { transform: scale(1.02, 0.98); }
}

.animate-shimmer {
    animation: shimmer 2s infinite;
}

.animate-jelly {
    animation: jelly 2s infinite;
}

.animate-jelly:hover {
    animation: none;
}

.border-gradient {
    border-image: linear-gradient(to right, rgb(180, 83, 9), rgb(113, 63, 18)) 1;
    border-image-slice: 1;
}

button:hover {
    background: linear-gradient(rgba(180, 83, 9, 0.1), rgba(113, 63, 18, 0.1));
}
</style>
