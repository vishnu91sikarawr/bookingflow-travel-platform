import './bootstrap'

import { createApp } from 'vue'
import SeatSelection from './components/SeatSelection.vue'

const appElement = document.getElementById('app')

const tripId = Number(
    appElement.dataset.tripId || 0
)

const fare = Number(
    appElement.dataset.fare || 0
)

const app = createApp(
    SeatSelection,
    {
        tripId,
        fare
    }
)

app.mount('#app')
