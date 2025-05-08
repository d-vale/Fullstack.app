<script setup>
import { ref, onMounted, watch } from "vue";
import Header from "../components/Header.vue";
import ChapterDisplay from "../components/ChapterDisplay.vue";
import { useFetchJson } from "../composables/useFetchJson.js";

const userName = ref("");
const userProgress = ref({
    confiance: 65,
    ressources: 100,
    impact: 30,
    crise: 15,
});
const loading = ref(true);
const error = ref(null);
const currentChapter = ref(null);
const choices = ref([]);

onMounted(() => {
    loadUserProgress();
});

function loadUserProgress() {
    const { data: reponse, error } = useFetchJson("/v1/progress");
    watch(reponse, (progress) => {
        if (progress.success && progress.data) {
            userName.value = progress.data.user_name || "Invité";
            userProgress.value = {
                confiance: progress.data.confiance || 65,
                ressources: progress.data.ressources || 100,
                impact: progress.data.impact || 30,
                crise: progress.data.crise || 15,
            };

            if (progress.data.chapter_id == 15) {
                loadEndGame();
                loading.value = false;
            } else if (progress.data.chapter_id) {
                loadChapter(progress.data.chapter_id);
            } else {
                loadFirstChapter();
            }
            loading.value = false;
        } else {
            console.error(error);
            loading.value = true;
        }
    });
}

function loadFirstChapter() {
    const { data: reponse, error } = useFetchJson("/v1/chapters/first");
    watch(reponse, (firstchapter) => {
        if (firstchapter.success && firstchapter.data) {
            currentChapter.value = firstchapter.data;
            loadChoicesForChapter(firstchapter.data.id);
        } else {
            console.error(error);
            loading.value = true;
        }
    });
}

function loadChapter(chapterId) {
    const { data: reponse, error } = useFetchJson(`/v1/chapters/${chapterId}`);
    watch(reponse, (chapter) => {
        if (chapter.success && chapter.data) {
            currentChapter.value = chapter.data;
            loadChoicesForChapter(chapterId);
        } else {
            console.error(error);
            loading.value = true;
        }
    });
}

function loadChoicesForChapter(chapterId) {
    const { data: reponse, error } = useFetchJson(
        `/v1/chapters/${chapterId}/choices`
    );
    watch(reponse, (choiceByChapter) => {
        if (choiceByChapter.success && choiceByChapter.data) {
            choices.value = choiceByChapter.data;
        } else {
            console.error(error);
            loading.value = true;
        }
    });
}

function makeChoice(choice) {
    const { data: reponse, error } = useFetchJson({
        url: "/v1/progress/update",
        method: "PATCH",
        data: {
            choice_id: choice.id,
        },
    });
    watch(reponse, (progressUpdate) => {
        if (progressUpdate.success && progressUpdate.data) {
            userProgress.value = {
                confiance: progressUpdate.data.confiance,
                ressources: progressUpdate.data.ressources,
                impact: progressUpdate.data.impact,
                crise: progressUpdate.data.crise,
            };

            console.log(choice.next_chapter);

            if (progressUpdate.data.chapter_id == 16) {
                loadEndGame();
            } else if (progressUpdate.data.chapter_id) {
                loadChapter(progressUpdate.data.chapter_id);
            }
        } else {
            console.error(error.value);
            loading.value = true;
        }
    });
}

function resetProgress() {
    const { data: reponse, error } = useFetchJson({
        url: "/v1/progress/reset",
        method: "PATCH",
    });

    watch(reponse, (resetStatus) => {
        if (resetStatus.success) {
            userProgress.value = {
                confiance: 65,
                ressources: 100,
                impact: 30,
                crise: 15,
            };
            loadFirstChapter();
            loading.value = false;
        } else {
            console.log(error);
            loading.value = true;
        }
    });
}

