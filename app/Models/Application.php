<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'candidate_profile_id',
        'job_offer_id',
        'status',
        'kanban_order',
        'test_score',
        'notes',
    ];

    protected $casts = [
        'notes' => 'json',
    ];

    public function candidateProfile()
    {
        return $this->belongsTo(CandidateProfile::class);
    }

    public function jobOffer()
    {
        return $this->belongsTo(JobOffer::class);
    }
}
