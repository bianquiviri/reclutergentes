<?php

namespace Database\Seeders;

use App\Models\Application;
use App\Models\CandidateProfile;
use App\Models\JobOffer;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        $candidates = CandidateProfile::all();
        $offers = JobOffer::all();

        if ($candidates->isEmpty() || $offers->isEmpty()) {
            return;
        }

        $statuses = ['new', 'review', 'test', 'interview', 'hired', 'rejected'];

        foreach ($candidates as $candidate) {
            // Apply each candidate to at least one job
            Application::create([
                'candidate_profile_id' => $candidate->id,
                'job_offer_id' => $offers->random()->id,
                'status' => $statuses[array_rand($statuses)],
                'test_score' => rand(60, 100),
                'notes' => 'Automatic application from seeder.',
            ]);
        }
    }
}
