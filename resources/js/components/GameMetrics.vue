<script setup>
import { computed } from "vue";

const props = defineProps({
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

const confiance = computed(() => `${props.metrics.confiance}%`);
const impact = computed(() => `${props.metrics.impact}%`);
const crise = computed(() => `${props.metrics.crise}%`);
const ressources = computed(() => {
    const percentage = Math.min(props.metrics.ressources, 100);
    return `${percentage}%`;
});
</script>

<template>
    <div class="metrics pixel-border">
        <div class="metric">
            <span class="metric-label">Confiance publique :</span>
            <div class="progress-container">
                <div
                    class="progress-bar pixel-effect"
                    :style="{ width: confiance, backgroundColor: '#00E436' }"
                ></div>
                <span class="progress-text">{{ metrics.confiance }}%</span>
            </div>
        </div>

        <div class="metric">
            <span class="metric-label">Ressources :</span>
            <div class="progress-container">
                <div
                    class="progress-bar pixel-effect"
                    :style="{ width: ressources, backgroundColor: '#FFA300' }"
                ></div>
                <span class="progress-text">{{ metrics.ressources }}</span>
            </div>
        </div>

        <div class="metric">
            <span class="metric-label">Impact social :</span>
            <div class="progress-container">
                <div
                    class="progress-bar pixel-effect"
                    :style="{ width: impact, backgroundColor: '#29ADFF' }"
                ></div>
                <span class="progress-text">{{ metrics.impact }}%</span>
            </div>
        </div>

        <div class="metric">
            <span class="metric-label">Progression crise :</span>
            <div class="progress-container">
                <div
                    class="progress-bar pixel-effect danger"
                    :style="{ width: crise }"
                ></div>
                <span class="progress-text">{{ metrics.crise }}%</span>
            </div>
        </div>
    </div>
</template>

<style scoped>
.metrics {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
    flex: 1;
    max-width: 320px;
    background-color: #1d2b53;
    padding: 1rem;
    font-family: "VT323", monospace;
}

.pixel-border {
    box-shadow: 0 0 0 4px #ff004d, 0 0 0 8px #ffa300;
    image-rendering: pixelated;
    image-rendering: crisp-edges;
}

.pixel-effect::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: repeating-linear-gradient(
        to right,
        rgba(255, 255, 255, 0.1),
        rgba(255, 255, 255, 0.1) 2px,
        transparent 2px,
        transparent 4px
    );
}

.metric {
    display: flex;
    align-items: center;
    font-size: 18px; /* Taille augmentée */
    color: #faef5d;
}

.metric-label {
    width: 180px; /* Largeur augmentée */
    font-weight: bold;
    text-shadow: 2px 2px 0 #000;
}

.progress-container {
    position: relative;
    width: 150px;
    height: 24px; /* Hauteur augmentée */
    background-color: #7e2553;
    border: 2px solid #ff77a8;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background-color: #00e436;
    transition: width 0.3s steps(5);
}

.progress-bar.danger {
    background-color: #ff004d;
}

.progress-text {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px; /* Taille augmentée */
    font-weight: bold;
    color: #fff;
    text-shadow: 1px 1px 0 #000;
}

@media (max-width: 768px) {
    .metrics {
        max-width: 100%;
        width: 100%;
    }

    .metric {
        font-size: 16px;
    }
}
</style>
