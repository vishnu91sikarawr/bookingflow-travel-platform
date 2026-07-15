<template>
    <div class="card mt-3">
        <div class="card-body">
            <h3>🚍 BookingFlow Vue is Working!</h3>

            <p>Welcome to Vue 3 + Laravel 12.</p>

            <button
                class="btn btn-primary"
                @click="count++"
            >
                Clicked {{ count }} times
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const count = ref(0);
</script>