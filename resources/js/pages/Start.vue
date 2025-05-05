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

async function loadUserProgress() {
        const { data: reponse, error } = useFetchJson("/v1/progress");
        watch(reponse, (progress) => {
            console.log("Data:", progress);

            if (progress.success && progress.data) {
                userName.value = progress.data.user_name || "Invité";
                console.log(progress.data.user_name);
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
                console.error(error);
                loading.value = true;
            }
        });
    }

async function loadFirstChapter() {
    try {
        const response = await fetch("/v1/chapters/first", {
            headers: {
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }

        const data = await response.json();

        if (data.success && data.data) {
            currentChapter.value = data.data;
            loadChoicesForChapter(data.data.id);
        } else {
            error.value = "Impossible de charger le premier chapitre.";
        }
    } catch (err) {
        console.error("Erreur lors du chargement du premier chapitre:", err);
        error.value = "Erreur lors du chargement du scénario.";
    }
}

async function loadChapter(chapterId) {
    try {
        const response = await fetch(`/v1/chapters/${chapterId}`, {
            headers: {
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }

        const data = await response.json();

        if (data.success && data.data) {
            currentChapter.value = data.data;
            loadChoicesForChapter(chapterId);
        } else {
            error.value = "Impossible de charger le chapitre demandé.";
        }
    } catch (err) {
        console.error(
            `Erreur lors du chargement du chapitre ${chapterId}:`,
            err
        );
        error.value = "Erreur lors du chargement du chapitre.";
    }
}

async function loadChoicesForChapter(chapterId) {
    try {
        const response = await fetch(`/v1/chapters/${chapterId}/choices`, {
            headers: {
                Accept: "application/json",
            },
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }

        const data = await response.json();

        if (data.success && data.data) {
            choices.value = data.data;
        } else {
            error.value = "Impossible de charger les choix pour ce chapitre.";
        }
    } catch (err) {
        console.error(
            `Erreur lors du chargement des choix pour le chapitre ${chapterId}:`,
            err
        );
        error.value = "Erreur lors du chargement des options.";
    }
}

async function makeChoice(choice) {
    try {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        const response = await fetch("/v1/progress/update", {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                choice_id: choice.id,
            }),
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }

        const data = await response.json();

        if (data.success && data.data) {
            userProgress.value = {
                confiance: data.data.confiance || userProgress.value.confiance,
                ressources:
                    data.data.ressources || userProgress.value.ressources,
                impact: data.data.impact || userProgress.value.impact,
                crise: data.data.crise || userProgress.value.crise,
            };

            if (data.data.chapter_id) {
                loadChapter(data.data.chapter_id);
            }
        } else {
            error.value = "Impossible de mettre à jour votre progression.";
        }
    } catch (err) {
        console.error("Erreur lors de la mise à jour de la progression:", err);
        error.value = "Erreur lors de la mise à jour de votre progression.";
    }
}

async function resetProgress() {
    try {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        const response = await fetch("/v1/progress/reset", {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        if (!response.ok) {
            throw new Error(`Erreur HTTP! Statut: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            userProgress.value = {
                confiance: 65,
                ressources: 100,
                impact: 30,
                crise: 15,
            };

            loadFirstChapter();
        } else {
            error.value = "Impossible de réinitialiser votre progression.";
        }
    } catch (err) {
        console.error(
            "Erreur lors de la réinitialisation de la progression:",
            err
        );
        error.value =
            "Erreur lors de la réinitialisation de votre progression.";
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
    background-color: var(--dark-blue);
}

.pixel-container {
    box-shadow: 0 0 0 4px var(--red), 0 0 0 8px var(--orange);
}

.pixel-text {
    font-family: "VT323", monospace;
    font-size: 24px; /* Taille augmentée */
    text-shadow: 2px 2px 0 #000;
    color: var(--yellow);
}

.spinner {
    width: 60px; /* Taille augmentée */
    height: 60px; /* Taille augmentée */
    background-color: var(--orange);
    margin-bottom: 1rem;
    animation: pixel-spin 1s steps(8) infinite;
}

.pixel-spinner {
    clip-path: polygon(
        0 0,
        50% 0,
        50% 50%,
        100% 50%,
        100% 100%,
        50% 100%,
        50% 50%,
        0 50%
    );
}

@keyframes pixel-spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.error {
    text-align: center;
    padding: 2rem;
    background-color: var(--dark-blue);
    border: 4px solid var(--red);
}

.pixel-btn {
    padding: 0.8rem 1.2rem; /* Padding augmenté */
    background-color: var(--blue);
    color: white;
    border: none;
    font-family: "VT323", monospace;
    font-size: 20px; /* Taille augmentée */
    box-shadow: 4px 4px 0 #000;
    cursor: pointer;
    transform: translateY(-2px);
    transition: all 0.1s steps(2);
    text-shadow: 1px 1px 0 #000;
}

.pixel-btn:hover {
    transform: translateY(0);
    box-shadow: 2px 2px 0 #000;
    background-color: var(--green);
}

.reset-container {
    text-align: center;
    margin-top: 2rem;
}

.reset-btn {
    background-color: var(--purple);
    font-size: 18px;
}

.reset-btn:hover {
    background-color: var(--pink);
}

@media (max-width: 768px) {
    .content {
        padding: 1rem;
    }

    .pixel-text {
        font-size: 20px;
    }
}
</style>
