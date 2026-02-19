<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // Default Settings
        $settings = [
            'hero_greeting' => "Hi! I'm John Doe",
            'hero_headline' => "Senior Web Developer based in New York.",
            'hero_description' => "I am a backend-focused full-stack developer with 10+ years of experience building scalable applications with Laravel, Vue.js, and modern cloud technologies.",
            'about_title' => "About Me",
            'about_content' => "With over a decade of hands-on experience, I specialized in PHP/Laravel ecosystems, API development, and frontend integration. I have led teams, architected complex systems, and delivered robust solutions for enterprise clients.",
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Default Projects
        $projects = [
            [
                'title' => 'SaaS Dashboard UI',
                'category' => 'Web Design',
                'image_path' => 'images/project_thumbnail_1_1770985481957.png',
                'link' => '#',
            ],
            [
                'title' => 'AURA Fashion',
                'category' => 'E-commerce',
                'image_path' => 'images/project_thumbnail_2_1770985510168.png',
                'link' => '#',
            ],
            [
                'title' => 'Fintech App',
                'category' => 'Mobile App',
                // Using one of the existing images since the 3rd failed generation
                'image_path' => 'images/project_thumbnail_1_1770985481957.png', 
                'link' => '#',
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
