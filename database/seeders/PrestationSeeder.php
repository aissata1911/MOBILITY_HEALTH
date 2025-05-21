<?php
namespace Database\Seeders;
use App\Models\Prestation;
use App\Models\Sinistre;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PrestationSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $types = ['Consultation', 'Transport', 'Hospitalisation', 'Médicament'];

        // Associer 2-4 prestations à chaque sinistre
        foreach (Sinistre::all() as $sinistre) {
            for ($i = 0; $i < rand(2, 4); $i++) {
                Prestation::create([
                    'sinistre_id' => $sinistre->id,
                    'type' => $faker->randomElement($types),
                    'details' => $faker->sentence(),
                    'prix' => $faker->randomFloat(2, 10, 500),
                    'completee' => $faker->boolean(50),
                ]);
            }
        }
    }
}
