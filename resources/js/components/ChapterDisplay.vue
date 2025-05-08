<script setup>
import { ref } from "vue";

const props = defineProps({
    chapter: {
        type: Object,
        required: true,
    },
    choices: {
        type: Array,
        default: () => [],
    },
});

const emit = defineEmits(["choice-selected"]);

function selectChoice(choice) {
    emit("choice-selected", choice);
}
</script>

<template>
    <div class="chapter">
        <div class="chapter-content" v-html="chapter.text"></div>

        <div class="choices" v-if="choices.length > 0">
            <h3 class="choices-title">VOTRE DÉCISION</h3>
            <div
                v-for="choice in choices"
                :key="choice.id"
                class="choice"
                @click="selectChoice(choice)"
            >
                {{ choice.text }}
            </div>
        </div>
    </div>
</template>

<style scoped>
.chapter {
    background-color: white;
    border-radius: 8px;
    padding: 2rem;
    margin-top: 2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.chapter-content {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2.5rem;
    white-space: pre-line;
    color: var(--text-dark);
}

.choices {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.choices-title {
    color: var(--primary);
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1.2rem;
    border-bottom: 2px solid var(--primary-light);
    padding-bottom: 0.5rem;
    display: inline-block;
}

.choice {
    padding: 1.2rem;
    background-color: var(--bg-light);
    border: 1px solid var(--border-color);
    border-radius: 6px;
    color: var(--text-dark);
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.choice:hover {
    background-color: var(--primary-light);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

@media (prefers-color-scheme: dark) {
    .chapter {
        background-color: var(--secondary);
    }

    .chapter-content {
        color: var(--text-light);
    }

    .choice {
        background-color: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        color: var(--text-light);
    }
}

@media (max-width: 768px) {
    .chapter {
        padding: 1.5rem;
        margin-top: 1rem;
    }

    .chapter-content {
        font-size: 1rem;
    }
}
</style>
