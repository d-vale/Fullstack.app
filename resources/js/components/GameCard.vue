<script setup>
const props = defineProps({
    game: {
        type: Object,
        required: true,
    },
});

const emit = defineEmits(["start-game"]);

function handleStartGame() {
    emit("start-game", props.game.id);
}
</script>

<template>
    <div class="game-card" :class="{ disabled: !game.available }">
        <div class="game-image">
            <img
                :src="game.image"
                :alt="game.title"
                class="game-image-content"
            />
        </div>
        <div class="game-info">
            <h3>{{ game.title }}</h3>
            <p>{{ game.description }}</p>
            <button
                @click="handleStartGame"
                class="start-btn"
                :disabled="!game.available"
            >
                {{ game.available ? "DÉMARRER" : "BIENTÔT DISPONIBLE" }}
            </button>
        </div>
    </div>
</template>

<style scoped>
/* Game cards */
.game-card {
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.game-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.game-card.disabled {
    opacity: 0.6;
    filter: grayscale(40%);
}

.game-image {
    height: 160px;
    background-color: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.game-image-content {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.game-info {
    padding: 1.5rem;
}

.game-info h3 {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    color: var(--secondary);
}

.game-info p {
    font-size: 0.9rem;
    color: var(--text-dark);
    opacity: 0.8;
    margin-bottom: 1.2rem;
}

.start-btn {
    width: 100%;
    padding: 0.75rem;
    background-color: var(--primary);
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.start-btn:hover:not(:disabled) {
    background-color: var(--primary-light);
}

.start-btn:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

/* Dark mode */
@media (prefers-color-scheme: dark) {
    .game-card {
        background-color: #1a202c;
    }

    .game-info h3 {
        color: var(--text-light);
    }

    .game-info p {
        color: var(--text-light);
        opacity: 0.7;
    }
}
</style>
