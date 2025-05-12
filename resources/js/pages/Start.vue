<script setup>
import { ref, onMounted, watch } from "vue";
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
import ChapterDisplay from "../components/ChapterDisplay.vue";
import { useFetchJson } from "../composables/useFetchJson.js";

// Définition des émetteurs d'événements pour communiquer avec le parent
const emit = defineEmits(["return-to-dashboard"]);
// Définition des props pour recevoir les données de l'utilisateur
const props = defineProps({
    userData: {
        type: Object,
        default: () => ({})
    }
});

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
    // Utiliser les données utilisateur reçues du parent
    if (props.userData && props.userData.name) {
        userName.value = props.userData.name;
    }
    loadUserProgress();
});

function loadUserProgress() {
    const { data: reponse, error: fetchError } = useFetchJson("/v1/progress");
    watch(reponse, (progress) => {
        if (progress && progress.success && progress.data) {
            userProgress.value = {
                confiance: progress.data.confiance || 65,
                ressources: progress.data.ressources || 100,
                impact: progress.data.impact || 30,
                crise: progress.data.crise || 15,
            };

            if (progress.data.chapter_id) {
                loadChapter(progress.data.chapter_id);
            } else {
                loadFirstChapter();
            }
            loading.value = false;
        } else {
            console.error(fetchError);
            error.value = "Erreur lors du chargement des données";
            loading.value = false;
        }
    });
}

function loadFirstChapter() {
    const { data: reponse, error: fetchError } =
        useFetchJson("/v1/chapters/first");
    watch(reponse, (firstchapter) => {
        if (firstchapter && firstchapter.success && firstchapter.data) {
            currentChapter.value = firstchapter.data;
            loadChoicesForChapter(firstchapter.data.id);
        } else {
            console.error(fetchError);
            error.value = "Erreur lors du chargement du premier chapitre";
            loading.value = false;
        }
    });
}

function loadChapter(chapterId) {
    const { data: reponse, error: fetchError } = useFetchJson(
        `/v1/chapters/${chapterId}`
    );
    watch(reponse, (chapter) => {
        if (chapter && chapter.success && chapter.data) {
            currentChapter.value = chapter.data;

            // Ne charger les choix que si on n'est pas dans un chapitre de fin
            if (chapterId <= 15) {
                loadChoicesForChapter(chapterId);
            } else {
                choices.value = []; // Pas de choix pour les chapitres de fin
            }
        } else {
            console.error(fetchError);
            error.value = "Erreur lors du chargement du chapitre";
            loading.value = false;
        }
    });
}

function loadChoicesForChapter(chapterId) {
    const { data: reponse, error: fetchError } = useFetchJson(
        `/v1/chapters/${chapterId}/choices`
    );
    watch(reponse, (choiceByChapter) => {
        if (
            choiceByChapter &&
            choiceByChapter.success &&
            choiceByChapter.data
        ) {
            choices.value = choiceByChapter.data;
        } else {
            console.error(fetchError);
            error.value = "Erreur lors du chargement des choix";
            loading.value = false;
        }
    });
}

function makeChoice(choice) {
    const { data: reponse, error: fetchError } = useFetchJson({
        url: "/v1/progress/update",
        method: "PATCH",
        data: {
            choice_id: choice.id,
        },
    });
    watch(reponse, (progressUpdate) => {
        if (progressUpdate && progressUpdate.success && progressUpdate.data) {
            userProgress.value = {
                confiance: progressUpdate.data.confiance,
                ressources: progressUpdate.data.ressources,
                impact: progressUpdate.data.impact,
                crise: progressUpdate.data.crise,
            };

            // Charger le chapitre suivant (déterminé par le controller)
            if (progressUpdate.data.chapter_id) {
                loadChapter(progressUpdate.data.chapter_id);
            }
        } else {
            console.error(fetchError);
            error.value = "Erreur lors de la mise à jour de la progression";
        }
    });
}

function resetProgress() {
    const { data: reponse, error: fetchError } = useFetchJson({
        url: "/v1/progress/reset",
        method: "PATCH",
    });

    watch(reponse, (resetStatus) => {
        if (resetStatus && resetStatus.success) {
            userProgress.value = {
                confiance: 65,
                ressources: 100,
                impact: 30,
                crise: 15,
            };
            loadFirstChapter();
            loading.value = false;
        } else {
            console.error(fetchError);
            error.value = "Erreur lors de la réinitialisation";
            loading.value = false;
        }
    });
}

function returnToDashboard() {
    emit("return-to-dashboard");
}
</script>

<template>
    <div class="crisis-simulator">
        <Header :userName="userName" :metrics="userProgress" />

        <main class="content">
            <div class="top-controls">
                <button @click="returnToDashboard" class="return-btn">
                    <span class="return-icon">&#8592;</span> RETOUR AU CENTRE DE
                    SIMULATION
                </button>
            </div>

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
    <Footer />
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

.top-controls {
    margin-bottom: 1.5rem;
    display: flex;
    justify-content: space-between;
}

.return-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.2rem;
    background-color: var(--secondary);
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.return-btn:hover {
    background-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.return-icon {
    font-size: 1.2rem;
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

.retry-btn {
    margin-top: 1rem;
    padding: 0.6rem 1.2rem;
    background-color: var(--primary);
    color: white;
    border: none;
    border-radius: 4px;
    font-weight: 600;
    cursor: pointer;
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

    .top-controls {
        margin-bottom: 1rem;
    }

    .return-btn {
        font-size: 0.8rem;
        padding: 0.6rem 1rem;
    }
}
</style>
