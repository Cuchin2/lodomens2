<div x-data="{ hovering: false }"
@mouseenter="hovering = true"
@mouseleave="hovering = false"
class="cursor-pointer transition-transform duration-300 flex justify-center"
:class="{ 'scale-110': hovering }">

<svg class="w-20 h-20 modern-glow"
  viewBox="0 0 24 24"
  fill="none">
<path d="M12 10V15"
     class="stroke-yellow-400 stroke-[1.5]"
     stroke-linecap="round"/>
<circle cx="12" cy="17" r="0.75"
       class="fill-yellow-400"/>

<g class="opacity-90">
 <path d="M12 2C12 2 21 19 21 21H3C3 19 12 2 12 2Z"
       class="stroke-yellow-400 stroke-2"
       stroke-linejoin="round"
       stroke-linecap="round">
   <animate attributeName="opacity"
            values="0.3;1;0.3"
            dur="2s"
            repeatCount="indefinite"/>
 </path>
</g>
</svg>
</div>

<style>
    @keyframes modernGlow {
      0%, 100% {
        filter: drop-shadow(0 0 20px #eab308) drop-shadow(0 0 30px #8b5cf6);
        transform: scale(1) rotate(0deg);
      }
      50% {
        filter: drop-shadow(0 0 30px #8b5cf6) drop-shadow(0 0 40px #facc15);
        transform: scale(1.05) rotate(2deg);
      }
    }

    .modern-glow {
      animation: modernGlow 3s ease-in-out infinite;
    }
  </style>
