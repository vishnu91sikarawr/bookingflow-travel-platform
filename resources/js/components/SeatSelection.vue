<template>
    <div class="row">

        <!-- Seat Layout -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-4">
                        Select Your Seat
                    </h5>

                    <!-- Driver -->
                    <div class="text-end mb-4">
                        <span class="badge bg-secondary px-3 py-2">
                            Driver
                        </span>
                    </div>

                    <!-- Seats -->
                    <div class="seat-layout">

                        <button
                            v-for="seat in seats"
                            :key="seat.number"
                            type="button"
                            class="seat"
                            :class="{
                                'seat-selected': selectedSeats.includes(seat.number),
                                'seat-booked': seat.booked
                            }"
                            :disabled="seat.booked"
                            @click="toggleSeat(seat)"
                        >
                            {{ seat.number }}
                        </button>

                    </div>

                    <!-- Legend -->
                    <div class="seat-legend mt-4">

                        <div>
                            <span class="legend-box available"></span>
                            Available
                        </div>

                        <div>
                            <span class="legend-box selected"></span>
                            Selected
                        </div>

                        <div>
                            <span class="legend-box booked"></span>
                            Booked
                        </div>

                    </div>

                </div>

            </div>
        </div>


        <!-- Booking Summary -->
        <div class="col-lg-4 mt-4 mt-lg-0">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-4">
                        Booking Summary
                    </h5>

                    <!-- Trip -->
                    <div class="d-flex justify-content-between mb-2">
                        <span>Trip ID</span>

                        <strong>
                            {{ tripId }}
                        </strong>
                    </div>

                    <!-- Fare -->
                    <div class="d-flex justify-content-between mb-3">
                        <span>Fare / Seat</span>

                        <strong>
                            ₹{{ fare }}
                        </strong>
                    </div>

                    <hr>

                    <!-- Selected Seats -->
                    <div class="mb-3">

                        <div class="fw-semibold mb-2">
                            Selected Seats
                        </div>

                        <div v-if="selectedSeats.length">

                            <span
                                v-for="seat in selectedSeats"
                                :key="seat"
                                class="badge bg-primary me-1 mb-1"
                            >
                                {{ seat }}
                            </span>

                        </div>

                        <div
                            v-else
                            class="text-muted"
                        >
                            No seat selected
                        </div>

                    </div>

                    <hr>

                    <!-- Total Seats -->
                    <div class="d-flex justify-content-between mb-2">

                        <span>
                            Total Seats
                        </span>

                        <strong>
                            {{ selectedSeats.length }}
                        </strong>

                    </div>

                    <!-- Total Fare -->
                    <div class="d-flex justify-content-between fs-5">

                        <span>
                            Total Fare
                        </span>

                        <strong class="text-primary">
                            ₹{{ totalFare }}
                        </strong>

                    </div>

                    <!-- Continue -->
                   <button
    type="button"
    class="btn btn-primary w-100 mt-4"
    @click="continueBooking"
>
    Continue
</button>

                </div>

            </div>

        </div>

    </div>
</template>


<script setup>


import { ref, computed, onMounted } from 'vue'

/*
|--------------------------------------------------------------------------
| Props
|--------------------------------------------------------------------------
|
| tripId and fare are passed from app.js
|
*/

const props = defineProps({

    tripId: {
        type: Number,
        required: true
    },

    fare: {
        type: Number,
        required: true
    }

})


/*
|--------------------------------------------------------------------------
| Seat Data
|--------------------------------------------------------------------------
|
| Temporary hard-coded data.
|
| Later this will come from Laravel API/database.
|
*/

const seats = ref([

    {
        number: 'A1',
        booked: false
    },

    {
        number: 'A2',
        booked: false
    },

    {
        number: 'A3',
        booked: false
    },

    {
        number: 'A4',
        booked: false
    },


    {
        number: 'B1',
        booked: false
    },

    {
        number: 'B2',
        booked: false
    },

    {
        number: 'B3',
        booked: false
    },

    {
        number: 'B4',
        booked: true
    },


    {
        number: 'C1',
        booked: false
    },

    {
        number: 'C2',
        booked: true
    },

    {
        number: 'C3',
        booked: false
    },

    {
        number: 'C4',
        booked: false
    },


    {
        number: 'D1',
        booked: false
    },

    {
        number: 'D2',
        booked: false
    },

    {
        number: 'D3',
        booked: false
    },

    {
        number: 'D4',
        booked: false
    },


    {
        number: 'E1',
        booked: false
    },

    {
        number: 'E2',
        booked: false
    },

    {
        number: 'E3',
        booked: false
    },

    {
        number: 'E4',
        booked: false
    }

])


onMounted(async () => {

    const response = await fetch(
        `/api/trips/${props.tripId}/booked-seats`
    );

    const bookedSeats = await response.json();

    seats.value.forEach(seat => {
        seat.booked = bookedSeats.includes(seat.number);
    });

});
/*
|--------------------------------------------------------------------------
| Selected Seats
|--------------------------------------------------------------------------
*/

const selectedSeats = ref([])


/*
|--------------------------------------------------------------------------
| Total Fare
|--------------------------------------------------------------------------
*/

const totalFare = computed(() => {

    return selectedSeats.value.length * props.fare

})


/*
|--------------------------------------------------------------------------
| Select / Unselect Seat
|--------------------------------------------------------------------------
*/

function toggleSeat(seat) {

    // Don't allow booked seats
    if (seat.booked) {
        return
    }


    const index = selectedSeats.value.indexOf(
        seat.number
    )


    // Select seat
    if (index === -1) {

        selectedSeats.value.push(
            seat.number
        )

    }

    // Unselect seat
    else {

        selectedSeats.value.splice(
            index,
            1
        )

    }

}

async function continueBooking() {

    if (selectedSeats.value.length === 0) {
        alert('Please select at least one seat.');
        return;
    }

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/passenger-details';

    // CSRF
    const token = document.querySelector('meta[name="csrf-token"]').content;

    const csrf = document.createElement('input');
    csrf.type = 'hidden';
    csrf.name = '_token';
    csrf.value = token;
    form.appendChild(csrf);

    // Trip
    const trip = document.createElement('input');
    trip.type = 'hidden';
    trip.name = 'trip_id';
    trip.value = props.tripId;
    form.appendChild(trip);

    // Seats
    selectedSeats.value.forEach(seat => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'seats[]';
        input.value = seat;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

</script>


<style scoped>

.seat-layout {

    display: grid;

    grid-template-columns: repeat(4, 65px);

    gap: 15px;

    max-width: 300px;

    margin: 0 auto;

}


.seat {

    width: 65px;

    height: 55px;

    border: 2px solid #198754;

    border-radius: 10px;

    background: #fff;

    font-weight: 600;

    cursor: pointer;

    transition: 0.2s;

}


.seat:hover:not(:disabled) {

    transform: translateY(-2px);

}


.seat-selected {

    background: #0d6efd;

    border-color: #0d6efd;

    color: #fff;

}


.seat-booked {

    background: #6c757d;

    border-color: #6c757d;

    color: #fff;

    cursor: not-allowed;

    opacity: 0.7;

}


.seat-legend {

    display: flex;

    justify-content: center;

    gap: 25px;

    flex-wrap: wrap;

}


.legend-box {

    display: inline-block;

    width: 18px;

    height: 18px;

    border-radius: 4px;

    margin-right: 5px;

    vertical-align: middle;

}


.legend-box.available {

    border: 2px solid #198754;

    background: #fff;

}


.legend-box.selected {

    background: #0d6efd;

}


.legend-box.booked {

    background: #6c757d;

}

</style>
