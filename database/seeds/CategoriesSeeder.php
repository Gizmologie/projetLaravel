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
            "Multimédia" => [
                'Téléphones',
                "Ordinateurs",
                "Montres Connectées",
            ],
            "Musique" => [
                "Casques",
                "CD's"
            ],
            "Maison Connectée" => [
                "Enceintes connectées",
                'Lumières connectées',
                'Caméras Connectées',
                'Thermostats Connectée'
            ],
            "Films" => [
                "DVD's"
            ],
            "Jouets" => [
                "Drones",
                "Jeux en bois",
                'Jeux de société'
            ],
            "Jeux vidéo" => [
                "PS4",
                "Xbox",
                "PC",
                'Nintendo Switch'
            ],
        ];

        foreach ($categories as $category_label => $sub_categories) {
            $parent = Category::create([
                'name' => $category_label,
                'slug' => Str::slug($category_label),
                'resume' => 'Retrouvez tous nos produits ' . $category_label,
                'level' => 0,
                'image' => 'images/categories/' . Str::slug($category_label) . '.jpg'
            ]);

            foreach ($sub_categories as $sub_category_label) {
                Category::create([
                    'name' => $sub_category_label,
                    'slug' => Str::slug($sub_category_label),
                    'resume' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                    Omnia peccata paria dicitis. Cave putes quicquam esse verius. 
                    Omnia contraria, quos etiam insanos esse vultis. 
                    Scaevolam M. Certe non potest. Primum Theophrasti, Strato, physicum se voluit ',
                    'level' => 1,
                    'image' => 'images/categories/' . Str::slug($sub_category_label) . '.jpg',
                    'parent_id' => $parent->id
                ]);
            }
        }
    }
}
