<script setup></script>

<template>
    <footer class="app-footer">
        <p>© 2025 Crisis Management Simulator | Tous droits réservés</p>
    </footer>
</template>

<style scoped>
.app-footer {
    padding: 1.5rem;
    text-align: center;
    background-color: var(--bg-light);
    color: var(--text-dark);
    font-size: 0.9rem;
}

@media (prefers-color-scheme: dark) {
    .app-footer {
        background-color: var(--secondary);
        color: var(--text-light);
    }
}
</style>
