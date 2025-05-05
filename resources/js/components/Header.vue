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
    padding: 1rem;
    background-color: #1d2b53;
    position: sticky;
    top: 0;
    z-index: 100;
}

.pixel-border {
    box-shadow: 0 4px 0 #ff004d;
    image-rendering: pixelated;
    image-rendering: crisp-edges;
}

.page-title {
    flex: 2;
    text-align: center;
}

.pixel-text {
    margin: 0;
    font-family: "VT323", monospace;
    font-size: 2.2rem; /* Taille augmentée */
    color: #faef5d;
    text-shadow: 3px 3px 0 #7e2553;
    letter-spacing: 1px; /* Meilleur espacement avec cette police */
}

.actions {
    flex: 1;
    display: flex;
    justify-content: flex-end;
}

.pixel-btn {
    padding: 0.8rem 1rem;
    background-color: #ff004d;
    color: white;
    border: none;
    font-family: "VT323", monospace;
    font-size: 1.1rem; /* Taille augmentée */
    box-shadow: 0 4px 0 #7e2553;
    cursor: pointer;
    transform: translateY(-2px);
    transition: all 0.1s steps(2);
}

.pixel-btn:hover {
    transform: translateY(0);
    box-shadow: 0 2px 0 #7e2553;
}

.pixel-btn:active {
    transform: translateY(2px);
    box-shadow: 0 0 0 #7e2553;
}

@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        padding: 0.5rem;
    }

    .page-title {
        margin: 0.8rem 0;
    }

    .pixel-text {
        font-size: 1.8rem;
    }

    .actions {
        width: 100%;
        justify-content: center;
        margin-top: 0.8rem;
    }
}
</style>
