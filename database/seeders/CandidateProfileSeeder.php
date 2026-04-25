<?php

namespace Database\Seeders;

use App\Models\CandidateProfile;
use Illuminate\Database\Seeder;

class CandidateProfileSeeder extends Seeder
{
    public function run(): void
    {
        $candidates = [
            [
                'name' => 'Elena Rodriguez',
                'email' => 'elena.rodriguez@example.com',
                'phone' => '+34 600 000 001',
                'address' => 'Calle Mayor 1, Madrid',
                'preferred_locale' => 'es',
                'english_level' => 'C1',
                'parsed_content' => [
                    'skills' => ['Laravel', 'PHP', 'Docker'],
                    'experience' => '5 years as Senior Dev',
                ],
            ],
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1 555 123 456',
                'address' => '123 Main St, New York',
                'preferred_locale' => 'en',
                'english_level' => 'Native',
                'parsed_content' => [
                    'skills' => ['React', 'Node.js', 'AWS'],
                    'experience' => '8 years Fullstack',
                ],
            ],
            [
                'name' => 'Yuki Tanaka',
                'email' => 'yuki.tanaka@example.com',
                'phone' => '+81 90 1234 5678',
                'address' => 'Shibuya, Tokyo',
                'preferred_locale' => 'en',
                'english_level' => 'B2',
                'parsed_content' => [
                    'skills' => ['Python', 'Django', 'ML'],
                    'experience' => '3 years Data Science',
                ],
            ],
        ];

        foreach ($candidates as $candidate) {
            CandidateProfile::create($candidate);
        }
    }
}
