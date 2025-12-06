<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'JadiCMS',
            'email' => 'admin@jadicms.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        $this->call(GeminiContentSeeder::class);

        // menu
        j_set_option('menus', json_encode([
            [
                'label' => 'Home',
                'url' => '/',
                'is_parent' => false,
                'parent_id' => null
            ],
            [
                'label' => 'About Us',
                'url' => '/page/about-us',
                'is_parent' => false,
                'parent_id' => null
            ],
            [
                'label' => 'Contact Us',
                'url' => '/page/contact-us',
                'is_parent' => false,
                'parent_id' => null
            ],
            [
                'label' => 'Privacy Policy',
                'url' => '/page/privacy-policy',
                'is_parent' => false,
                'parent_id' => null
            ]
        ]));

        $this->call(PageCommonSeeder::class);
    }
}
