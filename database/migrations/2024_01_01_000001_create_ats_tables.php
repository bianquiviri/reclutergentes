<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('candidate_profiles', function (Blueprint $table) {
            $table->id();
            
            // Encrypted PII (Casts:encrypted in Model)
            $table->text('name');
            $table->text('email');
            $table->text('phone')->nullable();
            $table->text('address')->nullable();
            
            // Blind Indexes for searching (HMAC hashes)
            $table->string('email_blind_index')->unique()->index();
            
            // AI Parsed Content (Encrypted JSON)
            $table->longText('parsed_content')->nullable();
            
            $table->string('english_level')->nullable(); // A1, A2, B1, B2, C1, C2
            $table->string('preferred_locale')->default('es');
            $table->timestamps();
        });

        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            
            // Translatable fields (JSON structure)
            $table->json('title');
            $table->json('description');
            $table->json('requirements')->nullable();
            
            $table->string('status')->default('open'); // open, closed, draft
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_offer_id')->constrained()->onDelete('cascade');
            
            $table->string('status')->default('new'); // new, screening, interview, offer, hired, rejected
            $table->integer('kanban_order')->default(0);
            $table->integer('test_score')->nullable();
            
            $table->json('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
        Schema::dropIfExists('job_offers');
        Schema::dropIfExists('candidate_profiles');
    }
};
