<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\JobOffer;
use App\Models\CandidateProfile;
use App\Models\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseStabilityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_database_can_be_migrated_and_basic_tables_exist()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    /** @test */
    public function test_job_offers_table_has_required_columns()
    {
        $user = User::create([
            'name' => 'Recruiter',
            'email' => 'recruiter@example.com',
            'password' => bcrypt('password'),
        ]);

        $offer = JobOffer::create([
            'title' => ['en' => 'Test Job', 'es' => 'Trabajo de Prueba'],
            'description' => ['en' => 'Description', 'es' => 'Descripción'],
            'location' => 'Remote',
            'salary_range' => '$50k',
            'status' => 'active',
            'created_by' => $user->id,
        ]);

        $this->assertDatabaseHas('job_offers', [
            'location' => 'Remote',
            'salary_range' => '$50k',
            'status' => 'active',
        ]);
    }

    /** @test */
    public function test_relationships_are_working_correctly()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $offer = JobOffer::create([
            'title' => ['en' => 'Dev', 'es' => 'Dev'],
            'description' => ['en' => 'Dev', 'es' => 'Dev'],
            'created_by' => $user->id,
        ]);

        $candidate = CandidateProfile::create([
            'name' => 'Candidate',
            'email' => 'candidate@example.com',
            'email_blind_index' => hash_hmac('sha256', 'candidate@example.com', 'secret'),
        ]);

        $application = Application::create([
            'candidate_profile_id' => $candidate->id,
            'job_offer_id' => $offer->id,
            'status' => 'new',
        ]);

        $this->assertEquals($user->id, $offer->creator->id);
        $this->assertEquals($offer->id, $application->jobOffer->id);
        $this->assertEquals($candidate->id, $application->candidateProfile->id);
    }
}
