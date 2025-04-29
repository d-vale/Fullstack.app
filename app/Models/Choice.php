<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Choice extends Model
{
    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'choices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
        'chapter_id',
        'confiance',
        'ressources',
        'impact',
        'crise',
    ];

    /**
     * Get the chapter that owns this choice.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * Get the impacts of this choice as an array.
     *
     * @return array
     */
    public function getImpacts(): array
    {
        return [
            'confiance' => $this->confiance,
            'ressources' => $this->ressources,
            'impact' => $this->impact,
            'crise' => $this->crise,
        ];
    }

    /**
     * Apply this choice to a user's progress.
     *
     * @param Progress $progress
     * @return Progress
     */
    public function applyToProgress(Progress $progress): Progress
    {
        $progress->confiance += $this->confiance;
        $progress->ressources += $this->ressources;
        $progress->impact += $this->impact;
        $progress->crise += $this->crise;

        // Ensure no values go below zero or above 100
        $progress->confiance = max(0, min(100, $progress->confiance));
        $progress->ressources = max(0, min(100, $progress->ressources));
        $progress->impact = max(0, min(100, $progress->impact));
        $progress->crise = max(0, min(100, $progress->crise));

        return $progress;
    }
}
