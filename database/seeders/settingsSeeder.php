<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\settings;

class settingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        settings::create([
            'blog_name' => 'Micheal Namma',
            'phone_number' => '+963 000 000',
            'blog_email' => 'test@gmail.com',
            'address' => 'Syria - Damascus'
        ]);
    }
}
