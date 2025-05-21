<?php 

namespace Database\Seeders;

use App\Models\Sinistre;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SinistreSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Générer 10 sinistres
        for ($i = 0; $i < 10; $i++) {
            Sinistre::create([
                'numero_dossier' => 'S' . str_pad($i + 1, 5, '0', STR_PAD_LEFT),
                'patient_nom' => $faker->name,
                'date_declaration' => $faker->date(),
                'description' => $faker->sentence(),
            ]);
        }
    }
}
