<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::where('id', '!=', 0)->delete();
        $comments = [
            0 => ["title" => "Super produit", "content" => "Apple c'est super", "rate" => 5, "user_id" => 1, "product_id" => 1],
            1 => ["title" => "Nul", "content" => "Remboursé !", "rate" => 0, "user_id" => 1, "product_id" => 48],
            2 => ["title" => "Up", "content" => "Là pour le referencement", "rate" => 5, "user_id" => 1, "product_id" => 47],
            3 => ["title" => "Sympa", "content" => "", "rate" => 1, "user_id" => 1, "product_id" => 48],
            4 => ["title" => "right", "content" => "Follow the leader", "rate" => 3, "user_id" => 1, "product_id" => 48],
            5 => ["title" => "En attente", "content" => "J'ai toujours pas reçu mon coli", "rate" => 0, "user_id" => 1, "product_id" => 48],
            6 => ["title" => "Amusant", "content" => "Mes enfants adorent", "rate" => 3, "user_id" => 1, "product_id" => 49],
        ];

        foreach ($comments as $comment)
        {
            Comment::create([
                'title' => $comment['title'],
                'content' => $comment['content'],
                'rate' => $comment['rate'],
                'user_id' => $comment['user_id'],
                'product_id' => $comment['product_id'],
                'is_visible' => 0,
            ]);
        }
    }
}
