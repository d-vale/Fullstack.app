<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{

    /**
     * La table associée au modèle.
     *
     * @var string
     */
    protected $table = 'chapters';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'text',
    ];

    /**
     * Get the choices associated with this chapter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class);
    }

    /**
     * Get the user progresses associated with this chapter.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function progresses(): HasMany
    {
        return $this->hasMany(Progress::class);
    }

    /**
     * Get the next chapter(s) available from this chapter based on choices.
     *
     * @return \Illuminate\Support\Collection
     */
    public function nextChapters()
    {
        // This is a helper method to find the next chapters
        // Implementation will depend on how your chapter progression logic works
        return $this->choices()->with('nextChapter')->get()->pluck('nextChapter')->unique();
    }
}
