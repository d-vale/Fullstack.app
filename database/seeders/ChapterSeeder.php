<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chapter;
use Carbon\Carbon;

class ChapterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $chapters = [
            [
                'id' => 1,
                'text' => "Chapitre 1 : Alerte initiale\n\nSituation : 6h00 du matin. Votre téléphone sonne. Les premiers rapports font état d'anomalies dans plusieurs systèmes informatiques gouvernementaux. L'origine est encore inconnue.\n\nChoix : Première réaction"
            ],
            [
                'id' => 2,
                'text' => "Chapitre 2 : Évaluation de la menace\n\nSituation : Les experts confirment une attaque coordonnée. Les systèmes bancaires montrent des signes de vulnérabilité. Les hôpitaux signalent des dysfonctionnements.\n\nChoix : Priorités immédiates"
            ],
            [
                'id' => 3,
                'text' => "Chapitre 3 : Communication publique\n\nSituation : Les médias commencent à rapporter des pannes. Les réseaux sociaux s'agitent. Une communication officielle devient nécessaire.\n\nChoix : Stratégie de communication"
            ],
            [
                'id' => 4,
                'text' => "Chapitre 4 : Mobilisation des ressources\n\nSituation : L'ampleur de l'attaque se précise. Vous devez mobiliser des ressources supplémentaires pour contenir la crise.\n\nChoix : Allocation des ressources"
            ],
            [
                'id' => 5,
                'text' => "Chapitre 5 : Premières conséquences\n\nSituation : Les premiers effets se font sentir. Des distributeurs automatiques dysfonctionnent. Certains services hospitaliers sont perturbés.\n\nChoix : Gestion de l'impact immédiat"
            ],
            [
                'id' => 6,
                'text' => "Chapitre 6 : Escalade de la crise\n\nSituation : L'attaque s'intensifie. Le réseau électrique montre des signes de faiblesse. La panique commence à gagner la population.\n\nChoix : Mesures d'urgence"
            ],
            [
                'id' => 7,
                'text' => "Chapitre 7 : Identification des attaquants\n\nSituation : Les experts ont des pistes sur l'origine de l'attaque. Plusieurs théories émergent : groupe criminel, état étranger, ou terroristes.\n\nChoix : Approche stratégique"
            ],
            [
                'id' => 8,
                'text' => "Chapitre 8 : Pic de la crise\n\nSituation : La situation atteint son paroxysme. Des pannes électriques touchent plusieurs régions. Les hôpitaux fonctionnent sur générateurs.\n\nChoix : Décisions critiques"
            ],
            [
                'id' => 9,
                'text' => "Chapitre 9 : Gestion de la panique\n\nSituation : La population est inquiète. Des mouvements de panique sont observés. Les fausses informations circulent massivement.\n\nChoix : Contrôle de l'information"
            ],
            [
                'id' => 10,
                'text' => "Chapitre 10 : Tournant de la crise\n\nSituation : Vos efforts commencent à porter leurs fruits. Certains systèmes sont restaurés mais la menace persiste.\n\nChoix : Stratégie de recovery"
            ],
            [
                'id' => 11,
                'text' => "Chapitre 11 : Stabilisation\n\nSituation : La phase aiguë semble passée. Les systèmes critiques sont stabilisés mais restent vulnérables.\n\nChoix : Consolidation"
            ],
            [
                'id' => 12,
                'text' => "Chapitre 12 : Bilan et responsabilités\n\nSituation : L'heure du bilan approche. Des questions sur la préparation et la réponse à la crise émergent.\n\nChoix : Gestion politique"
            ],
            [
                'id' => 13,
                'text' => "Chapitre 13 : Reconstruction\n\nSituation : Il faut maintenant reconstruire les systèmes et restaurer la confiance. Les choix faits détermineront la résilience future.\n\nChoix : Plan de reconstruction"
            ],
            [
                'id' => 14,
                'text' => "Chapitre 14 : Dimension internationale\n\nSituation : La crise a eu des répercussions internationales. Votre gestion est scrutée par la communauté internationale.\n\nChoix : Positionnement global"
            ],
            [
                'id' => 15,
                'text' => "Chapitre 15 : Héritage et réformes\n\nSituation : La crise touche à sa fin. Il est temps de définir les réformes structurelles pour prévenir de futures crises.\n\nChoix : Vision d'avenir"
            ],
            [
                'id' => 16,
                'text' => "Fin : Succès total - \"Renaissance numérique\"\n\nVotre gestion exemplaire a transformé la crise en opportunité. Le pays émerge avec des infrastructures numériques de pointe et une cyberdéfense robuste. Vous êtes reconnu comme un leader visionnaire et nommé à la tête d'une nouvelle agence internationale de cybersécurité."
            ],
            [
                'id' => 17,
                'text' => "Fin : Résultat mitigé - \"Équilibre fragile\"\n\nLa crise est contenue mais les dégâts sont importants. Les systèmes fonctionnent mais des vulnérabilités persistent. Votre gestion est perçue comme acceptable mais perfectible. Vous conservez votre poste mais avec une marge de manœuvre réduite."
            ],
            [
                'id' => 18,
                'text' => "Fin : Échec total - \"Effondrement numérique\"\n\nLa crise a provoqué des dommages irréversibles. Les infrastructures critiques sont compromises durablement. Votre gestion catastrophique entraîne votre démission immédiate. Une enquête parlementaire est ouverte sur vos décisions. Votre carrière est définitivement compromise."
            ],
        ];

        // Supprimer tous les chapitres existants
        Chapter::truncate();

        // Insérer les nouveaux chapitres
        foreach ($chapters as $chapter) {
            Chapter::create([
                'id' => $chapter['id'],
                'text' => $chapter['text'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $this->command->info('Chapitres insérés avec succès!');
    }
}
