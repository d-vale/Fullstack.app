<script setup>

import {useFetchJson} from '@/composables/useFetchJson';

const {data: schedule, error, loading, abort} = useFetchJson("/api/v1/pogress");


console.log(schedule);
console.log(error);
</script>

<template>
    <h1>Je suis bien dans la page start.vue</h1>
</template>

<style scoped></style>
