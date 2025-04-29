<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Désactiver les contraintes de clés étrangères
        Schema::disableForeignKeyConstraints();

        // Exécuter les seeders dans l'ordre approprié
        $this->call([
            UserSeeder::class,      // D'abord les utilisateurs
            ChapterSeeder::class,   // Ensuite les chapitres
            ChoiceSeeder::class,    // Puis les choix
            ProgressSeeder::class,  // Enfin les progressions
        ]);

        // Réactiver les contraintes de clés étrangères
        Schema::enableForeignKeyConstraints();
    }
}
