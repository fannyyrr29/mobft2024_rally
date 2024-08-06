<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            'Carnival Shuffle' => 'Depan PAJ Teknik Industri',
            'Dizzy Dash' => 'TF 3.2',
            'Magic Wand' => 'TF 4.2',
            'Ball-a-boop' => 'antara TF dan TE (Depan Kluwih)',
            'Full Fill Your Duty As A Clown' => 'TF 3.3',
            'Foot Volleyball' => 'Boulevard',
            'Throw and Get Me' => 'TF 2.2',
            'Rolling Ball' => 'TF 4.3',
            'Pingo' => 'TF 4.1B',
            'Pyramid Jengga' => 'TF 3.1 ',
            'Crack The Code' => 'TF 2.5',
            'Magic Color' => 'TF 4.1A',
            'Match Me' => 'TF 2.1',
            'Try Your Luck' => 'TF 4.1B',
            'Wandering Train' => 'Gaztek'
        ];

        $pos = 1;
        foreach ($posts as $post => $lokasi) {
            User::query()->create([
                'name' => $post,
                'username' => "penpos$pos",
                'password' => Hash::make('Penpos@MOBFT24'),
                'target' => 15,
                'lokasi' => $lokasi,
                'role' => 'Penpos'
            ]);

            $pos++;
        }
    }
}
