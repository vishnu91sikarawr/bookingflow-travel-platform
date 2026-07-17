<template>
    <div class="alert alert-success">
        <h3>✅ Vue is Working!</h3>

        <p>Trip ID: {{ tripId }}</p>

        <p>Fare: ₹{{ fare }}</p>
    </div>
</template>

<script setup>
defineProps({
    tripId: Number,
    fare: Number,
});
</script>
