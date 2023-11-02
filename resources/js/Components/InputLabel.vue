<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="label">
        <span class="label-text" v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
