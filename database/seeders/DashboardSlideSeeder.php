<?php

namespace Database\Seeders;

use App\Models\DashboardSlide;
use Illuminate\Database\Seeder;

class DashboardSlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 5; $i++) {
            DashboardSlide::create([
                'position' => $i,
                'path' => "slide$i.jpg",
            ]);
        }
    }
}
