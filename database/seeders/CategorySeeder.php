<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Assure-toi d'importer le modèle

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Soul', 'Ambient', 'Pop', 'Rap', 'Funk', 'Rock', 'Reggae / Dub', 'Techno', 'Electro'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]); // Insérer la catégorie
        }
    }
}
