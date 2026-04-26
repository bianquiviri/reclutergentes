<?php

namespace Database\Seeders;

use App\Models\JobOffer;
use Illuminate\Database\Seeder;

class JobOfferSeeder extends Seeder
{
    public function run(): void
    {
        $admin = \App\Models\User::first();
        if (!$admin) return;

        $offers = [
            [
                'title' => ['en' => 'Senior Laravel Developer', 'es' => 'Desarrollador Laravel Senior'],
                'description' => ['en' => 'Join our elite team...', 'es' => 'Únete a nuestro equipo de élite...'],
                'location' => 'Remote / Madrid',
                'salary_range' => '$60k - $90k',
                'status' => 'active',
            ],
            [
                'title' => ['en' => 'Cybersecurity Analyst', 'es' => 'Analista de Ciberseguridad'],
                'description' => ['en' => 'Focus on OWASP and AES-256...', 'es' => 'Enfocado en OWASP y AES-256...'],
                'location' => 'Hybrid / Barcelona',
                'salary_range' => '$50k - $80k',
                'status' => 'active',
            ],
            [
                'title' => ['en' => 'UI/UX Designer', 'es' => 'Diseñador UI/UX'],
                'description' => ['en' => 'Master Shadcn and Tailwind...', 'es' => 'Maestro de Shadcn y Tailwind...'],
                'location' => 'Remote',
                'salary_range' => '$45k - $70k',
                'status' => 'active',
            ],
        ];

        foreach ($offers as $offer) {
            $offer['created_by'] = $admin->id;
            JobOffer::create($offer);
        }

        JobOffer::factory()->count(300)->create([
            'created_by' => $admin->id
        ]);
    }
}
