<?php

namespace Database\Seeders;

use App\Models\DashboardContent;
use Illuminate\Database\Seeder;

class DashboardContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DashboardContent::create([
            'data_key' => 'dashboard.footer',
            'data_type' => 'content.line.line1',
            'data_text' => 'Copyright © 2022 All Right Reserved',
        ]);
        DashboardContent::create([
            'data_key' => 'dashboard.footer',
            'data_type' => 'content.line.line2',
            'data_text' => 'Member Line 2 Text',
        ]);
        DashboardContent::create([
            'data_key' => 'dashboard.footer',
            'data_type' => 'element.textlink',
            'data_text' => 'Privacy & Security',
            'data_text2' => 'https://google.com',
        ]);
        DashboardContent::create([
            'data_key' => 'dashboard.footer',
            'data_type' => 'element.textlink',
            'data_text' => 'Identity Theft',
            'data_text2' => 'https://google.com',
        ]);
        /* DashboardContent::create([
            'data_key' => 'dashboard.footer',
            'data_type' => 'element.iconlink',
            'data_text' => 'fa fa-facebook',
            'data_text2' => 'https://facebook.com',
        ]); */
        /* DashboardContent::create([
            'data_key' => 'dashboard.footer',
            'data_type' => 'element.iconlink',
            'data_text' => 'fa fa-twitter',
            'data_text2' => 'https://twitter.com',
        ]); */
    }
}
