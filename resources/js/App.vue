<script setup>
import Start from "./pages/Start.vue";
</script>

<template>
    <Start />
</template>

<style>
/* Police pixelisée avec support des accents */
@import url("https://fonts.googleapis.com/css2?family=VT323&display=swap");

:root {
    --dark-blue: #1d2b53;
    --purple: #7e2553;
    --green: #00e436;
    --red: #ff004d;
    --orange: #ffa300;
    --blue: #29adff;
    --yellow: #faef5d;
    --pink: #ff77a8;
}

body {
    margin: 0;
    padding: 0;
    background-color: #222034;
    font-family: "VT323", monospace;
    font-size: 20px; /* Taille de base augmentée */
    color: var(--yellow);
    image-rendering: pixelated;
    image-rendering: crisp-edges;
    overflow-x: hidden;

    /* Effet de pixelisation du fond */
    background-image: linear-gradient(
            to right,
            rgba(0, 0, 0, 0.05) 1px,
            transparent 1px
        ),
        linear-gradient(to bottom, rgba(0, 0, 0, 0.05) 1px, transparent 1px);
    background-size: 8px 8px;
}

* {
    box-sizing: border-box;
}
</style>
