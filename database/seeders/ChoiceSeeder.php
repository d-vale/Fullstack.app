<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Choice;
use Carbon\Carbon;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Supprimer tous les choix existants
        Choice::truncate();

        $choices = [
            // Chapitre 1: Premières heures de la crise
            [
                'text' => "Communiquer immédiatement sur la situation pour rassurer la population",
                'chapter_id' => 1,
                'confiance' => 5,
                'ressources' => 0,
                'impact' => -5,
                'crise' => 5,
                'next_chapter' => 2,
            ],
            [
                'text' => "Attendre d'avoir plus d'informations avant toute communication",
                'chapter_id' => 1,
                'confiance' => -5,
                'ressources' => 0,
                'impact' => 10,
                'crise' => -5,
                'next_chapter' => 2,
            ],
            [
                'text' => "Minimiser la gravité de la situation dans vos communications",
                'chapter_id' => 1,
                'confiance' => -10,
                'ressources' => 0,
                'impact' => -10,
                'crise' => 0,
                'next_chapter' => 2,
            ],

            // Chapitre 2: Mobilisation des ressources
            [
                'text' => "Mobiliser les experts en cybersécurité pour analyser l'attaque",
                'chapter_id' => 2,
                'confiance' => 5,
                'ressources' => -20,
                'impact' => 0,
                'crise' => -10,
                'next_chapter' => 3,
            ],
            [
                'text' => "Renforcer immédiatement la sécurité des infrastructures non-touchées",
                'chapter_id' => 2,
                'confiance' => 0,
                'ressources' => -15,
                'impact' => -5,
                'crise' => 0,
                'next_chapter' => 3,
            ],
            [
                'text' => "Mettre en place des systèmes de secours pour les services essentiels",
                'chapter_id' => 2,
                'confiance' => 10,
                'ressources' => -25,
                'impact' => -15,
                'crise' => 0,
                'next_chapter' => 3,
            ],

            // Chapitre 3: Escalade de la crise (24h)
            [
                'text' => "Contre-attaque offensive sur les serveurs identifiés",
                'chapter_id' => 3,
                'confiance' => -5,
                'ressources' => -30,
                'impact' => 0,
                'crise' => -20,
                'next_chapter' => 4,
            ],
            [
                'text' => "Isolement complet des réseaux critiques (déconnexion temporaire)",
                'chapter_id' => 3,
                'confiance' => -10,
                'ressources' => -20,
                'impact' => 20,
                'crise' => -15,
                'next_chapter' => 4,
            ],
            [
                'text' => "Collaboration internationale pour neutraliser la menace",
                'chapter_id' => 3,
                'confiance' => 10,
                'ressources' => -15,
                'impact' => 0,
                'crise' => -10,
                'next_chapter' => 4,
            ],

            // Chapitre 4: Gestion de la panique (48h)
            [
                'text' => "Imposer des restrictions d'utilisation des services numériques",
                'chapter_id' => 4,
                'confiance' => -5,
                'ressources' => 0,
                'impact' => 10,
                'crise' => -10,
                'next_chapter' => 5,
            ],
            [
                'text' => "Mettre en place des centres d'information et d'assistance",
                'chapter_id' => 4,
                'confiance' => 15,
                'ressources' => -20,
                'impact' => -15,
                'crise' => 0,
                'next_chapter' => 5,
            ],
            [
                'text' => "Mobiliser l'armée pour sécuriser les infrastructures physiques",
                'chapter_id' => 4,
                'confiance' => 5,
                'ressources' => -25,
                'impact' => -5,
                'crise' => -5,
                'next_chapter' => 5,
            ],

            // Chapitre 5: Pic de la crise (3-4 jours)
            [
                'text' => "Déclarer l'état d'urgence numérique",
                'chapter_id' => 5,
                'confiance' => -5,
                'ressources' => 30,
                'impact' => -20,
                'crise' => -15,
                'next_chapter' => 6,
            ],
            [
                'text' => "Réquisitionner les experts du secteur privé",
                'chapter_id' => 5,
                'confiance' => 5,
                'ressources' => -10,
                'impact' => 0,
                'crise' => -25,
                'next_chapter' => 6,
            ],
            [
                'text' => "Négocier avec les attaquants",
                'chapter_id' => 5,
                'confiance' => -30,
                'ressources' => 0,
                'impact' => 0,
                'crise' => -30,
                'next_chapter' => 6,
            ],

            // Chapitre 6: Stratégie de communication (5 jours)
            [
                'text' => "Tenir une conférence de presse quotidienne",
                'chapter_id' => 6,
                'confiance' => 10,
                'ressources' => 0,
                'impact' => -5,
                'crise' => 0,
                'next_chapter' => 7,
            ],
            [
                'text' => "Lancer une campagne de conseils de cyber-protection",
                'chapter_id' => 6,
                'confiance' => 0,
                'ressources' => -10,
                'impact' => -10,
                'crise' => -5,
                'next_chapter' => 7,
            ],
            [
                'text' => "Désigner publiquement les responsables",
                'chapter_id' => 6,
                'confiance' => -10,
                'ressources' => 0,
                'impact' => 10,
                'crise' => 0,
                'next_chapter' => 7,
            ],

            // Chapitre 7: Premiers signes de stabilisation (1 semaine)
            [
                'text' => "Investissement massif dans la cybersécurité nationale",
                'chapter_id' => 7,
                'confiance' => 20,
                'ressources' => -50,
                'impact' => 0,
                'crise' => -15,
                'next_chapter' => 8,
            ],
            [
                'text' => "Création d'une agence dédiée aux crises numériques",
                'chapter_id' => 7,
                'confiance' => 15,
                'ressources' => -30,
                'impact' => 0,
                'crise' => -10,
                'next_chapter' => 8,
            ],
            [
                'text' => "Retour à la normale avec réparations minimales",
                'chapter_id' => 7,
                'confiance' => -20,
                'ressources' => -10,
                'impact' => 0,
                'crise' => -5,
                'next_chapter' => 8,
            ],

            // Chapitre 8: Dimension internationale (2 semaines)
            [
                'text' => "Promouvoir un traité international sur la cybersécurité",
                'chapter_id' => 8,
                'confiance' => 10,
                'ressources' => 0,
                'impact' => -5,
                'crise' => -5,
                'next_chapter' => 9,
            ],
            [
                'text' => "Développer des capacités offensives pour la dissuasion",
                'chapter_id' => 8,
                'confiance' => -5,
                'ressources' => -40,
                'impact' => 0,
                'crise' => -5,
                'next_chapter' => 9,
            ],
            [
                'text' => "Isoler davantage les réseaux critiques nationaux",
                'chapter_id' => 8,
                'confiance' => 0,
                'ressources' => -25,
                'impact' => 10,
                'crise' => -10,
                'next_chapter' => 9,
            ],

            // Chapitre 9: Retombées politiques (3 semaines)
            [
                'text' => "Commander un audit indépendant sur la gestion de crise",
                'chapter_id' => 9,
                'confiance' => 5,
                'ressources' => -15,
                'impact' => -5,
                'crise' => 0,
                'next_chapter' => 10,
            ],
            [
                'text' => "Restructurer les départements cybersécurité",
                'chapter_id' => 9,
                'confiance' => 10,
                'ressources' => -25,
                'impact' => 0,
                'crise' => -5,
                'next_chapter' => 10,
            ],
            [
                'text' => "Rejeter les responsabilités sur les administrations précédentes",
                'chapter_id' => 9,
                'confiance' => -10,
                'ressources' => 0,
                'impact' => 5,
                'crise' => 0,
                'next_chapter' => 10,
            ],

            // Chapitre 10: Reconstruction des systèmes (1-2 mois)
            [
                'text' => "Programme accéléré de reconstruction numérique",
                'chapter_id' => 10,
                'confiance' => 0,
                'ressources' => -35,
                'impact' => -20,
                'crise' => -10,
                'next_chapter' => 11,
            ],
            [
                'text' => "Refonte complète et progressive des infrastructures",
                'chapter_id' => 10,
                'confiance' => 0,
                'ressources' => -50,
                'impact' => -5,
                'crise' => -15,
                'next_chapter' => 11,
            ],
            [
                'text' => "Déléguer la reconstruction au secteur privé",
                'chapter_id' => 10,
                'confiance' => -5,
                'ressources' => -10,
                'impact' => 0,
                'crise' => -5,
                'next_chapter' => 11,
            ],

            // Chapitre 11: Diplomatie et alliances (2-3 mois)
            [
                'text' => "Organiser un sommet international sur la cybersécurité",
                'chapter_id' => 11,
                'confiance' => 15,
                'ressources' => -20,
                'impact' => -5,
                'crise' => 0,
                'next_chapter' => 12,
            ],
            [
                'text' => "Adopter une posture défensive isolationniste",
                'chapter_id' => 11,
                'confiance' => -5,
                'ressources' => -10,
                'impact' => 0,
                'crise' => -10,
                'next_chapter' => 12,
            ],
            [
                'text' => "Former une alliance de cyberdéfense avec des pays alliés",
                'chapter_id' => 11,
                'confiance' => 10,
                'ressources' => -5,
                'impact' => 0,
                'crise' => -5,
                'next_chapter' => 12,
            ],

            // Chapitre 12: Cadre juridique et réformes (3-6 mois)
            [
                'text' => "Renforcer drastiquement les lois sur la cybersécurité",
                'chapter_id' => 12,
                'confiance' => -15,
                'ressources' => 0,
                'impact' => 10,
                'crise' => -15,
                'next_chapter' => 13,
            ],
            [
                'text' => "Favoriser l'autorégulation du secteur privé",
                'chapter_id' => 12,
                'confiance' => 5,
                'ressources' => 10,
                'impact' => 0,
                'crise' => 5,
                'next_chapter' => 13,
            ],
            [
                'text' => "Adopter une approche équilibrée (public-privé)",
                'chapter_id' => 12,
                'confiance' => 10,
                'ressources' => -15,
                'impact' => 0,
                'crise' => -10,
                'next_chapter' => 13,
            ],

            // Chapitre 13: Préparation future (6-12 mois)
            [
                'text' => "Lancer un programme national d'éducation à la cybersécurité",
                'chapter_id' => 13,
                'confiance' => 15,
                'ressources' => -25,
                'impact' => -15,
                'crise' => 0,
                'next_chapter' => 14,
            ],
            [
                'text' => "Former uniquement les personnels critiques",
                'chapter_id' => 13,
                'confiance' => 0,
                'ressources' => -10,
                'impact' => -5,
                'crise' => -10,
                'next_chapter' => 14,
            ],
            [
                'text' => "Campagne médiatique de sensibilisation",
                'chapter_id' => 13,
                'confiance' => 5,
                'ressources' => -5,
                'impact' => -10,
                'crise' => 0,
                'next_chapter' => 14,
            ],

            // Chapitre 14: Innovation technologique (12-18 mois)
            [
                'text' => "Financer la recherche en IA de cyberdéfense",
                'chapter_id' => 14,
                'confiance' => 10,
                'ressources' => -40,
                'impact' => 0,
                'crise' => -15,
                'next_chapter' => 15,
            ],
            [
                'text' => "Adopter des solutions éprouvées et standardisées",
                'chapter_id' => 14,
                'confiance' => 0,
                'ressources' => -20,
                'impact' => -5,
                'crise' => -10,
                'next_chapter' => 15,
            ],
            [
                'text' => "Diversifier les approches et technologies",
                'chapter_id' => 14,
                'confiance' => 5,
                'ressources' => -30,
                'impact' => 0,
                'crise' => -20,
                'next_chapter' => 15,
            ],

            // Chapitre 15: Héritage et vision (18-24 mois)
            [
                'text' => "Création d'une académie nationale de cybersécurité",
                'chapter_id' => 15,
                'confiance' => 15,
                'ressources' => -30,
                'impact' => 0,
                'crise' => -15,
                'next_chapter' => 0, // Évaluation finale
            ],
            [
                'text' => "Intégration de la cybersécurité dans toutes les structures",
                'chapter_id' => 15,
                'confiance' => 0,
                'ressources' => -25,
                'impact' => -10,
                'crise' => -20,
                'next_chapter' => 0, // Évaluation finale
            ],
            [
                'text' => "Développement d'un écosystème numérique souverain",
                'chapter_id' => 15,
                'confiance' => 15,
                'ressources' => -60,
                'impact' => 10,
                'crise' => -25,
                'next_chapter' => 0, // Évaluation finale
            ],
        ];

        foreach ($choices as $choice) {
            Choice::create([
                'text' => $choice['text'],
                'chapter_id' => $choice['chapter_id'],
                'confiance' => $choice['confiance'],
                'ressources' => $choice['ressources'],
                'impact' => $choice['impact'],
                'crise' => $choice['crise'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $this->command->info('Choix insérés avec succès!');
    }
}
