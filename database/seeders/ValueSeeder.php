<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            'Carnival Shuffle' => [1, 2],
            'Dizzy Dash' => [3],
            'Magic Wand' => [1, 2, 3, 5],
            'Ball-a-boop' => [2, 4, 5],
            'Full Fill Your Duty As A Clown' => [1, 2],
            'Foot Volleyball' => [1, 2],
            'Throw and Get Me' => [4],
            'Rolling Ball' => [1],
            'Pingo' => [1, 2, 4],
            'Pyramid Jengga' => [1, 4, 5],
            'Crack The Code' => [2, 4],
            'Magic Color' => [1, 2, 3],
            'Match Me' => [3, 4],
            'Try Your Luck' => [1, 2, 3],
            'Wandering Train' => [1, 2],
        ];

        foreach ($posts as $post => $values) {
            $post = User::where('name', $post)->first();
            if ($post) {
                $post->maps()->attach($values);
            }
        }
    }
}
