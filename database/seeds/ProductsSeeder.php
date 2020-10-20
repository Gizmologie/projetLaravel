<?php

use App\Category;
use App\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Product::where('id', '!=', 0)->delete();
        $products = [
            0 => ["price" => 900, "name" => "Iphone X", "type" => "Téléphones"],
            1 => ["price" => 840, "name" => "Xpéria XZ3", "type" => "Téléphones"],
            2 => ["price" => 1000, "name" => "Huawei mate 20", "type" => "Téléphones"],
            3 => ["price" => 17.30, "name" => "Johnny - Mon pays c'est l'amour", "type" => "CD's"],
            4 => ["price" => 30, "name" => "Queen Compilation", "type" => "CD's"],
            5 => ["price" => 15.99, "name" => "Jain - Zanaka", "type" => "CD's"],
            6 => ["price" => 14.98, "name" => "Patrick Bruel - Ce soir on sort", "type" => "CD's"],
            7 => ["price" => 1299, "name" => "Hp spectre X360", "type" => "Ordinateurs"],
            8 => ["price" => 1500, "name" => "Apple - Macbook pro 2018", "type" => "Ordinateurs"],
            9 => ["price" => 299, "name" => "Lenovo IdeaPad", "type" => "Ordinateurs"],
            10 => ["price" => 1459, "name" => "Asus - FX570DU0", "type" => "Ordinateurs"],
            11 => ["price" => 349, "name" => "Bose - QC35", "type" => "Casques"],
            12 => ["price" => 149, "name" => "Apple - AirPods", "type" => "Casques"],
            13 => ["price" => 162, "name" => "Bose - Soundsport", "type" => "Casques"],
            14 => ["price" => 1499, "name" => "DJI Mavic Pro 2", "type" => "Drones"],
            15 => ["price" => 1529, "name" => "DJI Phantom 4K", "type" => "Drones"],
            16 => ["price" => 559, "name" => "Parot Anafi", "type" => "Drones"],
            17 => ["price" => 128.97, "name" => "Husban X3", "type" => "Drones"],
            18 => ["price" => 349.99, "name" => "Apple Watch Série 3 43mm rose", "type" => "Montres Connectées"],
            19 => ["price" => 223, "name" => "Garmin Vivoactive 3", "type" => "Montres Connectées"],
            20 => ["price" => 255.99, "name" => "Samsung Galaxy Watch", "type" => "Montres Connectées"],
            21 => ["price" => 549.99, "name" => "Garmin Fenix 5S HR", "type" => "Montres Connectées"],
            22 => ["price" => 199.99, "name" => "Fitbit Versa Noir", "type" => "Montres Connectées"],
            23 => ["price" => 99.99, "name" => "Kit de démarage Philips Hue", "type" => "Lumières connectées"],
            24 => ["price" => 349.99, "name" => "Nest Cam IQ", "type" => "Caméras Connectées"],
            25 => ["price" => 779, "name" => "Caméra de surveillance Netgear VMS4330 Arlo Pro Pack 3 caméras", "type" => "Caméras Connectées"],
            26 => ["price" => 99.99, "name" => "Thermostat connecté Heatzy Flam avec Prise Plugzy Blanc", "type" => "Thermostats Connectée"],
            28 => ["price" => 29.99, "name" => "Google Home Mini", "type" => "Enceintes connectées"],
            29 => ["price" => 349, "name" => "Apple HomePod", "type" => "Enceintes connectées"],
            30 => ["price" => 29.99, "name" => "Amazon Echo Dot", "type" => "Enceintes connectées"],
            31 => ["name" => "Vename Blu-Ray", "price" => 34.99, "type" => "DVD's"],
            32 => ["name" => "Les Animaux Fantastiques 2 Blu-Ray", "price" => 24.99, "type" => "DVD's"],
            33 => ["name" => "Justice League Blu-Ray", "price" => 15.99, "type" => "DVD's"],
            34 => ["name" => "Les Animaux Fantastiques Blu-Ray", "price" => 12.99, "type" => "DVD's"],
            35 => ["name" => "Les Indestructibles 2 Blu-Ray", "price" => 17.99, "type" => "DVD's"],
            36 => ["name" => "Le Livre de la Jungle DVD", "price" => 14.99, "type" => "DVD's"],
            37 => ["name" => "La petite Sirène DVD", "price" => 14.99, "type" => "DVD's"],
            38 => ["name" => "Tomb Raider Blu-Ray", "price" => 14.99, "type" => "DVD's"],
            39 => ["name" => "Ready Player One Blu-Ray", "price" => 19.99, "type" => "DVD's"],
            40 => ["name" => "Harry Potter Coffret Blu-Ray", "price" => 78.99, "type" => "DVD's"],
            41 => ["name" => "Super Smash Bros Ultimate Nintendo Switch" , "price" => 54.99, "type" => "Nintendo Switch"],
            42 => ["name" => "Red Dead Redemption 2 PS4", "price" => 59.99, "type" => "PS4"],
            43 => ["name" => " Battlefield V Xbox One ", "price" => 59.99, "type" => "Xbox"],
            44 => ["name" => "Call of Duty Black Ops 4 PC", "price" => 46.99, "type" => "PC"],
            45 => ["name" => "Fallout 76 PC" , "price" => 54.99, "type" => "PC"],
            46 => ["name" => "Cluedo Junior Hasbro", "price" => 18.99, "type" => "Jeux de société"],
            47 => ["name" => "Monopoly classique Hasbro", "price" => 19.99, "type" => "Jeux de société"],
            48 => ["name" => "Trivial Pursuit Hasbro", "price" => 24.99, "type" => "Jeux de société"],
            49 => ["name" => "Hippo Gloutons Hasbro", "price" => 7.99, "type" => "Jeux de société"],
            50 => ["name" => "La Bonne Paye Hasbro", "price" => 29.99, "type" => "Jeux de société"],

        ];

        foreach ($products as $product) {
            $category = Category::where('slug', '=', Str::slug($product['type']))->first();
            $category_id = $category ? $category->id : null;

            $promotion = ($rand = rand(5,30)) % 7 == 0 ? floatval($rand) : null;

            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => 'Murenam te accusante defenderem. Tubulo putas dicere? Si longus, 
                    levis dictata sunt. Quid sequatur, quid repugnet, vident. 
                    Tu enim ista lenius, hic Stoicorum more nos vexat. Duo enim genera quae erant, fecit tria. Non igitur bene. ',
                'price' => number_format($product['price'] - ($product['price'] * ($promotion / 100)), 2, '.', ''),
                'base_price' => $product['price'],
                'stock_quantity' => rand(0, 100),
                'promotion' => $promotion,
                'image' => 'images/products/' . Str::slug($product['name']) . '.jpg',
                'category_id' => $category_id,
                'available_at' => rand() % 12 == 0 ? (new DateTime('now'))->add(new DateInterval('P' . rand(1, 40) .'D')) : (new DateTime('now')),
            ]);
        }
    }
}
