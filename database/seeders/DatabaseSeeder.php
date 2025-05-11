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
            UserSeeder::class,     
            ChapterSeeder::class,
            ChoiceSeeder::class,
            ProgressSeeder::class,
        ]);

        // Réactiver les contraintes de clés étrangères
        Schema::enableForeignKeyConstraints();
    }
}
