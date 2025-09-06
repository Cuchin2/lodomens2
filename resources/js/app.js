import './bootstrap';
import Scroll from '@alpine-collective/toolkit-scroll'
import sort from '@alpinejs/sort'
Alpine.plugin(Scroll)
Alpine.plugin(sort)
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
// Inicializa el mapa en un elemento del DOM (ejemplo: un div con id 'mi_mapa')

// Ejecuta la inicialización del mapa cuando el DOM esté cargado
document.addEventListener('DOMContentLoaded', initializeMap);

// Escucha el evento de Livewire para re-inicializar el mapa
document.addEventListener('livewire:load', function() {
    document.addEventListener('livewire:navigate', initializeMap);
});
