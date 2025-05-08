<script setup>
import GameMetrics from "./GameMetrics.vue";

const props = defineProps({
    userName: {
        type: String,
        required: true,
        default: "Invité",
    },
    metrics: {
        type: Object,
        required: true,
        default: () => ({
            confiance: 65,
            ressources: 100,
            impact: 30,
            crise: 15,
        }),
    },
});

function logout() {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");

    fetch("/logout", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
            Accept: "application/json",
        },
    })
        .then(() => {
            window.location.href = "/login";
        })
        .catch((error) => {
            console.error("Erreur de déconnexion:", error);
        });
}
</script>

<template>
    <header class="navbar pixel-border">
        <GameMetrics :metrics="metrics" />

        <div class="page-title">
            <h1 class="pixel-text">PRÉSIDENT {{ userName }}</h1>
        </div>

        <div class="actions">
            <button @click="logout" class="logout-btn pixel-btn">
                DÉCONNEXION
            </button>
        </div>
    </header>
</template>

<style scoped>
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1rem;
    background-color: var(--primary);
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.page-title {
    flex: 2;
    text-align: center;
}

.page-title h1 {
    margin: 0;
    font-weight: 700;
    font-size: 1.8rem;
    color: white;
    text-transform: uppercase;
    letter-spacing: 1px;
    background-color: rgba(255, 255, 255, 0.1);
    padding: 0.5rem 1.5rem;
    border-radius: 4px;
    display: inline-block;
}

.actions {
    flex: 1;
    display: flex;
    justify-content: flex-end;
}

.logout-btn {
    padding: 0.7rem 1.5rem;
    background-color: rgba(255, 255, 255, 0.15);
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.logout-btn:hover {
    background-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        padding: 1rem;
    }

    .page-title {
        margin: 0.8rem 0;
    }

    .page-title h1 {
        font-size: 1.4rem;
        padding: 0.4rem 1rem;
    }

    .actions {
        width: 100%;
        justify-content: center;
        margin-top: 0.5rem;
    }
}
</style>
