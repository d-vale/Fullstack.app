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
            // Chapitre 1: Alerte initiale
            [
                'text' => "Convoquer immédiatement la cellule de crise",
                'chapter_id' => 1,
                'confiance' => 5,
                'ressources' => -5,
                'impact' => -5,
                'crise' => 5,
                'next_chapter' => 2,
            ],
            [
                'text' => "Demander une évaluation rapide avant d'agir",
                'chapter_id' => 1,
                'confiance' => -5,
                'ressources' => 0,
                'impact' => 5,
                'crise' => 10,
                'next_chapter' => 2,
            ],
            [
                'text' => "Alerter discrètement les services de sécurité",
                'chapter_id' => 1,
                'confiance' => 0,
                'ressources' => -10,
                'impact' => 0,
                'crise' => 0,
                'next_chapter' => 2,
            ],

            // Chapitre 2: Évaluation de la menace
            [
                'text' => "Sécuriser en priorité les hôpitaux",
                'chapter_id' => 2,
                'confiance' => 10,
                'ressources' => -20,
                'impact' => -10,
                'crise' => 5,
                'next_chapter' => 3,
            ],
            [
                'text' => "Protéger le système financier",
                'chapter_id' => 2,
                'confiance' => -5,
                'ressources' => -20,
                'impact' => 10,
                'crise' => 0,
                'next_chapter' => 3,
            ],
            [
                'text' => "Répartir les efforts sur tous les fronts",
                'chapter_id' => 2,
                'confiance' => 0,
                'ressources' => -15,
                'impact' => -5,
                'crise' => 10,
                'next_chapter' => 3,
            ],

            // Chapitre 3: Communication publique
            [
                'text' => "Transparence totale sur la situation",
                'chapter_id' => 3,
                'confiance' => 15,
                'ressources' => 0,
                'impact' => -10,
                'crise' => 0,
                'next_chapter' => 4,
            ],
            [
                'text' => "Communication rassurante et mesurée",
                'chapter_id' => 3,
                'confiance' => 5,
                'ressources' => 0,
                'impact' => -5,
                'crise' => 5,
                'next_chapter' => 4,
            ],
            [
                'text' => "Minimiser la gravité publiquement",
                'chapter_id' => 3,
                'confiance' => -20,
                'ressources' => 0,
                'impact' => 0,
                'crise' => 15,
                'next_chapter' => 4,
            ],

            // Chapitre 4: Mobilisation des ressources
            [
                'text' => "Recruter massivement des experts externes",
                'chapter_id' => 4,
                'confiance' => 5,
                'ressources' => -40,
                'impact' => -5,
                'crise' => -15,
                'next_chapter' => 5,
            ],
            [
                'text' => "Utiliser uniquement les ressources internes",
                'chapter_id' => 4,
                'confiance' => -5,
                'ressources' => -20,
                'impact' => 5,
                'crise' => 5,
                'next_chapter' => 5,
            ],
            [
                'text' => "Faire appel à l'aide internationale",
                'chapter_id' => 4,
                'confiance' => 10,
                'ressources' => -30,
                'impact' => -10,
                'crise' => -10,
                'next_chapter' => 5,
            ],

            // Chapitre 5: Premières conséquences
            [
                'text' => "Mettre en place des solutions de contournement",
                'chapter_id' => 5,
                'confiance' => 5,
                'ressources' => -25,
                'impact' => -15,
                'crise' => -5,
                'next_chapter' => 6,
            ],
            [
                'text' => "Concentrer les efforts sur la source de l'attaque",
                'chapter_id' => 5,
                'confiance' => -10,
                'ressources' => -30,
                'impact' => 10,
                'crise' => -20,
                'next_chapter' => 6,
            ],
            [
                'text' => "Communiquer des mesures de précaution au public",
                'chapter_id' => 5,
                'confiance' => 10,
                'ressources' => -15,
                'impact' => -10,
                'crise' => 5,
                'next_chapter' => 6,
            ],

            // Chapitre 6: Escalade de la crise
            [
                'text' => "Déclencher le plan ORSEC numérique",
                'chapter_id' => 6,
                'confiance' => -5,
                'ressources' => 20,
                'impact' => -10,
                'crise' => -10,
                'next_chapter' => 7,
            ],
            [
                'text' => "Isoler les systèmes critiques du réseau",
                'chapter_id' => 6,
                'confiance' => -15,
                'ressources' => -20,
                'impact' => 20,
                'crise' => -15,
                'next_chapter' => 7,
            ],
            [
                'text' => "Maintenir les systèmes avec surveillance renforcée",
                'chapter_id' => 6,
                'confiance' => 0,
                'ressources' => -25,
                'impact' => 5,
                'crise' => 10,
                'next_chapter' => 7,
            ],

            // Chapitre 7: Identification des attaquants
            [
                'text' => "Mener une contre-offensive cybernétique",
                'chapter_id' => 7,
                'confiance' => -10,
                'ressources' => -35,
                'impact' => 5,
                'crise' => -20,
                'next_chapter' => 8,
            ],
            [
                'text' => "Renforcer les défenses sans riposter",
                'chapter_id' => 7,
                'confiance' => 5,
                'ressources' => -25,
                'impact' => -5,
                'crise' => -10,
                'next_chapter' => 8,
            ],
            [
                'text' => "Négocier discrètement avec les suspects",
                'chapter_id' => 7,
                'confiance' => -25,
                'ressources' => -15,
                'impact' => 0,
                'crise' => -25,
                'next_chapter' => 8,
            ],

            // Chapitre 8: Pic de la crise
            [
                'text' => "État d'urgence et mobilisation militaire",
                'chapter_id' => 8,
                'confiance' => -10,
                'ressources' => 30,
                'impact' => -15,
                'crise' => -15,
                'next_chapter' => 9,
            ],
            [
                'text' => "Évacuation des zones critiques",
                'chapter_id' => 8,
                'confiance' => -20,
                'ressources' => -40,
                'impact' => 25,
                'crise' => -10,
                'next_chapter' => 9,
            ],
            [
                'text' => "Maintien des opérations avec moyens actuels",
                'chapter_id' => 8,
                'confiance' => 0,
                'ressources' => -20,
                'impact' => 10,
                'crise' => 5,
                'next_chapter' => 9,
            ],

            // Chapitre 9: Gestion de la panique
            [
                'text' => "Campagne massive d'information officielle",
                'chapter_id' => 9,
                'confiance' => 15,
                'ressources' => -20,
                'impact' => -20,
                'crise' => 0,
                'next_chapter' => 10,
            ],
            [
                'text' => "Censure temporaire des réseaux sociaux",
                'chapter_id' => 9,
                'confiance' => -30,
                'ressources' => -10,
                'impact' => -10,
                'crise' => -5,
                'next_chapter' => 10,
            ],
            [
                'text' => "Collaboration avec les médias traditionnels",
                'chapter_id' => 9,
                'confiance' => 10,
                'ressources' => -15,
                'impact' => -15,
                'crise' => 0,
                'next_chapter' => 10,
            ],

            // Chapitre 10: Tournant de la crise
            [
                'text' => "Reconstruction progressive et sécurisée",
                'chapter_id' => 10,
                'confiance' => 10,
                'ressources' => -40,
                'impact' => -10,
                'crise' => -20,
                'next_chapter' => 11,
            ],
            [
                'text' => "Restauration rapide des services essentiels",
                'chapter_id' => 10,
                'confiance' => 15,
                'ressources' => -30,
                'impact' => -15,
                'crise' => -15,
                'next_chapter' => 11,
            ],
            [
                'text' => "Focus sur la prévention de nouvelles attaques",
                'chapter_id' => 10,
                'confiance' => -5,
                'ressources' => -35,
                'impact' => 5,
                'crise' => -10,
                'next_chapter' => 11,
            ],

            // Chapitre 11: Stabilisation
            [
                'text' => "Audit complet de sécurité national",
                'chapter_id' => 11,
                'confiance' => 5,
                'ressources' => -30,
                'impact' => -5,
                'crise' => -15,
                'next_chapter' => 12,
            ],
            [
                'text' => "Retour progressif à la normale",
                'chapter_id' => 11,
                'confiance' => 10,
                'ressources' => -20,
                'impact' => -10,
                'crise' => -10,
                'next_chapter' => 12,
            ],
            [
                'text' => "Maintien du niveau d'alerte maximal",
                'chapter_id' => 11,
                'confiance' => -10,
                'ressources' => -25,
                'impact' => 10,
                'crise' => -5,
                'next_chapter' => 12,
            ],

            // Chapitre 12: Bilan et responsabilités
            [
                'text' => "Assumer l'entière responsabilité",
                'chapter_id' => 12,
                'confiance' => 20,
                'ressources' => 0,
                'impact' => -15,
                'crise' => -5,
                'next_chapter' => 13,
            ],
            [
                'text' => "Commission d'enquête indépendante",
                'chapter_id' => 12,
                'confiance' => 5,
                'ressources' => -15,
                'impact' => -10,
                'crise' => -5,
                'next_chapter' => 13,
            ],
            [
                'text' => "Blâmer les administrations précédentes",
                'chapter_id' => 12,
                'confiance' => -30,
                'ressources' => 0,
                'impact' => 10,
                'crise' => 5,
                'next_chapter' => 13,
            ],

            // Chapitre 13: Reconstruction
            [
                'text' => "Modernisation complète des infrastructures",
                'chapter_id' => 13,
                'confiance' => 15,
                'ressources' => -50,
                'impact' => -5,
                'crise' => -10,
                'next_chapter' => 14,
            ],
            [
                'text' => "Renforcement des systèmes existants",
                'chapter_id' => 13,
                'confiance' => 5,
                'ressources' => -35,
                'impact' => -10,
                'crise' => -5,
                'next_chapter' => 14,
            ],
            [
                'text' => "Externalisation au secteur privé",
                'chapter_id' => 13,
                'confiance' => -15,
                'ressources' => -20,
                'impact' => 5,
                'crise' => 0,
                'next_chapter' => 14,
            ],

            // Chapitre 14: Dimension internationale
            [
                'text' => "Promouvoir un traité international de cybersécurité",
                'chapter_id' => 14,
                'confiance' => 20,
                'ressources' => -25,
                'impact' => -10,
                'crise' => -5,
                'next_chapter' => 15,
            ],
            [
                'text' => "Développer une doctrine nationale souveraine",
                'chapter_id' => 14,
                'confiance' => 5,
                'ressources' => -40,
                'impact' => 0,
                'crise' => -10,
                'next_chapter' => 15,
            ],
            [
                'text' => "S'aligner sur les standards existants",
                'chapter_id' => 14,
                'confiance' => 10,
                'ressources' => -30,
                'impact' => -5,
                'crise' => -5,
                'next_chapter' => 15,
            ],

            // Chapitre 15: Héritage et réformes
            [
                'text' => "Création d'une cyberdéfense nationale autonome",
                'chapter_id' => 15,
                'confiance' => 25,
                'ressources' => -45,
                'impact' => -20,
                'crise' => -15,
                'next_chapter' => null,
            ],
            [
                'text' => "Réformes modérées et pragmatiques",
                'chapter_id' => 15,
                'confiance' => 10,
                'ressources' => -30,
                'impact' => -10,
                'crise' => -10,
                'next_chapter' => null,
            ],
            [
                'text' => "Maintien du statu quo avec ajustements mineurs",
                'chapter_id' => 15,
                'confiance' => -20,
                'ressources' => -15,
                'impact' => 5,
                'crise' => -5,
                'next_chapter' => null,
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
                'next_chapter' => $choice['next_chapter'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $this->command->info('Choix insérés avec succès!');
    }
}