function loadEndGame() {
    // 1. Leader visionnaire
    if (
        userProgress.value.confiance >= 75 &&
        userProgress.value.ressources > 20 &&
        userProgress.value.impact < 20 &&
        userProgress.value.crise < 10
    ) {
        loadChapter(16);
    }
    // 2. Gestionnaire efficace
    else if (
        userProgress.value.confiance > 60 &&
        userProgress.value.impact < 35 &&
        userProgress.value.crise < 25
    ) {
        loadChapter(17);
    }
    // 3. Équilibre pragmatique
    else if (
        userProgress.value.confiance >= 40 &&
        userProgress.value.confiance <= 60 &&
        userProgress.value.impact >= 25 &&
        userProgress.value.impact <= 45 &&
        userProgress.value.crise < 40
    ) {
        loadChapter(18);
    }
    // 4. Résolution coûteuse
    else if (
        userProgress.value.confiance >= 30 &&
        userProgress.value.confiance <= 50 &&
        userProgress.value.ressources < 15 &&
        userProgress.value.crise < 50
    ) {
        loadChapter(19);
    }
    // 5. Échec stratégique
    else if (
        userProgress.value.confiance < 30 &&
        userProgress.value.impact > 50 &&
        userProgress.value.crise >= 30 &&
        userProgress.value.crise <= 60
    ) {
        loadChapter(20);
    }
    // 6. Catastrophe nationale
    else if (
        userProgress.value.confiance < 20 &&
        userProgress.value.impact > 60 &&
        userProgress.value.crise > 60
    ) {
        loadChapter(21);
    }
    // Cas par défaut si aucun critère ne correspond
    else {
        // Équilibre pragmatique par défaut (comme indiqué dans votre modèle Progress.php)
        loadChapter(18);
    }
}
</script>

<template>
    <div class="crisis-simulator">
        <Header :userName="userName" :metrics="userProgress" />

        <main class="content">
            <div v-if="loading" class="loading pixel-container">
                <div class="spinner pixel-spinner"></div>
                <p class="pixel-text">CHARGEMENT...</p>
            </div>

            <div v-else-if="error" class="error pixel-container">
                <p class="pixel-text">{{ error }}</p>
                <button @click="loadUserProgress" class="retry-btn pixel-btn">
                    RÉESSAYER
                </button>
            </div>

            <ChapterDisplay
                v-else-if="currentChapter"
                :chapter="currentChapter"
                :choices="choices"
                @choice-selected="makeChoice"
            />

            <div class="reset-container">
                <button @click="resetProgress" class="reset-btn pixel-btn">
                    REDÉMARRER MISSION
                </button>
            </div>
        </main>
    </div>
</template>

<style scoped>
.crisis-simulator {
    max-width: 100%;
    margin: 0 auto;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background-color: #f1f5f9;
}

.content {
    padding: 2rem;
    max-width: 1000px;
    margin: 0 auto;
    width: 100%;
    flex: 1;
}

.loading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.spinner {
    width: 50px;
    height: 50px;
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-radius: 50%;
    border-top-color: var(--primary);
    animation: spin 1s linear infinite;
    margin-bottom: 1rem;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

.loading p {
    font-size: 1.1rem;
    font-weight: 500;
    color: var(--primary);
}

.error {
    text-align: center;
    padding: 2rem;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    color: var(--danger);
}

.reset-container {
    text-align: center;
    margin-top: 2rem;
}

.reset-btn {
    padding: 0.8rem 1.5rem;
    background-color: var(--secondary);
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.reset-btn:hover {
    background-color: var(--danger);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

@media (prefers-color-scheme: dark) {
    .crisis-simulator {
        background-color: #0f172a;
    }

    .loading,
    .error {
        background-color: var(--secondary);
    }

    .loading p {
        color: var(--primary-light);
    }

    .error {
        color: var(--danger);
    }
}

@media (max-width: 768px) {
    .content {
        padding: 1rem;
    }
}
</style>
