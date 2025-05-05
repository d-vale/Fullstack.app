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
    <div class="chapter pixel-container">
        <div class="chapter-content pixel-text" v-html="chapter.text"></div>

        <div class="choices" v-if="choices.length > 0">
            <h3 class="choices-title">VOTRE DÉCISION :</h3>
            <div
                v-for="choice in choices"
                :key="choice.id"
                class="choice pixel-btn"
                @click="selectChoice(choice)"
            >
                {{ choice.text }}
            </div>
        </div>
    </div>
</template>

<style scoped>
.chapter {
    background-color: #1d2b53;
    border-radius: 0;
    padding: 2rem;
    margin-top: 2rem;
}

.pixel-container {
    box-shadow: 0 0 0 4px #ff004d, 0 0 0 8px #ffa300;
    image-rendering: pixelated;
    image-rendering: crisp-edges;
}

.chapter-content {
    font-size: 20px; /* Taille augmentée */
    line-height: 1.5;
    margin-bottom: 2rem;
    white-space: pre-line;
    color: #faef5d;
}

.pixel-text {
    font-family: "VT323", monospace;
    text-shadow: 2px 2px 0 #000;
}

.choices {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.choices-title {
    color: #29adff;
    font-size: 24px; /* Taille augmentée */
    margin-bottom: 1rem;
    text-shadow: 2px 2px 0 #000;
    font-family: "VT323", monospace;
}

.choice {
    padding: 1rem;
    background-color: #7e2553;
    border: 4px solid #ff77a8;
    color: white;
    font-family: "VT323", monospace;
    font-size: 18px; /* Taille augmentée */
    cursor: pointer;
    transition: all 0.2s steps(2);
    text-shadow: 1px 1px 0 #000;
}

.choice:hover {
    background-color: #ff77a8;
    transform: translateY(-4px);
    box-shadow: 4px 4px 0 #000;
}

.choice:active {
    transform: translateY(0);
    box-shadow: 0 0 0 #000;
}
</style>
