<?php

namespace Database\Seeders;

use App\Models\Map;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maps = [
            'Satu',
            'Kolaboratif',
            'Adaptif',
            'Problem Solving',
            'Kreatif'
        ];

        foreach ($maps as $map) {
            Map::query()->create([
                'name' => $map
            ]);
        }
    }
}
