<?php

namespace Database\Seeders;

use App\Models\accounts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class accountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        accounts::create(
            [
                'title' => "Cash Account",
                'type' => "Business",
                'category' => "Cash",
                'areaID' => 1
            ]
        );

        accounts::create(
            [
                'title' => "Walk-In Customer",
                'type' => "Customer",
                'areaID' => 1
                
            ]
        );

        accounts::create(
            [
                'title' => "Walk-In Vendor",
                'type' => "Vendor",
                'areaID' => 1
            ]
        );
    }
}
