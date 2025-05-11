<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Progress;
use App\Models\User;
use Carbon\Carbon;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Progress::truncate();

        // Pour chaque utilisateur, créer une progression initiale
        $users = User::all();

        foreach ($users as $user) {
            Progress::create([
                'user_id' => $user->id,
                'chapter_id' => 1,
                'confiance' => 50,
                'ressources' => 100,
                'impact' => 30,
                'crise' => 30,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $this->command->info('Progressions initiales créées avec succès!');
    }
}
