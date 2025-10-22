import './bootstrap';
import { initCustomCursor } from './cursor'; // TAMBAHKAN INI

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Inisialisasi custom cursor setelah DOM loaded - TAMBAHKAN INI
document.addEventListener('DOMContentLoaded', () => {
    initCustomCursor();
});