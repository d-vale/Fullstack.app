<script setup>
import Start from "./pages/Start.vue";
</script>

<template>
    <Start />
</template>

<style>
/* Police pixelisée avec support des accents */
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap");

:root {
    --primary: #1e40af;
    --primary-light: #3b82f6;
    --secondary: #0f172a;
    --accent: #f97316;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --bg-dark: #0f172a;
    --bg-light: #f8fafc;
    --text-light: #f8fafc;
    --text-dark: #1e293b;
    --border-color: #e2e8f0;
}

body {
    margin: 0;
    padding: 0;
    background-color: var(--bg-light);
    font-family: "Inter", sans-serif;
    font-size: 16px;
    color: var(--text-dark);
    line-height: 1.5;
    overflow-x: hidden;
}

* {
    box-sizing: border-box;
}

@media (prefers-color-scheme: dark) {
    body {
        background-color: var(--bg-dark);
        color: var(--text-light);
    }
}
</style>
