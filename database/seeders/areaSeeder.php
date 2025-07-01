<?php

namespace Database\Seeders;

use App\Models\areas;
use App\Models\town;
use App\Models\warehouses;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class areaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $towns = [
            ['name' => "Town 1"],
        ];
        $data = [
            ['name' => "Area 1", 'townID' => 1],
        ];
        town::insert($towns);
        areas::insert($data);
    }
}
