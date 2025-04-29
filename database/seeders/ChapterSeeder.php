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
                'text' => "Chapitre 1 : Premières heures de la crise\n\n**Situation** : Des rapports arrivent sur votre bureau indiquant des pannes informatiques dans plusieurs secteurs stratégiques. Les premières analyses suggèrent une attaque coordonnée. Les médias commencent à s'emparer de l'information, certains évoquant déjà un \"blackout imminent\".\n\n**Choix : Communication initiale**"
            ],
            [
                'id' => 2,
                'text' => "Chapitre 2 : Mobilisation des ressources\n\n**Situation** : Alors que l'ampleur de l'attaque se précise, vous devez décider rapidement comment allouer vos ressources limitées. Les experts estiment que plusieurs secteurs critiques sont compromis, et d'autres pourraient suivre.\n\n**Choix : Allocation des ressources**"
            ],
            [
                'id' => 3,
                'text' => "Chapitre 3 : Escalade de la crise (24h)\n\n**Situation** : La crise s'intensifie. Les attaques continuent et commencent à affecter davantage de secteurs. Les pannes d'électricité se propagent et les services bancaires sont perturbés dans plusieurs régions.\n\n**Choix : Stratégie de défense**"
            ],
            [
                'id' => 4,
                'text' => "Chapitre 4 : Gestion de la panique (48h)\n\n**Situation** : Les perturbations des services essentiels commencent à affecter la vie quotidienne. Des files d'attente se forment devant les distributeurs de billets, et des rumeurs de pénuries alimentent l'anxiété. Les réseaux sociaux amplifient la panique.\n\n**Choix : Gestion de l'impact public**"
            ],
            [
                'id' => 5,
                'text' => "Chapitre 5 : Pic de la crise (3-4 jours)\n\n**Situation** : La crise atteint son paroxysme. Selon vos décisions précédentes, la situation peut être plus ou moins grave, mais elle reste critique. Les systèmes hospitaliers sont particulièrement vulnérables à ce stade.\n\n**Choix : Mesures exceptionnelles**"
            ],
            [
                'id' => 6,
                'text' => "Chapitre 6 : Stratégie de communication (5 jours)\n\n**Situation** : L'opinion publique est divisée sur votre gestion de la crise. Les médias scrutent chacune de vos décisions. Une stratégie de communication claire devient essentielle pour maintenir la confiance.\n\n**Choix : Communication de crise**"
            ],
            [
                'id' => 7,
                'text' => "Chapitre 7 : Premiers signes de stabilisation (1 semaine)\n\n**Situation** : Les premières mesures commencent à porter leurs fruits. Certains systèmes sont restaurés, mais la crise est loin d'être terminée. Vous devez maintenant préparer la phase de reconstruction.\n\n**Choix : Stratégie de reconstruction initiale**"
            ],
            [
                'id' => 8,
                'text' => "Chapitre 8 : Dimension internationale (2 semaines)\n\n**Situation** : La crise a des répercussions internationales. D'autres pays ont été touchés ou craignent de l'être. Votre position sur la scène internationale peut influencer l'issue de la crise.\n\n**Choix : Position internationale**"
            ],
            [
                'id' => 9,
                'text' => "Chapitre 9 : Retombées politiques (3 semaines)\n\n**Situation** : La phase aigüe de la crise est passée, mais ses conséquences politiques se font sentir. Des questions émergent sur la responsabilité et la gestion de la crise. Votre leadership est évalué.\n\n**Choix : Gestion politique**"
            ],
            [
                'id' => 10,
                'text' => "Chapitre 10 : Reconstruction des systèmes (1-2 mois)\n\n**Situation** : La restauration complète des systèmes est en cours. Vous devez décider de l'approche à adopter pour reconstruire les infrastructures numériques du pays.\n\n**Choix : Stratégie de reconstruction**"
            ],
            [
                'id' => 11,
                'text' => "Chapitre 11 : Diplomatie et alliances (2-3 mois)\n\n**Situation** : Les relations internationales continuent d'être affectées par la crise. Votre position diplomatique peut renforcer ou affaiblir la sécurité nationale à long terme.\n\n**Choix : Positionnement international**"
            ],
            [
                'id' => 12,
                'text' => "Chapitre 12 : Cadre juridique et réformes (3-6 mois)\n\n**Situation** : Le débat public porte maintenant sur l'équilibre entre sécurité et libertés numériques. Un nouveau cadre juridique doit être défini pour prévenir de futures crises.\n\n**Choix : Réformes législatives**"
            ],
            [
                'id' => 13,
                'text' => "Chapitre 13 : Préparation future (6-12 mois)\n\n**Situation** : La prévention de futures crises devient prioritaire. Un programme national de sensibilisation et de formation doit être mis en place.\n\n**Choix : Formation et sensibilisation**"
            ],
            [
                'id' => 14,
                'text' => "Chapitre 14 : Innovation technologique (12-18 mois)\n\n**Situation** : De nouvelles technologies émergent, tant défensives qu'offensives. Votre stratégie d'investissement technologique déterminera la résilience future du pays.\n\n**Choix : Investissement technologique**"
            ],
            [
                'id' => 15,
                'text' => "Chapitre 15 : Héritage et vision (18-24 mois)\n\n**Situation** : Deux ans après la crise initiale, un nouvel équilibre s'est instauré. Votre gestion a créé un précédent qui définit maintenant la doctrine nationale. Vous devez décider de l'héritage institutionnel que vous souhaitez laisser.\n\n**Choix : Vision future**"
            ],
            [
                'id' => 16,
                'text' => "Fin : Leader visionnaire\n\nVous devenez une référence internationale en gestion de crise et sécurité numérique. Votre parcours est étudié dans les grandes écoles. On vous propose un poste à la tête d'une organisation internationale de cybersécurité."
            ],
            [
                'id' => 17,
                'text' => "Fin : Gestionnaire efficace\n\nLa crise est bien gérée et les systèmes sont robustes. Votre leadership est reconnu, malgré quelques critiques. Votre carrière progresse au niveau national."
            ],
            [
                'id' => 18,
                'text' => "Fin : Équilibre pragmatique\n\nLa situation est stabilisée avec des résultats mitigés. Certains choix difficiles ont été nécessaires. Votre position reste stable, mais sans avancement notable."
            ],
            [
                'id' => 19,
                'text' => "Fin : Résolution coûteuse\n\nLa crise est terminée mais à quel prix! Des sacrifices importants ont été faits. Votre position est fragilisée et votre héritage controversé."
            ],
            [
                'id' => 20,
                'text' => "Fin : Échec stratégique\n\nVotre gestion est largement critiquée. Les réformes sont insuffisantes et les risques futurs élevés. Une commission d'enquête examine vos décisions. Votre démission est probable."
            ],
            [
                'id' => 21,
                'text' => "Fin : Catastrophe nationale\n\nLa crise a provoqué des dommages durables. Les infrastructures critiques restent vulnérables. Vous êtes limogé et faites l'objet d'une enquête parlementaire. Votre carrière est terminée."
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
