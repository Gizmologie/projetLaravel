<?php

use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::where('id', '!=', 0)->delete();
        $categories = [
            "Multimédia",
            "Musique",
            "Maison Connectée",
            "Films",
            "Jouets",
            "Jeux vidéo",
        ];

        foreach ($categories as $category_label) {
            $parent = Category::create([
                'name' => $category_label,
                'slug' => Str::slug($category_label),
                'resume' => 'Retrouvez tous nos produits ' . $category_label,
            ]);

        }
    }
}
