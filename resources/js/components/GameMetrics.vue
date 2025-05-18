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
const ressources = computed(() => `${props.metrics.ressources}%`);
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
    gap: 1rem;
    padding: 1.5rem;
    background-color: var(--secondary);
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 350px;
}

.metric {
    display: flex;
    align-items: center;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
}

.metric-label {
    width: 160px;
    font-weight: 600;
    color: var(--text-light);
}

.progress-container {
    position: relative;
    width: 150px;
    height: 26px;
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    border-radius: 4px;
    transition: width 0.3s ease;
}

.progress-bar:nth-child(1) {
    background-color: var(--success);
}

.progress-bar:nth-child(2) {
    background-color: var(--primary-light);
}

.progress-bar:nth-child(3) {
    background-color: var(--warning);
}

.progress-bar.danger {
    background-color: var(--danger);
}

.progress-text {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.9rem;
    font-weight: 600;
    color: white;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

@media (max-width: 768px) {
    .metrics {
        max-width: 100%;
        padding: 1rem;
    }

    .metric {
        font-size: 0.9rem;
    }

    .metric-label {
        width: 140px;
    }
}
</style>
