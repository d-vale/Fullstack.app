<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Progress extends Model
{

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'progresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'chapter_id',
        'user_id',
        'confiance',
        'ressources',
        'impact',
        'crise',
    ];

    /**
     * Get the chapter associated with this progress.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * Get the user associated with this progress.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all metrics as an array.
     *
     * @return array
     */
    public function getMetrics(): array
    {
        return [
            'confiance' => $this->confiance,
            'ressources' => $this->ressources,
            'impact' => $this->impact,
            'crise' => $this->crise,
        ];
    }

    /**
     * Determine the game ending based on final metrics.
     *
     * @return string
     */
    public function determineEnding(): string
    {
        // Leader visionnaire
        if ($this->confiance > 75 && $this->impact < 20 && $this->crise < 10 && $this->ressources > 20) {
            return 'leader_visionnaire';
        }

        // Gestionnaire efficace
        if ($this->confiance > 60 && $this->impact < 35 && $this->crise < 25) {
            return 'gestionnaire_efficace';
        }

        // Équilibre pragmatique
        if (
            $this->confiance >= 40 && $this->confiance <= 60 &&
            $this->impact >= 25 && $this->impact <= 45 &&
            $this->crise < 40
        ) {
            return 'equilibre_pragmatique';
        }

        // Résolution coûteuse
        if (
            $this->confiance >= 30 && $this->confiance <= 50 &&
            $this->ressources < 15 &&
            $this->crise < 50
        ) {
            return 'resolution_couteuse';
        }

        // Échec stratégique
        if (
            $this->confiance < 30 &&
            $this->impact > 50 &&
            $this->crise >= 30 && $this->crise <= 60
        ) {
            return 'echec_strategique';
        }

        // Catastrophe nationale
        if (
            $this->confiance < 20 &&
            $this->impact > 60 &&
            $this->crise > 60
        ) {
            return 'catastrophe_nationale';
        }

        // Default ending if no conditions are met
        return 'equilibre_pragmatique';
    }
}
