import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import SeatSelection from './components/SeatSelection.vue';

window.Alpine = Alpine;

Alpine.start();

const appElement = document.getElementById('app');

if (appElement) {
    createApp(SeatSelection, {
        tripId: Number(appElement.dataset.tripId),
        fare: Number(appElement.dataset.fare),
    }).mount('#app');
}
